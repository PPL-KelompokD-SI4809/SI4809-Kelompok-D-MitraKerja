<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->assertSame('sqlite', config('database.default'));
        $this->assertSame(':memory:', config('database.connections.sqlite.database'));
    }

    public function test_login_page_and_protected_account(): void
    {
        $this->get('/masuk')->assertOk()->assertSee('Pilih jenis akun untuk masuk.')
            ->assertSee('Pencari kerja')->assertSee('Pemberi kerja')->assertDontSee('name="password"', false);
        $this->get('/masuk?role=employer')->assertOk()->assertSee('Selamat datang')
            ->assertSee('name="role" value="employer"', false);
        $this->get('/akun')->assertRedirect('/masuk');
        $this->get('/keluar')->assertStatus(405);
    }

    public function test_valid_credentials_authenticate_and_rotate_session(): void
    {
        $user = User::factory()->create(['password' => 'test-password-123']);
        $this->withSession(['marker' => 'preserved']);
        $before = session()->getId();
        $this->post('/masuk', ['role' => 'job_seeker', 'email' => $user->email, 'password' => 'test-password-123'])
            ->assertRedirect('/akun');
        $this->assertAuthenticatedAs($user);
        $this->assertNotSame($before, session()->getId());
        $this->get('/akun')->assertOk()->assertSee('Buka Dashboard Pencari Kerja')
            ->assertSee(route('dashboard.job_seeker'), false);
        $this->get('/masuk')->assertRedirect('/akun');
    }

    public function test_wrong_password_and_unknown_email_have_same_error(): void
    {
        $user = User::factory()->create();
        foreach ([$user->email, 'unknown@example.test'] as $email) {
            $this->from('/masuk')->post('/masuk', ['role' => 'job_seeker', 'email' => $email, 'password' => 'wrong-password'])
                ->assertRedirect('/masuk')
                ->assertSessionHasErrors(['email' => 'Email atau kata sandi tidak sesuai.'])
                ->assertSessionHasInput('email', $email);
            $this->assertArrayNotHasKey('password', session()->getOldInput());
            $this->assertGuest();
        }
    }

    public function test_validation_preserves_email_only(): void
    {
        $this->from('/masuk')->post('/masuk', ['email' => 'invalid', 'password' => ''])
            ->assertRedirect('/masuk')->assertSessionHasErrors(['email', 'password'])
            ->assertSessionHasInput('email', 'invalid');
        $this->assertArrayNotHasKey('password', session()->getOldInput());
    }

    public function test_logout_invalidates_session_and_rotates_csrf_token(): void
    {
        $this->actingAs(User::factory()->create())->withSession(['private_marker' => 'secret']);
        $this->get('/akun');
        $token = session()->token();
        $id = session()->getId();
        $this->post('/keluar')->assertRedirect('/masuk')->assertSessionMissing('private_marker');
        $this->assertGuest();
        $this->assertNotSame($id, session()->getId());
        $this->assertNotSame($token, session()->token());
        $this->get('/akun')->assertRedirect('/masuk');
    }

    public function test_configured_role_redirect_uses_existing_route(): void
    {
        $user = User::factory()->create(['password' => 'test-password-123']);
        $user->role = 'employer';
        $user->save();
        Route::get('/test-dashboard', fn () => 'fixture')->middleware('auth')->name('test.dashboard');
        Route::getRoutes()->refreshNameLookups();
        config(['auth.role_home_routes.employer' => 'test.dashboard']);
        $this->from('/masuk?role=job_seeker')
            ->post('/masuk', ['role' => 'job_seeker', 'email' => $user->email, 'password' => 'test-password-123'])
            ->assertSessionHasErrors(['email' => 'Email atau kata sandi tidak sesuai.']);
        $this->assertGuest();
        $this->post('/masuk', ['role' => 'employer', 'email' => $user->email, 'password' => 'test-password-123'])
            ->assertRedirect('/test-dashboard');
    }

    public function test_login_attempts_are_throttled(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/masuk', ['email' => 'unknown@example.test', 'password' => 'wrong-password']);
        }
        $this->post('/masuk', ['email' => 'unknown@example.test', 'password' => 'wrong-password'])
            ->assertStatus(429);
    }
}
