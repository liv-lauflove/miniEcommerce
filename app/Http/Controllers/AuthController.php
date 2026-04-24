<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Membuka halaman register
    public function showRegister()
    {
        return view('register');
    }

    // Memproses data saat tombol daftar diklik
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|unique:users,no_hp', // Nomor HP tidak boleh kembar
            'password' => 'required|string|min:6', // Password minimal 6 huruf
        ]);

        User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password), // Password disandikan/diacak
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Membuka halaman login
    public function showLogin()
    {
        return view('login');
    }

    // Memproses saat tombol login diklik
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'no_hp' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mengecek apakah nomor hp dan password cocok dengan database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Buat sesi login
            return redirect()->intended('/dashboard'); // Pindah ke halaman dalam
        }

        // Jika salah, tendang balik ke login dan kasih pesan error
        return back()->withErrors([
            'no_hp' => 'Nomor HP atau password salah.',
        ]);
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