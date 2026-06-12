@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-md overflow-hidden border border-slate-100">
    <div class="p-6 border-b border-slate-100">
        <h5 class="text-lg font-bold text-slate-800">Tambah Artikel Baru</h5>
    </div>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">Judul Artikel</label>
                <input type="text" 
                       class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 @error('judul') border-red-500 @enderror" 
                       id="judul" 
                       name="judul" 
                       value="{{ old('judul') }}" 
                       placeholder="Masukkan judul artikel" 
                       required>
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="link" class="block text-sm font-semibold text-slate-700 mb-2">Link Artikel</label>
                <input type="url" 
                       class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 @error('link') border-red-500 @enderror" 
                       id="link" 
                       name="link" 
                       value="{{ old('link') }}" 
                       placeholder="https://example.com/artikel" 
                       required>
                @error('link')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="gambar" class="block text-sm font-semibold text-slate-700 mb-2">Gambar Sampul</label>
                <input type="file" 
                       class="w-full px-3 py-2 border rounded-xl focus:outline-none" 
                       id="gambar" 
                       name="gambar" 
                       accept="image/*">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-700 transition shadow-sm">
                    <i class="fas fa-plus mr-1"></i> Simpan Artikel
                </button>
                <a href="{{ route('admin.artikel.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200 transition border">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection