<?php

namespace App\Exports;

use App\Models\AktivitasHarian;
// Mengimport library Laravel Excel agar fitur-fitur export bisa digunakan
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// ShouldAutoSize: Berfungsi agar lebar kolom Excel otomatis pas dengan panjang teks
class AktivitasExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * Fungsi untuk mengambil dan menstrukturkan data yang akan dimasukkan ke Excel
     */
    public function collection()
    {
        // Menyiapkan query dasar untuk mengambil data dari tabel 'aktivitas_harian'
        $query = AktivitasHarian::query();

        // Fitur Keamanan: Cek apakah ada user yang sedang login
        if (auth()->check()) {
            // Jika ada, filter data agar yang diambil HANYA data milik user yang sedang login tersebut
            $query->where('user_id', auth()->id());
        }

        // Ambil data terbaru berdasarkan tanggal, lalu susun kolomnya secara manual
        return $query->latest('tanggal')->get()->map(function ($item) {
            return [
                $item->tanggal,      // Baris data untuk Kolom Tanggal
                $item->makan,        // Baris data untuk Kolom Makan
                $item->olahraga,     // Baris data untuk Kolom Olahraga
                $item->tidur,        // Baris data untuk Kolom Tidur
                $item->air_minum,    // Baris data untuk Kolom Air Minum
                $item->skor ?? 0,    // Baris data untuk Kolom Skor (Jika kosong/null, otomatis diisi angka 0)
                $item->catatan,      // Baris data untuk Kolom Catatan
            ];
        });
    }

    /**
     * Fungsi untuk membuat judul kolom (Header) pada baris paling atas di Excel
     */
    public function headings(): array
    {
        return [
            'Tanggal',
            'Makan',
            'Olahraga (menit)',
            'Tidur (jam)',
            'Air Minum',
            'Skor',
            'Catatan'
        ];
    }
}