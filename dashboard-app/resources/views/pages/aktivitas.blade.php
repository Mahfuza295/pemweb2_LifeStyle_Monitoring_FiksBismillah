@extends('layouts.app')

@section('title', 'Input Aktivitas')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Catat Aktivitas Kesehatan</h1>
    <p class="text-sm text-slate-500">Masukkan aktivitas makan, olahraga, tidur, dan air minum harian Anda.</p>
</div>

@if (session('success'))
    <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        <i class="fa-solid fa-circle-check mr-2"></i>
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <p class="font-semibold mb-2">Ada data yang belum benar:</p>
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border p-6">
        <form method="POST" action="{{ route('aktivitas.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 bg-slate-50 text-sm">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Makan</label>
                    <div class="relative">
                        <input type="number" name="makan" min="0" max="10" value="{{ old('makan', 3) }}" required
                            class="w-full px-4 py-3 pr-16 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 bg-slate-50 text-sm">
                        <span class="absolute right-4 top-3 text-sm text-slate-400">kali</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Olahraga</label>
                    <div class="relative">
                        <input type="number" name="olahraga" min="0" max="300" value="{{ old('olahraga', 30) }}" required
                            class="w-full px-4 py-3 pr-20 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 bg-slate-50 text-sm">
                        <span class="absolute right-4 top-3 text-sm text-slate-400">menit</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Tidur</label>
                    <div class="relative">
                        <input type="number" step="0.1" name="tidur" min="0" max="24" value="{{ old('tidur', 7) }}" required
                            class="w-full px-4 py-3 pr-16 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 bg-slate-50 text-sm">
                        <span class="absolute right-4 top-3 text-sm text-slate-400">jam</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Air Minum</label>
                    <div class="relative">
                        <input type="number" name="air_minum" min="0" max="30" value="{{ old('air_minum', 8) }}" required
                            class="w-full px-4 py-3 pr-16 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 bg-slate-50 text-sm">
                        <span class="absolute right-4 top-3 text-sm text-slate-400">gelas</span>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Catatan</label>
                <textarea name="catatan" rows="4" placeholder="Contoh: hari ini badan terasa segar"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 bg-slate-50 text-sm">{{ old('catatan') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition duration-200 shadow-md shadow-blue-200">
                <i class="fa-solid fa-floppy-disk mr-2"></i>
                Simpan Aktivitas
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-11 h-11 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                <i class="fa-solid fa-heart-pulse"></i>
            </div>
            <div>
                <h2 class="font-bold text-slate-800">Rumus Skor</h2>
                <p class="text-xs text-slate-400">Skor dihitung otomatis</p>
            </div>
        </div>

        <div class="space-y-3 text-sm text-slate-600">
            <div class="flex justify-between bg-slate-50 rounded-xl px-3 py-2">
                <span>Makan maksimal</span>
                <span class="font-semibold">30 poin</span>
            </div>
            <div class="flex justify-between bg-slate-50 rounded-xl px-3 py-2">
                <span>Olahraga maksimal</span>
                <span class="font-semibold">25 poin</span>
            </div>
            <div class="flex justify-between bg-slate-50 rounded-xl px-3 py-2">
                <span>Tidur maksimal</span>
                <span class="font-semibold">25 poin</span>
            </div>
            <div class="flex justify-between bg-slate-50 rounded-xl px-3 py-2">
                <span>Air minum maksimal</span>
                <span class="font-semibold">20 poin</span>
            </div>
        </div>
    </div>
</div>

@if(isset($riwayat) && $riwayat->count())
    <div class="mt-8 bg-white rounded-2xl shadow-sm border p-6">
        <h2 class="font-bold text-slate-800 mb-4">Riwayat Aktivitas Terakhir</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b">
                        <th class="py-3">Tanggal</th>
                        <th class="py-3">Makan</th>
                        <th class="py-3">Olahraga</th>
                        <th class="py-3">Tidur</th>
                        <th class="py-3">Air Minum</th>
                        <th class="py-3">Skor</th>
                        <th class="py-3">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $item)
                        <tr class="border-b last:border-b-0">
                            <td class="py-3 font-semibold text-slate-700">{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                            <td class="py-3">{{ $item->makan }} kali</td>
                            <td class="py-3">{{ $item->olahraga }} menit</td>
                            <td class="py-3">{{ $item->tidur }} jam</td>
                            <td class="py-3">{{ $item->air_minum }} gelas</td>
                            <td class="py-3 font-bold text-blue-600">{{ $item->skor }}/100</td>
                            <td class="py-3">{{ $item->kategori }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection@extends('layouts.app')

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
