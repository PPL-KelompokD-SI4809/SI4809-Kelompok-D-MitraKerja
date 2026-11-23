<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware: Batasi akses route berdasarkan peran pengguna.
 *
 * Penggunaan di route:
 *   ->middleware('role:job_seeker')
 *   ->middleware('role:employer')
 *   ->middleware('role:job_seeker,employer')   // salah satu boleh
 *
 * Jika pengguna belum login, middleware Laravel `auth` yang menangani redirect.
 * Middleware ini hanya memeriksa kolom `role` pada User yang sudah ter-autentikasi.
 *
 * SKM-39 — Zidan
 */
class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  Satu atau lebih role yang diizinkan (nilai dari UserRole enum)
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // Jika belum login, kembalikan 403 (seharusnya sudah ditangkap middleware `auth`)
        if (! $user) {
            abort(403, 'Anda harus login terlebih dahulu.');
        }

        // Periksa apakah role user termasuk dalam daftar role yang diizinkan
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }
        }

        // Role tidak sesuai — tolak akses
        abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
