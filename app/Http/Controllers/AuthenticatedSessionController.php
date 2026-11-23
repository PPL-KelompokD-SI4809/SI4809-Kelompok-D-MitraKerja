<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    private const ROLES = [
        User::ROLE_JOB_SEEKER => 'Pencari kerja',
        User::ROLE_EMPLOYER => 'Pemberi kerja',
    ];

    public function create(Request $request): View|RedirectResponse
    {
        if ($request->user()) {
            return redirect()->to($this->destination($request));
        }

        $role = $request->query('role');
        $role = is_string($role) && isset(self::ROLES[$role]) ? $role : null;

        return view('auth.login', ['role' => $role, 'roles' => self::ROLES]);
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'role' => ['required', 'string', Rule::in(array_keys(self::ROLES))],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:4096'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        try {
            $authenticated = Auth::attempt($credentials);
        } catch (QueryException) {
            throw ValidationException::withMessages([
                'email' => 'Layanan masuk sedang tidak tersedia. Silakan coba kembali nanti.',
            ]);
        }

        if (! $authenticated) {
            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi tidak sesuai.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->to($this->destination($request));
    }

    public function destination(Request $request): string
    {
        // SKM-36 must supply the role contract and existing dashboard route names.
        $role = $request->user()->getAttribute('role');
        $route = is_string($role) ? config('auth.role_home_routes.'.$role) : null;

        return is_string($route) && Route::has($route) ? route($route) : route('account');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
