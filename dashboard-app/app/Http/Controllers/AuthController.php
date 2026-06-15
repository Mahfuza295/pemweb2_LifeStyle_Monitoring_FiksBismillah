<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman/form login ke layar pengguna
     */
    public function showLogin()
    {
        // Memanggil file view yang berada di folder resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Memproses data yang dikirim dari form login
     */
    public function login(Request $request)
    {
        // 1. Validasi Input: Memastikan email wajib diisi & berformat email, serta password wajib diisi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Autentikasi: Mencocokkan data input ($credentials) dengan data yang ada di database
        if (Auth::attempt($credentials)) {
            // Jika cocok, amankan session pengguna dari serangan session fixation
            $request->session()->regenerate(); 
            
            // Alihkan pengguna masuk ke halaman utama/dashboard setelah sukses login
            return redirect()->route('dashboard');
        }

        // 3. Penanganan Error: Jika email atau password tidak cocok di database, kembalikan ke form login
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email'); // Mempertahankan input email terakhir agar user tidak perlu ngetik ulang
    }

    /**
     * Menampilkan halaman/form registrasi akun baru
     */
    public function showRegister()
    {
        // Memanggil file view yang berada di folder resources/views/auth/register.blade.php
        return view('auth.register');
    }

    /**
     * Memproses pendaftaran akun baru ke database
     */
    public function register(Request $request)
    {
        // 1. Validasi Input: Memastikan nama valid, email belum terdaftar (unique), dan password minimal 6 karakter
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Menolak jika email sudah terdaftar di tabel users
            'password' => 'required|min:6|confirmed', // 'confirmed' mewajibkan adanya input bernama password_confirmation
        ]);

        // 2. Menyimpan Data: Membuat baris baru di tabel database 'users'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'pengguna', // Akun baru yang mendaftar otomatis dikunci perannya sebagai 'pengguna' biasa
            'password' => Hash::make($request->password), // Mengacak/meng-enkripsi password agar aman di database
        ]);

        // 3. Otomatis Login: Setelah berhasil mendaftar, user langsung otomatis masuk ke sistem
        Auth::login($user);

        // Alihkan pengguna yang baru mendaftar ke halaman dashboard
        return redirect()->route('dashboard');
    }

    /**
     * Proses untuk mengeluarkan pengguna dari sistem (Logout)
     */
    public function logout(Request $request)
    {
        // 1. Menghapus status login pengguna di Laravel
        Auth::logout();

        // 2. Menghancurkan session aktif saat ini agar tidak bisa disalahgunakan
        $request->session()->invalidate();

        // 3. Membuat ulang token CSRF baru untuk keamanan form berikutnya
        $request->session()->regenerateToken();

        // 4. Melempar kembali pengguna ke halaman login dengan membawa pesan sukses
        return redirect('/login')
            ->with('success', 'Berhasil logout.');
    }
}