@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center py-6 border-b border-slate-100 mb-6">
    <!-- Avatar / Foto Profil Simpel -->
    <div class="w-24 h-24 bg-blue-600 text-white rounded-full flex items-center justify-center text-3xl font-bold shadow-lg shadow-blue-100 mb-3">
        M
    </div>
    <h2 class="text-xl font-bold text-slate-900">Mahfuza</h2>
    <p class="text-sm text-slate-500">Mahasiswa Pendidikan Komputer</p>
</div>

<div class="space-y-3">
    <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl text-sm">
        <span class="text-slate-500">Email</span>
        <span class="font-semibold text-slate-800">user@example.com</span>
    </div>
    <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl text-sm">
        <span class="text-slate-500">Status Akun</span>
        <span class="px-2 py-0.5 bg-blue-100 text-blue-700 font-bold rounded-md text-xs">Aktif</span>
    </div>
</div>
@endsection