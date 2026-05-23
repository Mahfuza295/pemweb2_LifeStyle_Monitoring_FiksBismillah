@extends('layouts.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    @foreach($artikels as $artikel)

        <div class="bg-white rounded-lg shadow overflow-hidden">

            <!-- gambar -->
            <img src="{{ asset('gambar/' . $artikel->gambar) }}"
                 class="w-full h-48 object-cover"
                 alt="gambar artikel">

            <div class="p-4 text-center">

                <!-- judul -->
                <h5 class="font-semibold mb-3">
                    {{ $artikel->judul }}
                </h5>

                <!-- tombol -->
                <a href="{{ $artikel->link }}" target="_blank"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

                    Baca Artikel

                </a>

            </div>

        </div>

    @endforeach

</div>

@endsection