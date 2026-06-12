@extends('layouts.app')

@section('title', 'Riwayat Data Harian')

@section('content')

    <div class="flex justify-between items-center mb-6">

        <div class="flex gap-3">
            <a href="{{ route('riwayat.export.pdf') }}"
                class="bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-red-700 shadow">
                Export PDF
            </a>

            <a href="{{ route('riwayat.export.excel') }}"
                class="bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-green-700 shadow">
                Export Excel
            </a>
        </div>

    </div>

    <div class="bg-white p-6 rounded-2xl shadow">

        <table id="tableRiwayat" class="w-full text-sm">

            <thead class="bg-slate-100 text-left">
                <tr>
                    @if(auth()->user()->role == 'admin')
                        <th class="p-3">Nama Pengguna</th>
                    @endif

                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Makan</th>
                    <th class="p-3">Olahraga</th>
                    <th class="p-3">Tidur</th>
                    <th class="p-3">Air Minum</th>
                    <th class="p-3">Skor</th>
                </tr>

                <style>
                    .dataTables_filter input {
                        border: 1px solid #cbd5e1;
                        padding: 6px 10px;
                        border-radius: 10px;
                        outline: none;
                        background: white;
                    }

                    .dataTables_length select {
                        border: 1px solid #cbd5e1;
                        padding: 6px 10px;
                        border-radius: 10px;
                        background: white;
                    }
                </style>
            </thead>

            <tbody>
                @foreach($riwayat as $item)
                    <tr class="border-b">
                        @if(auth()->user()->role == 'admin')
                            <td class="p-3 font-medium text-slate-800">
                                {{ $item->user?->name ?? 'User Tidak Ditemukan' }}
                            </td>
                        @endif

                        <td class="p-3">{{ $item->tanggal }}</td>
                        <td class="p-3">{{ $item->makan }}</td>
                        <td class="p-3">{{ $item->olahraga }}</td>
                        <td class="p-3">{{ $item->tidur }}</td>
                        <td class="p-3">{{ $item->air_minum }}</td>
                        <td class="p-3 font-semibold">{{ $item->skor }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    <script>
        $(document).ready(function () {
            $('#tableRiwayat').DataTable({
                responsive: true,
                language: {
                    search: "Cari Data :",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Selanjutnya"
                    },
                    zeroRecords: "Data tidak ditemukan"
                }
            });
        });
    </script>

@endsection