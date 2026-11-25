<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_role_enum_definition_contains_only_job_seeker_and_employer(): void
    {
        $roles = UserRole::values();

        $this->assertCount(2, $roles);
        $this->assertContains('job_seeker', $roles);
        $this->assertContains('employer', $roles);
        $this->assertNotContains('admin', $roles);
        $this->assertNotContains('Admin', $roles);
        $this->assertNotContains('ADMIN', $roles);

        $this->assertSame(UserRole::JOB_SEEKER, UserRole::fromRegistrationType('job_seeker'));
        $this->assertSame(UserRole::JOB_SEEKER, UserRole::fromRegistrationType('pencari_kerja'));
        $this->assertSame(UserRole::EMPLOYER, UserRole::fromRegistrationType('employer'));
        $this->assertSame(UserRole::EMPLOYER, UserRole::fromRegistrationType('perusahaan'));

        $this->assertNull(UserRole::fromRegistrationType('admin'));
        $this->assertNull(UserRole::fromRegistrationType('Admin'));
        $this->assertNull(UserRole::fromRegistrationType('ADMIN'));
        $this->assertNull(UserRole::fromRegistrationType('superadmin'));
        $this->assertNull(UserRole::fromRegistrationType(null));
        $this->assertNull(UserRole::fromRegistrationType(''));
    }

    public function test_job_seeker_registration_stores_job_seeker_role(): void
    {
        $response = $this->post(route('jobseeker.register.store'), [
            'name' => 'Budi Pencari Kerja',
            'email' => 'budi@example.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('jobseeker.register'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('users', [
            'email' => 'budi@example.test',
            'role' => 'job_seeker',
        ]);

        $user = User::where('email', 'budi@example.test')->first();
        $this->assertNotNull($user);
        $this->assertSame('job_seeker', $user->role);
        $this->assertTrue($user->isJobSeeker());
        $this->assertFalse($user->isEmployer());
    }

    public function test_employer_registration_stores_employer_role(): void
    {
        $response = $this->post(route('employer.register.store'), [
            'name' => 'PT Mitra Sejahtera',
            'email' => 'hrd@mitrasejahtera.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('employer.register'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('users', [
            'email' => 'hrd@mitrasejahtera.test',
            'role' => 'employer',
        ]);

        $user = User::where('email', 'hrd@mitrasejahtera.test')->first();
        $this->assertNotNull($user);
        $this->assertSame('employer', $user->role);
        $this->assertTrue($user->isEmployer());
        $this->assertFalse($user->isJobSeeker());
    }

    public function test_unified_registration_endpoint_stores_job_seeker_and_employer(): void
    {
        // 1. Job Seeker
        $respJs = $this->post('/daftar', [
            'name' => 'Siti Pelamar',
            'email' => 'siti@example.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'job_seeker',
        ]);
        $respJs->assertRedirect(route('jobseeker.register'));
        $this->assertDatabaseHas('users', [
            'email' => 'siti@example.test',
            'role' => 'job_seeker',
        ]);

        // 2. Employer
        $respEmp = $this->post('/daftar', [
            'name' => 'CV Sumber Makmur',
            'email' => 'admin@sumbermakmur.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'employer',
        ]);
        $respEmp->assertRedirect(route('employer.register'));
        $this->assertDatabaseHas('users', [
            'email' => 'admin@sumbermakmur.test',
            'role' => 'employer',
        ]);
    }

    public function test_stored_user_role_can_be_read_back_from_database_and_profile_endpoint(): void
    {
        $jobSeeker = User::factory()->create([
            'email' => 'query_js@example.test',
            'role' => 'job_seeker',
        ]);

        $employer = User::factory()->create([
            'email' => 'query_emp@example.test',
            'role' => 'employer',
        ]);

        // Read back via database query
        $readJs = User::where('email', 'query_js@example.test')->first();
        $this->assertNotNull($readJs);
        $this->assertSame('job_seeker', $readJs->role);

        $readEmp = User::where('email', 'query_emp@example.test')->first();
        $this->assertNotNull($readEmp);
        $this->assertSame('employer', $readEmp->role);

        // Read back via profile endpoint for job seeker
        $respJsProfile = $this->actingAs($jobSeeker)->getJson('/profil');
        $respJsProfile->assertOk();
        $respJsProfile->assertJsonPath('role', 'job_seeker');
        $respJsProfile->assertJsonPath('role_label', 'Pencari Kerja');

        // Read back via profile endpoint for employer
        $respEmpProfile = $this->actingAs($employer)->getJson('/profil');
        $respEmpProfile->assertOk();
        $respEmpProfile->assertJsonPath('role', 'employer');
        $respEmpProfile->assertJsonPath('role_label', 'Perusahaan');
    }

    public function test_admin_role_variations_are_rejected_and_no_account_is_created(): void
    {
        $adminVariations = ['admin', 'Admin', 'ADMIN', 'administrator', 'Administrator', 'ADMINISTRATOR'];

        foreach ($adminVariations as $adminRole) {
            // Test against /daftar endpoint
            $response = $this->post('/daftar', [
                'name' => 'Attacker',
                'email' => "attacker_{$adminRole}@example.test",
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'role' => $adminRole,
            ]);

            $response->assertSessionHasErrors('role');
            $this->assertDatabaseMissing('users', [
                'email' => "attacker_{$adminRole}@example.test",
            ]);

            // Test against /daftar/pencari-kerja
            $respJs = $this->post(route('jobseeker.register.store'), [
                'name' => 'Attacker JS',
                'email' => "attacker_js_{$adminRole}@example.test",
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'role' => $adminRole,
            ]);

            $respJs->assertSessionHasErrors('role');
            $this->assertDatabaseMissing('users', [
                'email' => "attacker_js_{$adminRole}@example.test",
            ]);

            // Test against /daftar/perusahaan
            $respEmp = $this->post(route('employer.register.store'), [
                'name' => 'Attacker Emp',
                'email' => "attacker_emp_{$adminRole}@example.test",
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'role' => $adminRole,
            ]);

            $respEmp->assertSessionHasErrors('role');
            $this->assertDatabaseMissing('users', [
                'email' => "attacker_emp_{$adminRole}@example.test",
            ]);
        }

        $this->assertDatabaseCount('users', 0);
    }

    public function test_empty_or_unwhitelisted_role_is_rejected_and_no_account_is_created(): void
    {
        $invalidRoles = ['', null, 'superadmin', 'manager', 'guest', 'random_role'];

        foreach ($invalidRoles as $invalidRole) {
            $response = $this->post('/daftar', [
                'name' => 'Invalid User',
                'email' => 'invalid_role_test@example.test',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'role' => $invalidRole,
            ]);

            $response->assertSessionHasErrors('role');
            $this->assertDatabaseMissing('users', [
                'email' => 'invalid_role_test@example.test',
            ]);
        }

        $this->assertDatabaseCount('users', 0);
    }

    public function test_role_cannot_be_changed_via_profile_update_endpoint(): void
    {
        $user = User::factory()->create([
            'name' => 'User Asli',
            'email' => 'user_asli@example.test',
            'role' => 'job_seeker',
        ]);

        // Attempt to elevate to Admin via profile update
        $response = $this->actingAs($user)->putJson('/profil', [
            'name' => 'Nama Baru',
            'role' => 'admin',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['role']);

        $user->refresh();
        $this->assertSame('job_seeker', $user->role);
        $this->assertSame('User Asli', $user->name);

        // Attempt to switch to employer via profile update
        $responseSwitch = $this->actingAs($user)->putJson('/profil', [
            'name' => 'Nama Baru',
            'role' => 'employer',
        ]);

        $responseSwitch->assertStatus(422);
        $responseSwitch->assertJsonValidationErrors(['role']);

        $user->refresh();
        $this->assertSame('job_seeker', $user->role);

        // Valid name update without tampering role
        $validResp = $this->actingAs($user)->putJson('/profil', [
            'name' => 'Nama Sah',
        ]);

        $validResp->assertOk();
        $user->refresh();
        $this->assertSame('Nama Sah', $user->name);
        $this->assertSame('job_seeker', $user->role);
    }

    public function test_migration_and_rollback_safely_handles_role_column(): void
    {
        $this->assertTrue(Schema::hasColumn('users', 'role'));

        $path = 'database/migrations/2026_11_17_000001_add_role_to_users_table.php';
        $this->artisan('migrate:rollback', ['--path' => $path])->assertSuccessful();
        $this->assertFalse(Schema::hasColumn('users', 'role'));

        $this->artisan('migrate', ['--path' => $path])->assertSuccessful();
        $this->assertTrue(Schema::hasColumn('users', 'role'));
    }
}
