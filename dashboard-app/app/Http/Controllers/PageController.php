<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        // Data simulasi berdasarkan parameter Bab 3.1 Proposal Anda
        $skorKesehatan = 85; 
        
        $ringkasanAktivitas = [
            'makan'     => '1,800 Kalori (Pola Makan Baik)',
            'olahraga'  => '30 Menit (Jogging)',
            'tidur'     => '7 Jam (Istirahat Cukup)',
            'air_minum' => '2.5 Liter (Terhidrasi)',
        ];

        $rekomendasiHarian = [
            'Pertahankan durasi tidur Anda di angka 7-8 jam untuk menjaga imunitas.',
            'Bagus! Konsumsi air minum Anda sudah memenuhi target harian.',
            'Tips PTM: Kurangi konsumsi gula berlebih hari ini untuk menekan risiko diabetes.'
        ];

        return view('pages.dashboard', compact('skorKesehatan', 'ringkasanAktivitas', 'rekomendasiHarian'));
    }

    public function aktivitas() { return view('pages.aktivitas'); }
    public function artikel() { return view('pages.artikel'); }
    public function profil() { return view('pages.profil'); }
}