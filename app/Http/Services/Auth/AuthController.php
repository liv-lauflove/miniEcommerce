<?php

namespace App\Http\Services\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\RoleBasedRedirectorFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // FACTORY METHOD PATTERN — Inject factory via constructor (Dependency Injection)
    public function __construct(
        private RoleBasedRedirectorFactory $redirectorFactory
    ) {}

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|unique:users,no_hp',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'no_hp' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // FACTORY METHOD PATTERN
            // Menggunakan factory untuk membuat redirector sesuai role user.
            // Factory akan memanggil createRedirector() yang mengembalikan
            // concrete redirector (OwnerRedirector, AdminRedirector, atau UserRedirector).
            // Menambah role baru cukup buat class Redirector baru + tambah entry di factory.
            $user = auth()->user();

            return $this->redirectorFactory->redirect($user);
        }

        return back()->withErrors([
            'no_hp' => 'Nomor HP atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
