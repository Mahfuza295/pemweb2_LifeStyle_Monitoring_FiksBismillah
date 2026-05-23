@extends('layouts.app')

@section('title', 'Dashboard Utama - Sistem Monitoring Sehat')

@section('content')
<!-- BARIS WELCOME & PENJELASAN -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang Kembali, Mahfuza!</h1>
    <p class="text-sm text-slate-500 mt-1">Berikut ringkasan indikator gaya hidup sehat Anda untuk pencegahan dini risiko Penyakit Tidak Menular (PTM).</p>
</div>

<!-- GRID KONTEN ATAS: SKOR KESEHATAN & REKOMENDASI HARIAN -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    
    <!-- KARTU SKOR KESEHATAN (Bobot Luas 1 Kolom) -->
    <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 rounded-2xl text-white shadow-lg shadow-blue-100 flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-start">
                <span class="text-xs font-medium opacity-80 uppercase tracking-wider block">Skor Kesehatan Harian</span>
                <div class="bg-white/20 p-2.5 rounded-xl text-xl backdrop-blur-sm">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-5xl font-black tracking-tight">{{ $skorKesehatan }}<span class="text-base font-normal opacity-60"> / 100</span></span>
            </div>
        </div>
        <div class="mt-6 pt-4 border-t border-white/10 text-xs opacity-90 flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-emerald-300 text-sm"></i>
            <span>Gaya hidup Anda masuk dalam kategori <strong class="text-emerald-300 font-bold">Sangat Sehat</strong>!</span>
        </div>
    </div>

    <!-- KARTU REKOMENDASI HARIAN (Bobot Luas 2 Kolom) -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col">
        <div class="flex items-center gap-2 mb-4">
            <span class="text-blue-600 text-lg"><i class="fa-solid fa-wand-magic-sparkles"></i></span>
            <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Rekomendasi Analisis Sistem</h2>
        </div>
        <div class="space-y-3.5 flex-1 flex flex-col justify-center">
            @foreach($rekomendasiHarian as $rekomendasi)
            <div class="flex gap-3 items-start bg-slate-50 p-3 rounded-xl border border-slate-100">
                <span class="text-blue-600 mt-0.5 text-xs bg-white p-1 rounded-md shadow-sm border border-slate-100">
                    <i class="fa-solid fa-lightbulb"></i>
                </span>
                <p class="text-xs text-slate-700 font-medium leading-relaxed">{{ $rekomendasi }}</p>
            </div>
            @endforeach
        </div>
    </div>

</div>

<!-- SECTION 2: RINGKASAN AKTIVITAS HARIAN (Menjadi 4 Kolom Sejajar Berjejer) -->
<div class="mb-4">
    <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Metrik Ringkasan Aktivitas</h2>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    
    <!-- Pola Makan -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4 hover:border-blue-300 transition duration-200">
        <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center text-xl shadow-inner">
            <i class="fa-solid fa-utensils"></i>
        </div>
        <div>
            <span class="text-[11px] text-slate-400 block font-semibold uppercase tracking-wider">Pola Makan</span>
            <span class="text-sm font-bold text-slate-800 block mt-0.5">{{ $ringkasanAktivitas['makan'] }}</span>
        </div>
    </div>

    <!-- Olahraga -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4 hover:border-blue-300 transition duration-200">
        <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center text-xl shadow-inner">
            <i class="fa-solid fa-person-running"></i>
        </div>
        <div>
            <span class="text-[11px] text-slate-400 block font-semibold uppercase tracking-wider">Olahraga</span>
            <span class="text-sm font-bold text-slate-800 block mt-0.5">{{ $ringkasanAktivitas['olahraga'] }}</span>
        </div>
    </div>

    <!-- Durasi Tidur -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4 hover:border-blue-300 transition duration-200">
        <div class="w-12 h-12 bg-indigo-50 text-indigo-500 rounded-xl flex items-center justify-center text-xl shadow-inner">
            <i class="fa-solid fa-bed"></i>
        </div>
        <div>
            <span class="text-[11px] text-slate-400 block font-semibold uppercase tracking-wider">Durasi Tidur</span>
            <span class="text-sm font-bold text-slate-800 block mt-0.5">{{ $ringkasanAktivitas['tidur'] }}</span>
        </div>
    </div>

    <!-- Air Minum -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4 hover:border-blue-300 transition duration-200">
        <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center text-xl shadow-inner">
            <i class="fa-solid fa-droplet"></i>
        </div>
        <div>
            <span class="text-[11px] text-slate-400 block font-semibold uppercase tracking-wider">Air Minum</span>
            <span class="text-sm font-bold text-slate-800 block mt-0.5">{{ $ringkasanAktivitas['air_minum'] }}</span>
        </div>
    </div>

</div>
@endsection