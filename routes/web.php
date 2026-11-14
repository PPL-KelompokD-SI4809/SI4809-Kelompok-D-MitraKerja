<?php

use App\Http\Controllers\JobSeekerRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/masuk', 'auth.login')->name('login');

Route::get('/daftar/pencari-kerja', [JobSeekerRegistrationController::class, 'create'])
    ->name('jobseeker.register');

Route::post('/daftar/pencari-kerja', [JobSeekerRegistrationController::class, 'store'])
    ->name('jobseeker.register.store');
