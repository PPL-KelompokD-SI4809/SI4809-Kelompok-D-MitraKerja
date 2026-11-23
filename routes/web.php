
<?php

use App\Http\Controllers\CompanyRegistrationController;
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
Route::get('/daftar/perusahaan', [CompanyRegistrationController::class, 'create'])
    ->name('employer.register');

Route::post('/daftar/perusahaan', [CompanyRegistrationController::class, 'store'])
    ->name('employer.register.store');

// Unified Public Registration Endpoint
Route::post('/daftar', [RegistrationController::class, 'store'])
    ->name('register.store');

Route::post('/register', [RegistrationController::class, 'store'])
    ->name('register');

// Backend User Account Storage Endpoint (SKM-45)
Route::post('/users', [UserController::class, 'store'])
    ->name('users.store');

// ============================================================
// Route yang Memerlukan Login (auth)
// SKM-39
// ============================================================

Route::middleware(['auth'])->group(function () {

    // Profile routes
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::match(['put', 'patch'], '/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::match(['put', 'patch'], '/profile', [ProfileController::class, 'update']);

    // ============================================================
    // Route Khusus Pencari Kerja
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
    // Route Khusus Perusahaan
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
