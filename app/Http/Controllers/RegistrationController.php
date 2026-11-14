<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class RegistrationController extends Controller
{
    /**
     * Handle public registration where registration type / role is specified.
     *
     * Whitelists only 'job_seeker' and 'employer'. Explicitly rejects 'admin'
     * and any non-whitelisted roles, ensuring roles are never trusted raw.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        // Require role / registration type
        $request->validate([
            'role' => ['required', 'string'],
        ], [
            'role.required' => 'Pilihan peran / tipe registrasi wajib diisi.',
        ]);

        $rawRole = (string) $request->input('role');
        $normalizedRole = strtolower(trim($rawRole));

        // Explicit rejection of Admin variations
        if (in_array($normalizedRole, ['admin', 'administrator', 'superadmin'], true)) {
            throw ValidationException::withMessages([
                'role' => ['Pendaftaran peran Admin tidak diizinkan melalui form publik.'],
            ]);
        }

        // Whitelist validation
        $resolvedRole = UserRole::fromRegistrationType($normalizedRole);
        if ($resolvedRole === null) {
            throw ValidationException::withMessages([
                'role' => ['Peran yang dipilih tidak valid. Pilihan hanya pencari kerja atau perusahaan.'],
            ]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap / perusahaan wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'email.unique' => 'Alamat email tersebut sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal terdiri dari :min karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi belum sama.',
        ]);

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $resolvedRole->value,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Akun berhasil dibuat.',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
            ], 201);
        }

        $redirectRoute = $resolvedRole === UserRole::JOB_SEEKER ? 'jobseeker.register' : 'employer.register';

        return redirect()
            ->route($redirectRoute)
            ->with('status', "Akun {$resolvedRole->label()} berhasil dibuat. Silakan masuk saat fitur autentikasi tersedia.");
    }
}
