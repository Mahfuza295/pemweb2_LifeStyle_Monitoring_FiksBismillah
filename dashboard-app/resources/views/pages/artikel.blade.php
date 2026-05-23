@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Artikel Pilihan</h1>
    <p class="text-sm text-slate-500">Edukasi dan tips pengembangan diri.</p>
</div>

<div class="space-y-4">
    <!-- Card Artikel 1 -->
    <div class="flex gap-4 p-3 rounded-xl border border-slate-100 hover:bg-slate-50 transition cursor-pointer">
        <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
            <i class="fa-solid fa-code text-2xl"></i>
        </div>
        <div>
            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Coding</span>
            <h3 class="font-bold text-slate-800 text-sm mt-0.5 line-clamp-2">Cara Memulai Belajar Framework Laravel 11 untuk Pemula</h3>
        </div>
    </div>

    <!-- Card Artikel 2 -->
    <div class="flex gap-4 p-3 rounded-xl border border-slate-100 hover:bg-slate-50 transition cursor-pointer">
        <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
            <i class="fa-solid fa-palette text-2xl"></i>
        </div>
        <div>
            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Desain</span>
            <h3 class="font-bold text-slate-800 text-sm mt-0.5 line-clamp-2">Tips Memilih Palet Warna Putih Biru yang Bagus untuk UI/UX</h3>
        </div>
    </div>
</div>
@endsection