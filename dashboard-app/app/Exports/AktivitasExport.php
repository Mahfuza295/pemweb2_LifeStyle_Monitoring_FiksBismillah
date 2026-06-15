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
                $item->tanggal,      
                $item->makan,        
                $item->olahraga,     
                $item->tidur,        
                $item->air_minum,    
                $item->skor ?? 0,    
                $item->catatan,      
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