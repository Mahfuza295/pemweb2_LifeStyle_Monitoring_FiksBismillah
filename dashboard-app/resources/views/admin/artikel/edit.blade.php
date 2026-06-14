@extends('layouts.app')

@section('content')

<!-- CARD DALAM EDIT -->
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-md overflow-hidden border border-slate-100">
    <div class="p-6 border-b border-slate-100">
        <h5 class="text-lg font-bold text-slate-800">Edit Artikel</h5>
    </div>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.artikel.update', $artikel->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">Judul Artikel</label>
                <input type="text" 
                       class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       id="judul" 
                       name="judul" 
                       value="{{ old('judul', $artikel->judul) }}" 
                       required>
            </div>

            <div class="mb-4">
                <label for="link" class="block text-sm font-semibold text-slate-700 mb-2">Link Artikel</label>
                <input type="url" 
                       class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       id="link" 
                       name="link" 
                       value="{{ old('link', $artikel->link) }}" 
                       required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar Sampul Saat Ini</label>
                @if($artikel->gambar)
                    <img src="{{ asset('gambar/' . $artikel->gambar) }}" class="w-40 h-24 object-cover rounded-lg mb-3 border">
                @endif
                <input type="file" class="w-full px-3 py-2 border rounded-xl" id="gambar" name="gambar" accept="image/*">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition shadow-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.artikel.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200 transition border">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection