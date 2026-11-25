<?php

namespace App\Http\Controllers;

use App\Models\JobSeekerProfileDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function editJobSeeker(Request $request): View
    {
        $user = $request->user();
        $detailsAvailable = Schema::hasTable('job_seeker_profile_details');

        return view('profile.job-seeker', [
            'user' => $user,
            'detailsAvailable' => $detailsAvailable,
            'details' => $detailsAvailable ? JobSeekerProfileDetail::where('user_id', $user->id)->first() : null,
            'sections' => JobSeekerProfileDetailController::SECTIONS,
        ]);
    }

    public function updateJobSeeker(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama lengkap harus berupa teks.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
        ]);

        $request->user()->update($validated);

        return redirect()->route('jobseeker.profile.edit')
            ->with('status', 'Profil berhasil diperbarui.');
    }

    /**
     * Display the authenticated user's profile and stored role.
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user() ?? Auth::user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'role_label' => $user->roleEnum()?->label() ?? $user->role,
        ]);
    }

    /**
     * Update user profile information.
     *
     * The role is immutable and cannot be changed through standard profile updates.
     */
    public function update(Request $request): JsonResponse
    {
        $user = $request->user() ?? Auth::user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Reject any attempt to tamper with role via profile update
        if ($request->has('role') && $request->input('role') !== $user->role) {
            throw ValidationException::withMessages([
                'role' => ['Peran akun tidak dapat diubah melalui pembaruan profil.'],
            ]);
        }

        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Profil berhasil diperbarui.',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ]);
    }
}
