<?php

namespace App\Http\Controllers;

use App\Models\JobSeekerProfileDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class JobSeekerProfileDetailController extends Controller
{
    public const SECTIONS = [
        'education' => ['Riwayat Pendidikan', ['school' => 'Nama institusi', 'program' => 'Jenjang atau jurusan']],
        'experience' => ['Pengalaman Kerja', ['company' => 'Nama perusahaan', 'position' => 'Posisi']],
        'skills' => ['Keterampilan', ['name' => 'Nama keterampilan']],
    ];

    public function update(Request $request, string $section): RedirectResponse
    {
        $items = $request->input('items');
        if (is_array($items)) {
            $request->merge(['items' => array_values($items)]);
        }

        $fields = self::SECTIONS[$section][1];
        $rules = ['items' => ['sometimes', 'array', 'max:30']];
        $rules['items.*'] = ['array:'.implode(',', array_keys($fields))];
        $attributes = [];
        foreach ($fields as $field => $label) {
            $rules['items.*.'.$field] = ['required', 'string', 'max:160'];
            $attributes['items.*.'.$field] = strtolower($label);
        }

        $validated = $request->validateWithBag($section, $rules, [
            'items.max' => 'Maksimal 30 entri per bagian.',
            'items.array' => 'Format daftar entri tidak valid.',
            'items.*.*.required' => 'Kolom :attribute wajib diisi.',
            'items.*.*.string' => 'Kolom :attribute harus berupa teks.',
            'items.*.*.max' => 'Kolom :attribute maksimal 160 karakter.',
        ], $attributes);

        JobSeekerProfileDetail::updateOrCreate(
            ['user_id' => $request->user()->id],
            [$section => array_values($validated['items'] ?? [])],
        );

        return $this->saved($section, self::SECTIONS[$section][0].' berhasil disimpan.');
    }

    public function uploadCv(Request $request): RedirectResponse
    {
        $request->validateWithBag('cv', ['cv' => ['required', 'file', 'mimes:pdf', 'extensions:pdf', 'max:5120']], [
            'cv.required' => 'Pilih berkas CV.',
            'cv.mimes' => 'CV harus berupa PDF.',
            'cv.extensions' => 'Gunakan ekstensi .pdf.',
            'cv.max' => 'Ukuran CV maksimal 5 MB.',
        ]);

        $path = $request->file('cv')->store('job-seeker-cvs/'.$request->user()->id, 'local');
        if ($path === false) {
            throw ValidationException::withMessages(['cv' => 'CV gagal disimpan. Silakan coba lagi.'])->errorBag('cv');
        }

        try {
            $oldPath = $this->replaceCv($request->user(), $path);
        } catch (Throwable $error) {
            Storage::disk('local')->delete($path);
            throw $error;
        }

        if ($oldPath !== null) {
            Storage::disk('local')->delete($oldPath);
        }

        return $this->saved('cv', 'CV berhasil disimpan.');
    }

    public function downloadCv(Request $request): StreamedResponse
    {
        $path = JobSeekerProfileDetail::where('user_id', $request->user()->id)->value('cv_path');
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return Storage::disk('local')->download($path, 'CV.pdf', ['Content-Type' => 'application/pdf']);
    }

    public function deleteCv(Request $request): RedirectResponse
    {
        $path = $this->replaceCv($request->user(), null);
        if ($path !== null) {
            Storage::disk('local')->delete($path);
        }

        return $this->saved('cv', 'CV berhasil dihapus.');
    }

    private function replaceCv(User $user, ?string $path): ?string
    {
        return DB::transaction(function () use ($user, $path) {
            User::query()->lockForUpdate()->findOrFail($user->id);
            $detail = JobSeekerProfileDetail::firstOrCreate(['user_id' => $user->id]);
            $oldPath = $detail->cv_path;
            $detail->update(['cv_path' => $path]);

            return $oldPath;
        });
    }

    private function saved(string $section, string $message): RedirectResponse
    {
        return redirect(route('jobseeker.profile.edit').'#'.$section)
            ->with('profile_detail_status.'.$section, $message);
    }
}
