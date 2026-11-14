<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobSeekerRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_seeker_registration_page_is_available(): void
    {
        $response = $this->get(route('jobseeker.register'));

        $response->assertOk();
        $response->assertSee('Daftar sebagai Pencari Kerja');
        $response->assertSee('Nama lengkap');
        $response->assertDontSee('Daftar sebagai Admin');
    }

    public function test_invalid_registration_preserves_safe_fields_but_not_passwords(): void
    {
        $response = $this->from(route('jobseeker.register'))->post(route('jobseeker.register.store'), [
            'name' => 'Didit Aditya Rahman',
            'email' => 'bukan-email',
            'password' => 'rahasia123',
            'password_confirmation' => 'berbeda123',
        ]);

        $response->assertRedirect(route('jobseeker.register'));
        $response->assertSessionHasErrors(['email', 'password']);
        $response->assertSessionHasInput('name', 'Didit Aditya Rahman');
        $response->assertSessionHasInput('email', 'bukan-email');
        $this->assertArrayNotHasKey('password', session()->getOldInput());
        $this->assertArrayNotHasKey('password_confirmation', session()->getOldInput());
    }

    public function test_registration_is_blocked_until_account_role_dependency_exists(): void
    {
        $response = $this->from(route('jobseeker.register'))->post(route('jobseeker.register.store'), [
            'name' => 'Didit Aditya Rahman',
            'email' => 'didit@example.test',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ]);

        $response->assertRedirect(route('jobseeker.register'));
        $response->assertSessionHasErrors('registration');
        $this->assertDatabaseCount('users', 0);
    }
}
