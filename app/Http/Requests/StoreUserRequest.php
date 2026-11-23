<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email:rfc',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('user')?->id ?? $this->route('user')),
            ],
            'password' => [
                'required',
                'string',
                Password::min(8),
                Rule::when($this->has('password_confirmation'), ['confirmed']),
            ],
            'role' => [
                'required',
                'string',
                Rule::in(UserRole::values()),
            ],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama harus berupa teks yang valid.',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.string' => 'Alamat email harus berupa teks yang valid.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.max' => 'Alamat email tidak boleh lebih dari :max karakter.',
            'email.unique' => 'Alamat email tersebut sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks yang valid.',
            'password.min' => 'Kata sandi minimal terdiri dari :min karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'role.required' => 'Peran akun wajib dipilih.',
            'role.string' => 'Peran akun harus berupa teks yang valid.',
            'role.in' => 'Peran akun yang dipilih tidak valid.',
        ];
    }
}
