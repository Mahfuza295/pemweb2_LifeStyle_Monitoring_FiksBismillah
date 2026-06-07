@extends('layouts.app')

@section('title', 'Data Harian')

@section('content')
<h1 class="text-xl font-bold mb-4">Data Harian</h1>

@if($data->isEmpty())
    <p>Belum ada data aktivitas.</p>
@else
    <table class="w-full bg-white rounded-xl shadow overflow-hidden">
        <thead class="bg-slate-100">
            <tr>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Makan</th>
                <th class="p-3 text-left">Olahraga</th>
                <th class="p-3 text-left">Tidur</th>
                <th class="p-3 text-left">Air Minum</th>
                <th class="p-3 text-left">Skor</th>
                <th class="p-3 text-left">Kategori</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $item)
            <tr class="border-t">
                <td class="p-3">{{ $item->tanggal }}</td>
                <td class="p-3">{{ $item->makan }}x</td>
                <td class="p-3">{{ $item->olahraga }} menit</td>
                <td class="p-3">{{ $item->tidur }} jam</td>
                <td class="p-3">{{ $item->air_minum }} gelas</td>
                <td class="p-3">{{ $item->skor }}</td>
                <td class="p-3">{{ $item->kategori }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection