@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Catat Aktivitas</h1>
    <p class="text-sm text-slate-500">Masukkan kegiatan harian Anda di bawah ini.</p>
</div>

<form class="space-y-4">
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Aktivitas</label>
        <input type="text" placeholder="Contoh: Belajar Pemrograman PHP" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 bg-slate-50 text-sm">
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">Kategori</label>
        <select class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 bg-slate-50 text-sm">
            <option>Edukasi</option>
            <option>Kesehatan</option>
        </select>
    </div>

    <button type="button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition duration-200 shadow-md shadow-blue-200">
        Simpan Aktivitas
    </button>
</form>
@endsection