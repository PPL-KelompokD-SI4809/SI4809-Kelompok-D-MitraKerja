<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * SKM-39: Tes pembatasan akses halaman berdasarkan peran.
 *
 * Skenario yang diuji:
 * 1. Pengguna tanpa login (guest) diarahkan ke halaman login.
 * 2. Pencari kerja TIDAK bisa mengakses halaman perusahaan (403).
 * 3. Perusahaan TIDAK bisa mengakses halaman pencari kerja (403).
 * 4. Pencari kerja BISA mengakses halaman pencari kerja (200).
 * 5. Perusahaan BISA mengakses halaman perusahaan (200).
 * 6. Profil hanya bisa diakses oleh pengguna yang sudah login.
 * 7. Akses langsung via URL juga ditolak di server (bukan hanya menu tersembunyi).
 *
 * @author Zidan
 */
class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    // ================================================================
    // 1. Guest (belum login) diarahkan ke halaman login
    // ================================================================

    public function test_guest_cannot_access_job_seeker_dashboard(): void
    {
        $response = $this->get('/dashboard/pencari-kerja');
        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_employer_dashboard(): void
    {
        $response = $this->get('/dashboard/perusahaan');
        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_profile_page(): void
    {
        $response = $this->get('/profil');
        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_lowongan(): void
    {
        $response = $this->get('/lowongan');
        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_kelola_lowongan(): void
    {
        $response = $this->get('/kelola-lowongan');
        $response->assertRedirect(route('login'));
    }

    // ================================================================
    // 2. Pencari Kerja mengakses halaman perusahaan → 403
    // ================================================================

    public function test_job_seeker_cannot_access_employer_dashboard(): void
    {
        $jobSeeker = User::factory()->jobSeeker()->create();

        $response = $this->actingAs($jobSeeker)->get('/dashboard/perusahaan');
        $response->assertStatus(403);
    }

    public function test_job_seeker_cannot_access_kelola_lowongan(): void
    {
        $jobSeeker = User::factory()->jobSeeker()->create();

        $response = $this->actingAs($jobSeeker)->get('/kelola-lowongan');
        $response->assertStatus(403);
    }

    // ================================================================
    // 3. Perusahaan mengakses halaman pencari kerja → 403
    // ================================================================

    public function test_employer_cannot_access_job_seeker_dashboard(): void
    {
        $employer = User::factory()->employer()->create();

        $response = $this->actingAs($employer)->get('/dashboard/pencari-kerja');
        $response->assertStatus(403);
    }

    public function test_employer_cannot_access_lowongan(): void
    {
        $employer = User::factory()->employer()->create();

        $response = $this->actingAs($employer)->get('/lowongan');
        $response->assertStatus(403);
    }

    // ================================================================
    // 4. Pencari Kerja mengakses halaman sendiri → 200
    // ================================================================

    public function test_job_seeker_can_access_own_dashboard(): void
    {
        $jobSeeker = User::factory()->jobSeeker()->create();

        $response = $this->actingAs($jobSeeker)->get('/dashboard/pencari-kerja');
        $response->assertStatus(200);
    }

    public function test_job_seeker_can_access_lowongan(): void
    {
        $jobSeeker = User::factory()->jobSeeker()->create();

        $response = $this->actingAs($jobSeeker)->get('/lowongan');
        $response->assertStatus(200);
    }

    // ================================================================
    // 5. Perusahaan mengakses halaman sendiri → 200
    // ================================================================

    public function test_employer_can_access_own_dashboard(): void
    {
        $employer = User::factory()->employer()->create();

        $response = $this->actingAs($employer)->get('/dashboard/perusahaan');
        $response->assertStatus(200);
    }

    public function test_employer_can_access_kelola_lowongan(): void
    {
        $employer = User::factory()->employer()->create();

        $response = $this->actingAs($employer)->get('/kelola-lowongan');
        $response->assertStatus(200);
    }

    // ================================================================
    // 6. Profil bisa diakses oleh semua pengguna yang sudah login
    // ================================================================

    public function test_job_seeker_can_access_profile(): void
    {
        $jobSeeker = User::factory()->jobSeeker()->create();

        $response = $this->actingAs($jobSeeker)->get('/profil');
        $response->assertStatus(200);
    }

    public function test_employer_can_access_profile(): void
    {
        $employer = User::factory()->employer()->create();

        $response = $this->actingAs($employer)->get('/profil');
        $response->assertStatus(200);
    }

    // ================================================================
    // 7. Akses langsung via URL (server-side check, bukan hanya menu)
    //    Memastikan proteksi bukan hanya menyembunyikan menu di frontend
    // ================================================================

    public function test_direct_url_access_job_seeker_dashboard_by_employer_is_forbidden(): void
    {
        $employer = User::factory()->employer()->create();

        // Simulasi akses langsung via URL (seperti ketik di address bar)
        $response = $this->actingAs($employer)
            ->get('/dashboard/pencari-kerja', ['HTTP_REFERER' => '']);
        $response->assertStatus(403);
    }

    public function test_direct_url_access_employer_dashboard_by_job_seeker_is_forbidden(): void
    {
        $jobSeeker = User::factory()->jobSeeker()->create();

        // Simulasi akses langsung via URL (seperti ketik di address bar)
        $response = $this->actingAs($jobSeeker)
            ->get('/dashboard/perusahaan', ['HTTP_REFERER' => '']);
        $response->assertStatus(403);
    }
}
