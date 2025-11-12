<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // 🩵 Halaman Login
    public function indexLogin()
    {
        return view('auth.login');
    }

    // 🩷 Proses Login
    public function proses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // regenerate session agar user benar-benar login
            $request->session()->regenerate();

            // ambil user login
            $user = Auth::user();

            // arahkan ke dashboard utama
            return redirect()->route('dashboard.index')->with('success', 'Login berhasil!');
        }

        // jika gagal login
        return back()->with('error', 'Email atau Password salah.')->onlyInput('email');
    }

    // 💛 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', 'Anda telah logout.');
    }

    // 💚 Halaman Register
    public function register()
    {
        return view('auth.register');
    }

    // 💙 Proses Register
    public function storeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'user', // default user biasa
        ]);

        return redirect()->route('auth.login')->with('success', 'Pendaftaran berhasil, silakan login.');
    }
}
