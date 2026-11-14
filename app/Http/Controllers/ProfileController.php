<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
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
