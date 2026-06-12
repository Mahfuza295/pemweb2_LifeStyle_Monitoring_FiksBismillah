@extends('layouts.app')

@section('content')

<div class="mb-6 flex justify-between items-center">

    <h2 class="text-xl font-bold">Manajemen Artikel</h2>

    <a href="{{ route('admin.artikel.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        + Tambah Artikel
    </a>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($artikels as $artikel)
        <div class="bg-white shadow-md rounded-xl overflow-hidden">

            {{-- GAMBAR --}}
            <img src="{{ $artikel->gambar ?? 'https://via.placeholder.com/400x200' }}"
                 class="w-full h-40 object-cover">

            {{-- ISI --}}
            <div class="p-4">

                <h2 class="font-bold text-lg mb-2">
                    {{ $artikel->judul }}
                </h2>

                <p class="text-sm text-slate-500 mb-4">
                    {{ Str::limit($artikel->isi, 80) }}
                </p>

                {{-- BUTTON --}}
                <div class="flex gap-2">

                    {{-- EDIT --}}
                    <a href="{{ route('admin.artikel.edit', $artikel->id) }}"
                       class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Edit
                    </a>

                    {{-- HAPUS --}}
                    <form action="{{ route('admin.artikel.delete', $artikel->id) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                            Hapus
                        </button>
                    </form>

                </div>

            </div>

        </div>
    @endforeach

</div>

@endsection