<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cukup lakukan pengecekan Auth::attempt sekali saja
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // ini WAJIB
            return redirect()->route('dashboard');
        }

        // Kembalikan ke halaman login dengan pesan error jika email/password salah
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    } // <-- Kurung kurawal penutup fungsi login sekarang sudah ada

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // Pastikan di form input ada name="password_confirmation"
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'pengguna',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Berhasil logout.');
    }
}