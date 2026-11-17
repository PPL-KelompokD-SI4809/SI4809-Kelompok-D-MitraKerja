<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Store a newly created user account.
     */
    public function store(StoreUserRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        try {
            $user = DB::transaction(function () use ($validated) {
                return User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => $validated['password'],
                    'role' => $validated['role'],
                ]);
            });

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Akun pengguna berhasil disimpan.',
                    'data' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                        'created_at' => $user->created_at,
                    ],
                ], 201);
            }

            return redirect()->back()->with('status', 'Akun pengguna berhasil dibuat.');
        } catch (Exception $e) {
            Log::error('Gagal menyimpan data akun pengguna: '.$e->getMessage(), [
                'exception' => $e,
                'email' => $validated['email'] ?? null,
            ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Terjadi kesalahan saat menyimpan data akun pengguna.',
                ], 500);
            }

            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data akun pengguna. Silakan coba lagi.']);
        }
    }
}
