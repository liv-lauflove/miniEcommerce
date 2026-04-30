<?php

namespace App\Http\Services\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Membuka halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Memproses data saat tombol daftar diklik
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20|unique:users,no_hp',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Membuka halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses saat tombol login diklik
    public function login(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'no_hp' => $request->no_hp,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors([
                'no_hp' => 'Nomor HP atau password salah.',
            ])
            ->onlyInput('no_hp');
    }

    // Memproses tombol logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}