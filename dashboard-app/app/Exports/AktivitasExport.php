<?php

namespace App\Exports;

// Mengimpor Model AktivitasHarian untuk mengambil data dari database
use App\Models\AktivitasHarian;
// Mengimpor interface FromCollection agar bisa mengekspor data berbasis kumpulan data (Collection)
use Maatwebsite\Excel\Concerns\FromCollection;
// Mengimpor interface WithHeadings untuk memberikan baris judul/kepala tabel di file Excel
use Maatwebsite\Excel\Concerns\WithHeadings;
// Mengimpor interface ShouldAutoSize agar lebar kolom Excel otomatis menyesuaikan panjang teks
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// Class ini mengimplementasikan 3 fitur Laravel Excel: Ambil Data, Bikin Judul Kolom, dan Auto Lebar Kolom
class AktivitasExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    // ==========================================
    // 1. FUNGSI MENGAMBIL & MENYUSUN DATA EXCEL
    // ==========================================
    public function collection()
    {
        // Menyiapkan perintah query dasar ke tabel AktivitasHarian
        $query = AktivitasHarian::query();

        // Keamanan: Memastikan hanya user yang sudah login (auth()->check()) yang datanya ditarik
        if (auth()->check()) {
            // Saring data: Hanya mengambil catatan aktivitas milik user yang sedang login saat ini
            $query->where('user_id', auth()->id());
        }

        // Ambil data terbaru berdasarkan tanggal, lalu susun kolomnya menggunakan fungsi map()
        return $query->latest('tanggal')->get()->map(function ($item) {
            // Di sini kita mengatur urutan kolom data yang akan muncul di baris Excel nanti
            return [
                $item->tanggal,      // Kolom A: Berisi tanggal aktivitas
                $item->makan,        // Kolom B: Berisi berapa kali makan
                $item->olahraga,     // Kolom C: Berisi durasi olahraga (menit)
                $item->tidur,        // Kolom D: Berisi durasi tidur (jam)
                $item->air_minum,    // Kolom E: Berisi jumlah air minum (gelas)
                $item->skor ?? 0,    // Kolom F: Berisi skor kesehatan harian, jika kosong diisi angka 0
                $item->catatan,      // Kolom G: Berisi catatan tambahan dari user
            ];
        });
    }

    // ==========================================
    // 2. FUNGSI MEMBUAT JUDUL BARIS UTAMA (HEADER)
    // ==========================================
    public function headings(): array
    {
        // Mengembalikan array teks yang akan menjadi baris paling atas (Baris 1) di file Excel
        // Posisinya harus berurutan pas dengan urutan data di fungsi collection() di atas
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