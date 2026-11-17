<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserAccountStorageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 1. Akun berhasil dibuat dengan data valid dan field role tersimpan.
     */
    public function test_user_account_can_be_created_with_valid_data_and_role_is_saved(): void
    {
        $payload = [
            'name' => 'Budi Pratama',
            'email' => 'budi.pratama@example.test',
            'password' => 'Rahasia1234!',
            'password_confirmation' => 'Rahasia1234!',
            'role' => UserRole::JOB_SEEKER->value,
        ];

        $response = $this->post(route('users.store'), $payload);

        $response->assertStatus(302);
        $response->assertSessionHas('status', 'Akun pengguna berhasil dibuat.');

        $this->assertDatabaseHas('users', [
            'name' => 'Budi Pratama',
            'email' => 'budi.pratama@example.test',
            'role' => UserRole::JOB_SEEKER->value,
        ]);

        $user = User::where('email', 'budi.pratama@example.test')->first();
        $this->assertNotNull($user);
        $this->assertSame(UserRole::JOB_SEEKER->value, $user->role);
        $this->assertTrue($user->isJobSeeker());
        $this->assertFalse($user->isEmployer());
    }

    /**
     * 2. Password tersimpan dalam bentuk hash (Hash::check benar, dan nilai di DB tidak sama dengan password asli).
     */
    public function test_password_is_stored_as_a_secure_hash_and_not_plain_text(): void
    {
        $plainPassword = 'SuperSecretPassword2026!';

        $payload = [
            'name' => 'Siti Aminah',
            'email' => 'siti.aminah@example.test',
            'password' => $plainPassword,
            'password_confirmation' => $plainPassword,
            'role' => UserRole::EMPLOYER->value,
        ];

        $this->post(route('users.store'), $payload);

        $user = User::where('email', 'siti.aminah@example.test')->first();
        $this->assertNotNull($user);

        // Password in DB must not match raw plain text
        $this->assertNotSame($plainPassword, $user->password);

        // Password in DB must verify correctly with Hash::check
        $this->assertTrue(Hash::check($plainPassword, $user->password));

        // Ensure password was not hashed twice
        $this->assertFalse(Hash::check(bcrypt($plainPassword), $user->password));
    }

    /**
     * 3. Gagal bila field wajib kosong (name, email, password, role).
     */
    public function test_registration_fails_when_required_fields_are_missing(): void
    {
        $response = $this->post(route('users.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'email', 'password', 'role']);

        $this->assertDatabaseCount('users', 0);
    }

    /**
     * 4. Gagal bila format email tidak valid.
     */
    public function test_registration_fails_when_email_format_is_invalid(): void
    {
        $invalidEmails = [
            'bukan-email',
            'bukan@',
            '@example.com',
            'nama domain.com',
            'nama..ganda@example.com',
        ];

        foreach ($invalidEmails as $email) {
            $response = $this->post(route('users.store'), [
                'name' => 'Format Salah',
                'email' => $email,
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'role' => UserRole::JOB_SEEKER->value,
            ]);

            $response->assertSessionHasErrors('email');
        }

        $this->assertDatabaseCount('users', 0);
    }

    /**
     * 5. Gagal bila email sudah terdaftar (duplikat).
     */
    public function test_registration_fails_when_email_is_already_registered(): void
    {
        User::factory()->create([
            'email' => 'terdaftar@example.test',
        ]);

        $response = $this->post(route('users.store'), [
            'name' => 'Pendaftar Baru',
            'email' => 'terdaftar@example.test',
            'password' => 'PasswordBaru123!',
            'password_confirmation' => 'PasswordBaru123!',
            'role' => UserRole::JOB_SEEKER->value,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');

        // Only the initial factory user exists
        $this->assertDatabaseCount('users', 1);
    }

    /**
     * 6. Gagal bila role tidak valid.
     */
    public function test_registration_fails_when_role_is_invalid(): void
    {
        $invalidRoles = [
            'admin',
            'superadmin',
            'root',
            'moderator',
            '12345',
            'unknown_role',
            '',
        ];

        foreach ($invalidRoles as $invalidRole) {
            $response = $this->post(route('users.store'), [
                'name' => 'Role Invalid',
                'email' => 'role.invalid.'.md5($invalidRole).'@example.test',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'role' => $invalidRole,
            ]);

            $response->assertSessionHasErrors('role');
        }

        $this->assertDatabaseCount('users', 0);
    }

    /**
     * 7. Role tidak bisa disisipkan sembarangan lewat mass assignment dari input yang tidak seharusnya.
     */
    public function test_role_cannot_be_arbitrarily_injected_via_mass_assignment_or_privileged_inputs(): void
    {
        // 7a. Attempt to inject privileged role "admin" through registration payload
        $response = $this->post(route('users.store'), [
            'name' => 'Attacker',
            'email' => 'attacker@example.test',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => 'admin',
            'is_admin' => 1,
            'email_verified_at' => now()->toDateTimeString(),
        ]);

        $response->assertSessionHasErrors('role');
        $this->assertDatabaseMissing('users', [
            'email' => 'attacker@example.test',
        ]);

        // 7b. Attempt to inject arbitrary un-fillable attributes through JSON API endpoint
        $jsonResponse = $this->postJson(route('users.store'), [
            'name' => 'Attacker JSON',
            'email' => 'attacker.json@example.test',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => UserRole::JOB_SEEKER->value,
            'is_admin' => true,
            'remember_token' => 'tampered_token',
        ]);

        $jsonResponse->assertStatus(201);
        $user = User::where('email', 'attacker.json@example.test')->first();
        $this->assertNotNull($user);
        $this->assertSame(UserRole::JOB_SEEKER->value, $user->role);
        $this->assertNull($user->remember_token);
    }

    /**
     * Additional validation check: Password confirmation mismatch and minimum length.
     */
    public function test_password_validation_enforces_minimum_length_and_confirmation(): void
    {
        // Too short
        $resShort = $this->post(route('users.store'), [
            'name' => 'Short Pass',
            'email' => 'short@example.test',
            'password' => '1234567',
            'password_confirmation' => '1234567',
            'role' => UserRole::JOB_SEEKER->value,
        ]);
        $resShort->assertSessionHasErrors('password');

        // Mismatched confirmation
        $resMismatch = $this->post(route('users.store'), [
            'name' => 'Mismatch Pass',
            'email' => 'mismatch@example.test',
            'password' => 'Password123!',
            'password_confirmation' => 'Different123!',
            'role' => UserRole::JOB_SEEKER->value,
        ]);
        $resMismatch->assertSessionHasErrors('password');
    }
}
