@extends('layouts.app')

@section('title', 'Riwayat Data Harian - Healthy Life Monitoring')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="mb-6">
            <h3 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-blue-600"></i>
                Riwayat Data Harian
            </h3>
            <p class="text-sm text-slate-400">Data aktivitas kesehatan yang sudah pernah Anda simpan sebelumnya.</p>
        </div>

        @if($riwayat->isEmpty())
            <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed">
                <i class="fa-solid fa-folder-open text-slate-300 text-4xl mb-3"></i>
                <p class="text-slate-500">Belum ada riwayat aktivitas harian yang tersimpan.</p>
                <a href="{{ route('aktivitas') }}" class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-blue-700 shadow-md">
                    Input Aktivitas Sekarang
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($riwayat as $item)
                    <div class="border border-slate-100 p-5 rounded-2xl shadow-sm bg-slate-50 hover:shadow-md transition">
                        <div class="flex justify-between items-center mb-4 border-b pb-3 border-slate-200/60">
                            <div class="flex items-center gap-2 text-slate-700 font-bold">
                                <i class="fa-solid fa-calendar-day text-blue-500"></i>
                                <span>Hari Aktivitas: {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d-m-Y') }}</span>
                            </div>
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-black shadow-sm">
                                Skor {{ $item->skor ?? 0 }}%
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-slate-600">
                            <div class="flex items-center gap-2 bg-white p-3 rounded-xl border border-slate-100">
                                <i class="fa-solid fa-utensils text-amber-500 w-5 text-center"></i>
                                <div>
                                    <p class="text-xs text-slate-400 font-medium">Pola Makan</p>
                                    <p class="font-semibold text-slate-700">{{ $item->makan }} kali</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 bg-white p-3 rounded-xl border border-slate-100">
                                <i class="fa-solid fa-person-running text-emerald-500 w-5 text-center"></i>
                                <div>
                                    <p class="text-xs text-slate-400 font-medium">Olahraga</p>
                                    <p class="font-semibold text-slate-700">{{ $item->olahraga }} menit</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 bg-white p-3 rounded-xl border border-slate-100">
                                <i class="fa-solid fa-bed text-indigo-500 w-5 text-center"></i>
                                <div>
                                    <p class="text-xs text-slate-400 font-medium">Durasi Tidur</p>
                                    <p class="font-semibold text-slate-700">{{ $item->tidur }} jam</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 bg-white p-3 rounded-xl border border-slate-100">
                                <i class="fa-solid fa-droplet text-blue-500 w-5 text-center"></i>
                                <div>
                                    <p class="text-xs text-slate-400 font-medium">Air Minum</p>
                                    <p class="font-semibold text-slate-700">{{ $item->air_minum }} gelas</p>
                                </div>
                            </div>
                        </div>

                        @if($item->catatan)
                            <div class="mt-4 p-3 bg-white border border-slate-100 rounded-xl text-xs text-slate-500 flex gap-2 items-start">
                                <i class="fa-solid fa-comment-dots text-slate-400 mt-0.5"></i>
                                <div>
                                    <span class="font-semibold text-slate-600">Catatan:</span> {{ $item->catatan }}
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection