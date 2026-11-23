<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\JobSeekerRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/masuk', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('/masuk', [AuthenticatedSessionController::class, 'store'])
    ->middleware(['guest', 'throttle:5,1'])->name('login.store');
Route::view('/akun', 'auth.account')->middleware('auth')->name('account');
Route::post('/keluar', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')->name('logout');

Route::get('/daftar/pencari-kerja', [JobSeekerRegistrationController::class, 'create'])
    ->name('jobseeker.register');

Route::post('/daftar/pencari-kerja', [JobSeekerRegistrationController::class, 'store'])
    ->name('jobseeker.register.store');
