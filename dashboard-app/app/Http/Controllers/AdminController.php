<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. Dashboard Admin
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // 2. Tampil Daftar Artikel
    public function artikelIndex()
    {
        $artikels = Artikel::latest()->get();
        return view('admin.artikel.index', compact('artikels'));
    }

    // 3. Tampil Form Tambah Artikel
    public function artikelCreate()
    {
        return view('admin.artikel.create');
    }

    // 4. Proses Simpan Artikel Baru ke Database
    public function artikelStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        Artikel::create([
            'judul' => $request->judul,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // 5. Tampil Form Edit Artikel (INI YANG KITA PERBAIKI)
    public function artikelEdit($id)
    {
        // Ambil data artikel asli dari DB berdasarkan ID
        $artikel = Artikel::findOrFail($id); 

        // Oper variabel $artikel ke view edit.blade.php
        return view('admin.artikel.edit', compact('artikel'));
    }

    // 6. Proses Update Data Artikel di Database
    public function artikelUpdate(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        $artikel = Artikel::findOrFail($id);
        $artikel->update([
            'judul' => $request->judul,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diupdate!');
    }

    // 7. Proses Hapus Artikel dari Database
    public function artikelDelete($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}