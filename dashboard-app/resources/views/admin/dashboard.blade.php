@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Dashboard Admin
        </h1>
        <p class="text-slate-500">
            Statistik global sistem
        </p>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">

        <h2 class="text-lg font-bold mb-4">Daftar User</h2>

        <table class="w-full border-collapse">
            <thead>
                <tr class="text-left border-b">
                    <th class="py-2">Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Terdaftar</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b">
                        <td class="py-2">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-slate-500 text-sm mb-1">Total User</p>
            <h2 class="text-2xl font-bold text-slate-800">{{ $totalUser }}</h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-slate-500 text-sm mb-1">Total Aktivitas</p>
            <h2 class="text-2xl font-bold text-slate-800">{{ $totalAktivitas }}</h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-slate-500 text-sm mb-1">Rata-rata Skor</p>
            <h2 class="text-2xl font-bold text-slate-800">{{ number_format($rataSkor, 1) }}</h2>
        </div>

    </div>

</div>
@endsection