@extends('layouts.app')

@section('title', 'Dashboard Utama')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
       Halo, Hidup Sehat!
    </h1>
    <p class="text-slate-500 mt-2">
        Berikut ringkasan aktivitas dan kesehatan harian Anda.
    </p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    <div class="bg-blue-600 text-white p-6 rounded-2xl shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm opacity-80">
                    Skor Kesehatan
                </p>
                <h2 class="text-5xl font-bold mt-2">
                    {{ $skorKesehatan }}
                    <span class="text-lg font-normal">/100</span>
                </h2>
            </div>
            <div class="bg-white/20 w-14 h-14 rounded-xl flex items-center justify-center text-2xl">
                <i class="fa-solid fa-heart-pulse"></i>
            </div>
        </div>

        <div class="mt-6 border-t border-white/20 pt-4 text-sm">
            @if($skorKesehatan >= 80)
                <i class="fa-solid fa-circle-check text-green-300"></i> Kondisi kesehatan Anda sangat baik.
            @elseif($skorKesehatan >= 60)
                <i class="fa-solid fa-circle-exclamation text-yellow-300"></i> Kondisi kesehatan Anda cukup baik, tetap jaga pola hidup.
            @elseif($skorKesehatan >= 40)
                <i class="fa-solid fa-triangle-exclamation text-orange-300"></i> Kondisi kesehatan Anda kurang baik, perlu diperbaiki.
            @else
                <i class="fa-solid fa-xmark text-red-300"></i> Kondisi kesehatan Anda buruk, segera perbaiki gaya hidup.
            @endif
        </div>
    </div>

    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border">
        <div class="flex items-center gap-2 mb-5">
            <i class="fa-solid fa-lightbulb text-blue-600"></i>
            <h2 class="font-bold text-slate-700">
                Rekomendasi Harian
            </h2>
        </div>

        <div class="space-y-3">
            @foreach($rekomendasiHarian as $rekomendasi)
            <div class="bg-slate-50 border rounded-xl p-3 flex gap-3 items-start">
                <div class="text-blue-600 mt-1">
                    <i class="fa-solid fa-check"></i>
                </div>
                <p class="text-sm text-slate-700">
                    {{ $rekomendasi }}
                </p>
            </div>
            @endforeach
        </div>
    </div>

</div>

<div class="mb-4">
    <h2 class="text-lg font-bold text-slate-800">
        Ringkasan Aktivitas
    </h2>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

    <div class="bg-white p-5 rounded-2xl shadow-sm border hover:shadow-md transition">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-orange-100 text-orange-500 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-utensils"></i>
            </div>
            <div>
                <p class="text-sm text-slate-400">
                    Pola Makan
                </p>
                <h3 class="font-bold text-slate-800">
                    {{ $ringkasanAktivitas['makan'] }}
                </h3>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow-sm border border-red-100 hover:shadow-md transition bg-gradient-to-br from-white to-red-50/20">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-red-100 text-red-500 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-fire"></i>
            </div>
            <div>
                <p class="text-sm text-slate-400">
                    Energi Masuk
                </p>
                <h3 class="font-bold text-red-600">
                    {{ $ringkasanAktivitas['kalori'] }}
                </h3>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow-sm border hover:shadow-md transition">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-green-100 text-green-500 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-person-running"></i>
            </div>
            <div>
                <p class="text-sm text-slate-400">
                    Olahraga
                </p>
                <h3 class="font-bold text-slate-800">
                    {{ $ringkasanAktivitas['olahraga'] }}
                </h3>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow-sm border hover:shadow-md transition">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-indigo-100 text-indigo-500 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-bed"></i>
            </div>
            <div>
                <p class="text-sm text-slate-400">
                    Durasi Tidur
                </p>
                <h3 class="font-bold text-slate-800">
                    {{ $ringkasanAktivitas['tidur'] }}
                </h3>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow-sm border hover:shadow-md transition">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-blue-100 text-blue-500 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-droplet"></i>
            </div>
            <div>
                <p class="text-sm text-slate-400">
                    Air Minum
                </p>
                <h3 class="font-bold text-slate-800">
                    {{ $ringkasanAktivitas['air_minum'] }}
                </h3>
            </div>
        </div>
    </div>

</div>

@endsection