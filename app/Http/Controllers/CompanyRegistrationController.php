<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyRegistrationController extends EmployerRegistrationController
{
    public function create(): View
    {
        return view('auth.register-company');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the optional input type before the shared controller normalizes it.
        $request->validate([
            'role' => ['sometimes', 'string'],
        ], [
            'role.string' => 'Peran akun yang dipilih tidak valid.',
        ]);

        // Reuse SKM-36/45 validation, role enforcement, hashing, and account storage.
        return parent::store($request);
    }
}
