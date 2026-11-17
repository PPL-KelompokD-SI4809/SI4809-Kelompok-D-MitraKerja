<?php

use App\Http\Controllers\EmployerRegistrationController;
use App\Http\Controllers\JobSeekerRegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ============================================================
// Route Publik (tanpa login)
// ============================================================

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/masuk', 'auth.login')->name('login');

// Pencari Kerja Registration Routes
Route::get('/daftar/pencari-kerja', [JobSeekerRegistrationController::class, 'create'])
    ->name('jobseeker.register');

Route::post('/daftar/pencari-kerja', [JobSeekerRegistrationController::class, 'store'])
    ->name('jobseeker.register.store');

// Perusahaan / Employer Registration Routes
Route::get('/daftar/perusahaan', [EmployerRegistrationController::class, 'create'])
    ->name('employer.register');

Route::post('/daftar/perusahaan', [EmployerRegistrationController::class, 'store'])
    ->name('employer.register.store');

// Unified Public Registration Endpoint (Whitelists role: job_seeker, employer)
Route::post('/daftar', [RegistrationController::class, 'store'])
    ->name('register.store');

Route::post('/register', [RegistrationController::class, 'store'])
    ->name('register');

// ============================================================
// Route yang Memerlukan Login (auth)
// SKM-39: Lindungi route yang memerlukan login
// ============================================================

Route::middleware(['auth'])->group(function () {

    // Profile & Role inspection and updates (role cannot be changed via profile)
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::match(['put', 'patch'], '/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::match(['put', 'patch'], '/profile', [ProfileController::class, 'update']);

    // ============================================================
    // Route Khusus Pencari Kerja (job_seeker)
    // SKM-39: Batasi route berdasarkan peran pencari kerja
    // ============================================================
    Route::middleware(['role:job_seeker'])->group(function () {
        Route::get('/dashboard/pencari-kerja', function () {
            return view('dashboard.job-seeker');
        })->name('dashboard.job_seeker');

        Route::get('/lowongan', function () {
            return response()->json(['message' => 'Daftar lowongan untuk pencari kerja']);
        })->name('lowongan.index');
    });

    // ============================================================
    // Route Khusus Perusahaan (employer)
    // SKM-39: Batasi route berdasarkan peran perusahaan
    // ============================================================
    Route::middleware(['role:employer'])->group(function () {
        Route::get('/dashboard/perusahaan', function () {
            return view('dashboard.employer');
        })->name('dashboard.employer');

        Route::get('/kelola-lowongan', function () {
            return response()->json(['message' => 'Kelola lowongan untuk perusahaan']);
        })->name('kelola-lowongan.index');
    });
});


