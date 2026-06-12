@extends('layouts.app')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Manajemen Artikel</h2>
            <p class="text-sm text-slate-400">Kelola konten edukasi kesehatan</p>
        </div>
        <a href="{{ route('admin.artikel.create') }}"
            class="bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition font-medium shadow-sm flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Artikel
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($artikels as $artikel)
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-slate-100 flex flex-col justify-between">
                <div>
                    {{-- Tampilan Gambar --}}
                    <img src="{{ $artikel->gambar ? asset('gambar/' . $artikel->gambar) : 'https://via.placeholder.com/400x200' }}"
                        class="w-full h-44 object-cover" alt="Gambar Artikel">

                    <div class="p-5">
                        <h2 class="font-bold text-lg text-slate-800 mb-2 line-clamp-2">
                            {{ $artikel->judul }}
                        </h2>
                        <p class="text-sm text-slate-400 mb-4 line-clamp-3">
                            {{ $artikel->link }}
                        </p>
                    </div>
                </div>

                <div class="p-5 pt-0 border-t border-slate-50 mt-auto flex items-center gap-2">
                    <a href="{{ route('admin.artikel.edit', $artikel->id) }}"
                        class="flex-1 text-center px-3 py-2 bg-amber-500 text-white rounded-xl hover:bg-amber-600 transition text-sm font-medium">
                        Edit
                    </a>
                    <form action="{{ route('admin.artikel.delete', $artikel->id) }}" method="POST" class="flex-1"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full px-3 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition text-sm font-medium">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection