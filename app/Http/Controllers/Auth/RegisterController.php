<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:150', 'unique:users,email'],
            'phone'    => ['required', 'regex:/^(\+62|62|0)8[0-9]{8,12}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', 'in:visitor,tenant'],
        ], [
            'phone.regex'        => 'Format nomor telepon tidak valid (contoh: 081234567890).',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = new User();
        $user->forceFill([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'password' => $data['password'], // di-hash otomatis oleh cast 'hashed'
            'role'     => $data['role'],
        ])->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Akun berhasil dibuat. Selamat datang!');
    }
}