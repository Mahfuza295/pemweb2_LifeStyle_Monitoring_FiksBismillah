<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. Tampil Daftar Artikel
    public function artikelIndex()
    {
        $artikels = Artikel::latest()->get();
        return view('admin.artikel.index', compact('artikels'));
    }

    // 2. Create
    public function artikelCreate()
    {
        return view('admin.artikel.create');
    }

    // 3. Store
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

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    // 4. Edit
    public function artikelEdit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.artikel.edit', compact('artikel'));
    }

    // 5. Update
    public function artikelUpdate(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        $artikel = Artikel::findOrFail($id);
        $artikel->update($request->only('judul', 'link'));

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diupdate!');
    }

    // 6. Delete
    public function artikelDelete($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}