<?php

namespace Tests\Feature;

use App\Models\JobSeekerProfileDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JobSeekerProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_links_to_form_with_current_name(): void
    {
        $user = User::factory()->jobSeeker()->create(['name' => 'Nama Awal']);

        $this->actingAs($user)->get(route('dashboard.job_seeker'))
            ->assertOk()->assertSee('Lengkapi Profil')->assertSee(route('jobseeker.profile.edit'), false);

        $this->get(route('jobseeker.profile.edit'))
            ->assertOk()
            ->assertSeeInOrder(['Lengkapi Profil', 'Data Diri', 'CV', 'Riwayat Pendidikan', 'Pengalaman Kerja', 'Keterampilan'])
            ->assertSee('value="Nama Awal"', false)
            ->assertSee($user->email)
            ->assertSee('Belum ada CV yang diunggah.')
            ->assertSee('type="file"', false);
    }

    public function test_name_form_remains_available_before_detail_migration(): void
    {
        Schema::drop('job_seeker_profile_details');

        $this->actingAs(User::factory()->jobSeeker()->create())
            ->get(route('jobseeker.profile.edit'))->assertOk()
            ->assertSee('Simpan Data Diri')
            ->assertSee('Unggah, ganti, dan hapus CV belum tersedia')
            ->assertDontSee('type="file"', false);
    }

    public function test_sections_save_independently_and_display_saved_entries(): void
    {
        $user = User::factory()->jobSeeker()->create();
        $this->actingAs($user);
        $edit = route('jobseeker.profile.edit');
        $sections = [
            'education' => ['school' => 'Universitas Uji', 'program' => 'Teknik Informatika'],
            'experience' => ['company' => 'Perusahaan Uji', 'position' => 'Analis'],
            'skills' => ['name' => 'Analisis Data'],
        ];

        foreach ($sections as $section => $entry) {
            $this->patch(route('jobseeker.profile.section', $section), ['items' => [$entry]])
                ->assertRedirect($edit.'#'.$section)->assertSessionHasNoErrors();
        }

        $detail = JobSeekerProfileDetail::where('user_id', $user->id)->sole();
        foreach ($sections as $section => $entry) {
            $this->assertSame([$entry], $detail->{$section});
        }
        $this->get($edit)->assertOk()->assertSee('Universitas Uji')
            ->assertSee('Perusahaan Uji')->assertSee('Analisis Data');

        $this->from($edit)->patch(route('jobseeker.profile.section', 'education'), [
            'items' => [5 => ['school' => 'Sekolah Baru', 'program' => '']],
        ])->assertSessionHasErrorsIn('education', 'items.0.program');
        $this->get($edit)->assertSee('wajib diisi')->assertSee('Sekolah Baru');
        $this->assertSame([$sections['education']], $detail->fresh()->education);

        $this->patch(route('jobseeker.profile.section', 'skills'), [])->assertRedirect($edit.'#skills');
        $this->assertSame([], $detail->fresh()->skills);
    }

    public function test_cv_is_validated_private_replaceable_and_deletable(): void
    {
        Storage::fake('local');
        $owner = User::factory()->jobSeeker()->create();
        $this->actingAs($owner);
        $upload = route('jobseeker.profile.cv.upload');
        $download = route('jobseeker.profile.cv.download');
        $edit = route('jobseeker.profile.edit');
        $pdf = fn () => UploadedFile::fake()->createWithContent('cv.pdf', "%PDF-1.4\n%%EOF\n");

        $this->from($edit)->post($upload, ['cv' => UploadedFile::fake()->create('cv.txt')])
            ->assertSessionHasErrorsIn('cv', 'cv');
        $this->post($upload, ['cv' => $pdf()])->assertRedirect($edit.'#cv')->assertSessionHasNoErrors();
        $detail = JobSeekerProfileDetail::where('user_id', $owner->id)->sole();
        $original = $detail->cv_path;
        Storage::disk('local')->assertExists($original);
        $this->get($download)->assertOk()->assertDownload('CV.pdf');
        $this->actingAs(User::factory()->jobSeeker()->create())->get($download)->assertNotFound();

        $this->actingAs($owner)->post($upload, ['cv' => $pdf()])->assertRedirect($edit.'#cv');
        $replacement = $detail->fresh()->cv_path;
        Storage::disk('local')->assertExists($replacement);
        Storage::disk('local')->assertMissing($original);

        $this->delete(route('jobseeker.profile.cv.delete'))->assertRedirect($edit.'#cv');
        Storage::disk('local')->assertMissing($replacement);
        $this->get($download)->assertNotFound();
    }

    public function test_save_updates_only_the_logged_in_users_name_and_refreshes_form(): void
    {
        $user = User::factory()->jobSeeker()->create();
        $other = User::factory()->jobSeeker()->create(['name' => 'Pengguna Lain']);

        $this->actingAs($user)
            ->followingRedirects()
            ->patch(route('jobseeker.profile.update'), [
                'name' => 'Nama Terbaru',
                'id' => $other->id,
                'role' => User::ROLE_EMPLOYER,
                'email' => 'other@example.test',
            ])
            ->assertOk()
            ->assertSee('Profil berhasil diperbarui.')
            ->assertSee('value="Nama Terbaru"', false);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nama Terbaru',
            'email' => $user->email,
            'role' => User::ROLE_JOB_SEEKER,
        ]);
        $this->assertSame('Pengguna Lain', $other->fresh()->name);
    }

    public function test_validation_displays_error_below_name(): void
    {
        $user = User::factory()->jobSeeker()->create(['name' => 'Nama Awal']);
        $editUrl = route('jobseeker.profile.edit');

        $this->actingAs($user)->from($editUrl)
            ->patch(route('jobseeker.profile.update'), ['name' => '   '])
            ->assertRedirect($editUrl)->assertSessionHasErrors('name');

        $this->get($editUrl)->assertOk()
            ->assertSee('aria-describedby="name-error"', false)
            ->assertSee('Nama lengkap wajib diisi.');
        $this->assertSame('Nama Awal', $user->fresh()->name);
    }

    public function test_guest_and_employer_cannot_open_or_save_job_seeker_form(): void
    {
        $editUrl = route('jobseeker.profile.edit');
        $updateUrl = route('jobseeker.profile.update');
        $data = ['name' => 'Perubahan ilegal'];

        $this->get($editUrl)->assertRedirect(route('login'));
        $this->patch($updateUrl, $data)->assertRedirect(route('login'));
        $this->post(route('jobseeker.profile.cv.upload'))->assertRedirect(route('login'));

        $employer = User::factory()->employer()->create(['name' => 'Perusahaan']);
        $this->actingAs($employer)->get($editUrl)->assertForbidden();
        $this->patch($updateUrl, $data)->assertForbidden();
        $this->patch(route('jobseeker.profile.section', 'education'))->assertForbidden();
        $this->get(route('jobseeker.profile.cv.download'))->assertForbidden();
        $this->assertSame('Perusahaan', $employer->fresh()->name);

        $this->patchJson(route('profile.update'), ['name' => 'Nama Baru Perusahaan'])
            ->assertOk()->assertJsonPath('user.name', 'Nama Baru Perusahaan');
        $this->getJson(route('profile.show'))->assertOk()
            ->assertJsonPath('name', 'Nama Baru Perusahaan');
    }
}
