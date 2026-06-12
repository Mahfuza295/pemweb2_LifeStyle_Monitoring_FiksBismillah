@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center py-6 border-b border-slate-100 mb-6">

        <!-- IKON BIRU -->
        <div class="w-30 h-30 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-7xl">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <!-- FOTO PROFIL -->
        <h3 class="text-lg font-bold">
            {{ auth()->user()->name }}
        </h3>

        <p>
            {{ auth()->user()->email }}
        </p>

        <p>
            Role: {{ ucfirst(auth()->user()->role) }}
        </p>
    </div>

    <!-- KOTAK EMAIL -->
    <div class="space-y-3">
        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl text-sm">
            <span class="text-slate-500">Email</span>
            <span class="font-semibold text-slate-800">
                {{ auth()->user()->email }}
            </span>
        </div>

        <!-- KOTAK STATUS AKTIF -->
        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl text-sm">
            <span class="text-slate-500">Status Akun</span>
            <span class="px-2 py-0.5 bg-blue-100 text-blue-700 font-bold rounded-md text-xs">
                Aktif
            </span>
        </div>
    </div>
@endsection