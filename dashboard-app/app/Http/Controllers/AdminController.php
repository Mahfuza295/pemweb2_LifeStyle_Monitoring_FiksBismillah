<?php

namespace App\Http\Controllers;
use App\Models\Artikel;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. Dashboard Admin
    public function dashboard()
    {
        // Mengarah ke resources/views/admin/dashboard.blade.php
        return view('admin.dashboard');
    }

    // 2. Tampil Daftar Artikel (Halaman yang Anda buka saat error)
    public function artikelIndex()
    {
        $artikels = Artikel::latest()->get();

        return view('admin.artikel.index', compact('artikels'));
    }

    // 3. Tampil Form Tambah Artikel
    public function artikelCreate()
    {
        // Mengarah ke resources/views/admin/artikel/create.blade.php
        return view('admin.artikel.create');
    }

    // 4. Proses Simpan Artikel Baru
    public function artikelStore(Request $request)
    {
        // Tulis logika simpan data Anda di sini nanti
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // 5. Tampil Form Edit Artikel
    public function artikelEdit($id)
    {
        // Mengarah ke resources/views/admin/artikel/edit.blade.php
        return view('admin.artikel.edit', compact('id'));
    }

    // 6. Proses Update Artikel
    public function artikelUpdate(Request $request, $id)
    {
        // Tulis logika update data Anda di sini nanti
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diupdate!');
    }

    // 7. Proses Hapus Artikel
    public function artikelDelete($id)
    {
        // Tulis logika hapus data Anda di sini nanti
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}