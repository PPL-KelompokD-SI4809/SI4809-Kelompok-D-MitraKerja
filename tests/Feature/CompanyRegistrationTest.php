<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CompanyRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_registration_page_displays_only_basic_account_fields(): void
    {
        $response = $this->get(route('employer.register'));

        $response->assertOk()
            ->assertSee('Daftar sebagai Perusahaan')
            ->assertSee('Nama akun')
            ->assertSee('Buat Akun Perusahaan')
            ->assertSee('action="'.route('employer.register.store').'"', false)
            ->assertSee('name="_token"', false);

        preg_match_all('/<input\b[^>]*\bname="([^"]+)"/', $response->getContent(), $matches);

        $this->assertSame(['_token', 'name', 'email', 'password', 'password_confirmation'], $matches[1]);
    }

    public function test_home_registration_option_links_to_company_registration(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('href="'.route('employer.register').'"', false)
            ->assertSee("window.location.href = '".route('employer.register')."';", false)
            ->assertDontSee('Pendaftaran pemberi kerja sedang dipersiapkan.')
            ->assertDontSee('Pendaftaran pemberi kerja belum tersedia pada versi ini.');
    }

    #[DataProvider('invalidAccountData')]
    public function test_invalid_account_data_is_rejected(array $changes, array $errors): void
    {
        $response = $this->from(route('employer.register'))
            ->post(route('employer.register.store'), array_replace($this->accountData(), $changes));

        $response->assertRedirect(route('employer.register'))
            ->assertSessionHasErrors($errors);

        $this->assertDatabaseCount('users', 0);
        $this->assertArrayNotHasKey('password', session()->getOldInput());
        $this->assertArrayNotHasKey('password_confirmation', session()->getOldInput());
    }

    public static function invalidAccountData(): array
    {
        return [
            'required fields' => [['name' => '', 'email' => '', 'password' => '', 'password_confirmation' => ''], ['name', 'email', 'password']],
            'invalid email' => [['email' => 'bukan-email'], ['email']],
            'short password' => [['password' => '1234567', 'password_confirmation' => '1234567'], ['password']],
            'confirmation mismatch' => [['password_confirmation' => 'berbeda123'], ['password']],
            'missing confirmation' => [['password_confirmation' => ''], ['password']],
            'long name' => [['name' => str_repeat('a', 256)], ['name']],
            'long email' => [['email' => str_repeat('a', 244).'@example.test'], ['email']],
        ];
    }

    public function test_validation_errors_and_safe_input_are_shown_again(): void
    {
        $response = $this->from(route('employer.register'))
            ->post(route('employer.register.store'), $this->accountData(['email' => 'bukan-email']));

        $response->assertSessionHasInput('name', 'Akun Rekrutmen Mitra')
            ->assertSessionHasInput('email', 'bukan-email');

        $this->get(route('employer.register'))
            ->assertOk()
            ->assertSee('Masukkan alamat email yang valid.')
            ->assertSee('value="Akun Rekrutmen Mitra"', false)
            ->assertSee('value="bukan-email"', false)
            ->assertDontSee('rahasia123');
    }

    public function test_existing_email_is_rejected_without_modifying_the_account(): void
    {
        $existing = User::factory()->create(['email' => 'rekrutmen@example.test']);
        $original = $existing->fresh()->getAttributes();

        $this->from(route('employer.register'))
            ->post(route('employer.register.store'), $this->accountData())
            ->assertRedirect(route('employer.register'))
            ->assertSessionHasErrors(['email' => 'Alamat email tersebut sudah terdaftar.']);

        $this->assertDatabaseCount('users', 1);
        $this->assertSame($original, $existing->fresh()->getAttributes());
    }

    public function test_valid_input_creates_an_employer_account_with_a_hashed_password(): void
    {
        $this->post(route('employer.register.store'), $this->accountData())
            ->assertRedirect(route('employer.register'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'Akun perusahaan berhasil dibuat. Silakan masuk saat fitur autentikasi tersedia.');

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'name' => 'Akun Rekrutmen Mitra',
            'email' => 'rekrutmen@example.test',
            'role' => 'employer',
        ]);

        $user = User::query()->where('email', 'rekrutmen@example.test')->firstOrFail();
        $this->assertSame(UserRole::EMPLOYER, $user->roleEnum());
        $this->assertTrue($user->isEmployer());
        $this->assertFalse($user->isJobSeeker());
        $this->assertNotSame('rahasia123', $user->password);
        $this->assertTrue(Hash::check('rahasia123', $user->password));
        $this->assertGuest();
        $this->assertArrayNotHasKey('password', session()->getOldInput());
        $this->assertArrayNotHasKey('password_confirmation', session()->getOldInput());

        $this->get(route('employer.register'))
            ->assertOk()
            ->assertSee('Akun perusahaan berhasil dibuat.')
            ->assertDontSee('rahasia123');
    }

    public function test_registration_is_safely_blocked_when_the_role_column_is_missing(): void
    {
        // This schema change exists only in the isolated in-memory test database.
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        $this->from(route('employer.register'))
            ->post(route('employer.register.store'), $this->accountData())
            ->assertRedirect(route('employer.register'))
            ->assertSessionHasErrors('registration')
            ->assertSessionMissing('status')
            ->assertSessionHasInput('name', 'Akun Rekrutmen Mitra')
            ->assertSessionHasInput('email', 'rekrutmen@example.test');

        $this->assertDatabaseCount('users', 0);
        $this->assertArrayNotHasKey('password', session()->getOldInput());
        $this->assertArrayNotHasKey('password_confirmation', session()->getOldInput());

        $this->get(route('employer.register'))
            ->assertOk()
            ->assertSee('Pendaftaran belum dapat diproses karena penyimpanan akun dan peran perusahaan belum tersedia.')
            ->assertDontSee('rahasia123');
    }

    #[DataProvider('invalidRoleData')]
    public function test_public_role_tampering_is_rejected_without_creating_an_account(mixed $role): void
    {
        $this->from(route('employer.register'))
            ->post(route('employer.register.store'), $this->accountData(['role' => $role]))
            ->assertRedirect(route('employer.register'))
            ->assertSessionHasErrors('role')
            ->assertSessionMissing('status');

        $this->assertDatabaseCount('users', 0);
        $this->assertArrayNotHasKey('password', session()->getOldInput());
        $this->assertArrayNotHasKey('password_confirmation', session()->getOldInput());

        $this->get(route('employer.register'))
            ->assertOk()
            ->assertSee('role="alert"', false)
            ->assertDontSee('rahasia123');
    }

    public static function invalidRoleData(): array
    {
        return [
            'admin' => ['admin'],
            'admin uppercase' => ['ADMIN'],
            'administrator' => ['administrator'],
            'superadmin' => ['superadmin'],
            'job seeker' => ['job_seeker'],
            'unknown role' => ['manager'],
            'empty role' => [''],
            'null role' => [null],
            'array role' => [['admin']],
        ];
    }

    public function test_explicit_employer_role_uses_the_shared_registration_contract(): void
    {
        $this->from(route('employer.register'))
            ->post(route('employer.register.store'), $this->accountData(['role' => ' EMPLOYER ']))
            ->assertRedirect(route('employer.register'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status');

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'email' => 'rekrutmen@example.test',
            'role' => UserRole::EMPLOYER->value,
        ]);
    }

    public function test_extra_request_fields_cannot_override_account_attributes(): void
    {
        $this->post(route('employer.register.store'), $this->accountData([
            'id' => 9876,
            'email_verified_at' => '2026-01-01 00:00:00',
            'remember_token' => 'injected-token',
        ]))->assertSessionHasNoErrors();

        $user = User::query()->where('email', 'rekrutmen@example.test')->firstOrFail();
        $this->assertNotSame(9876, $user->id);
        $this->assertNull($user->email_verified_at);
        $this->assertNull($user->remember_token);
        $this->assertSame(UserRole::EMPLOYER->value, $user->role);
    }

    private function accountData(array $changes = []): array
    {
        return array_replace([
            'name' => 'Akun Rekrutmen Mitra',
            'email' => 'rekrutmen@example.test',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ], $changes);
    }
}
