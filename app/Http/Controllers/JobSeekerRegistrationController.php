<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class JobSeekerRegistrationController extends Controller
{
    /**
     * Display the public registration form for job seekers.
     */
    public function create(): View
    {
        return view('auth.register-jobseeker');
    }

    /**
     * Create a job-seeker account with the job_seeker role.
     *
     * The role is strictly enforced by the server and never trusted from raw user input.
     * Any attempt to register as Admin or other unwhitelisted roles is explicitly rejected.
     */
    public function store(Request $request): RedirectResponse
    {
        // Explicitly check and reject privileged or unwhitelisted roles from form tampering
        if ($request->has('role')) {
            $rawRole = (string) $request->input('role');
            $normalizedRole = strtolower(trim($rawRole));

            if (in_array($normalizedRole, ['admin', 'administrator', 'superadmin'], true)) {
                return back()
                    ->withInput($request->except('password', 'password_confirmation'))
                    ->withErrors(['role' => 'Pendaftaran peran Admin tidak diizinkan melalui form publik.']);
            }

            if (! in_array($normalizedRole, ['job_seeker', 'jobseeker', 'pencari_kerja', 'pencari-kerja'], true)) {
                return back()
                    ->withInput($request->except('password', 'password_confirmation'))
                    ->withErrors(['role' => 'Peran yang dipilih tidak valid untuk pendaftaran pencari kerja.']);
            }
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal terdiri dari :min karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi belum sama.',
        ]);

        try {
            if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
                return $this->registrationDependencyUnavailable($request);
            }

            if (! in_array('role', (new User)->getFillable(), true)) {
                return $this->registrationDependencyUnavailable($request);
            }

            validator(
                ['email' => $validated['email']],
                ['email' => [Rule::unique('users', 'email')]],
                ['email.unique' => 'Alamat email tersebut sudah terdaftar.']
            )->validate();

            User::query()->create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => UserRole::JOB_SEEKER->value,
            ]);
        } catch (QueryException) {
            return $this->registrationDependencyUnavailable($request);
        }

        return redirect()
            ->route('jobseeker.register')
            ->with('status', 'Akun pencari kerja berhasil dibuat. Silakan masuk saat fitur autentikasi tersedia.');
    }

    private function registrationDependencyUnavailable(Request $request): RedirectResponse
    {
        return back()
            ->withInput($request->only(['name', 'email']))
            ->withErrors([
                'registration' => 'Pendaftaran belum dapat diproses karena penyimpanan akun dan peran pencari kerja belum tersedia. Silakan hubungi pengelola aplikasi.',
            ]);
    }
}
