<?php

namespace App\Http\Controllers;

use App\Models\AktivitasHarian;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        $query = AktivitasHarian::query();

        if (auth()->check()) {
            $query->where('user_id', auth()->id());
        }

        $aktivitasTerakhir = $query->latest('tanggal')->first();

        if ($aktivitasTerakhir) {
            $skorKesehatan = $aktivitasTerakhir->skor;

            $ringkasanAktivitas = [
                'makan'     => $aktivitasTerakhir->makan . ' kali',
                'olahraga'  => $aktivitasTerakhir->olahraga . ' menit',
                'tidur'     => $aktivitasTerakhir->tidur . ' jam',
                'air_minum' => $aktivitasTerakhir->air_minum . ' gelas',
            ];

            $rekomendasiHarian = $this->buatRekomendasi($aktivitasTerakhir);
        } else {
            $skorKesehatan = 0;

            $ringkasanAktivitas = [
                'makan'     => 'Belum ada data',
                'olahraga'  => 'Belum ada data',
                'tidur'     => 'Belum ada data',
                'air_minum' => 'Belum ada data',
            ];

            $rekomendasiHarian = [
                'Silakan isi aktivitas harian terlebih dahulu melalui menu Input Aktivitas.',
                'Setelah data disimpan, skor kesehatan akan muncul otomatis di dashboard.',
            ];
        }

        return view('pages.dashboard', compact(
            'skorKesehatan',
            'ringkasanAktivitas',
            'rekomendasiHarian',
            'aktivitasTerakhir'
        ));
    }

    public function aktivitas()
    {
        $query = AktivitasHarian::query();

        if (auth()->check()) {
            $query->where('user_id', auth()->id());
        }

        $riwayat = $query->latest('tanggal')->take(5)->get();

        return view('pages.aktivitas', compact('riwayat'));
    }

    public function storeAktivitas(Request $request)
    {
        $data = $request->validate([
            'tanggal'   => 'required|date',
            'makan'     => 'required|integer|min:0|max:10',
            'olahraga'  => 'required|integer|min:0|max:300',
            'tidur'     => 'required|numeric|min:0|max:24',
            'air_minum' => 'required|integer|min:0|max:30',
            'catatan'   => 'nullable|string|max:500',
        ], [
            'tanggal.required'   => 'Tanggal wajib diisi.',
            'makan.required'     => 'Jumlah makan wajib diisi.',
            'olahraga.required'  => 'Durasi olahraga wajib diisi.',
            'tidur.required'     => 'Durasi tidur wajib diisi.',
            'air_minum.required' => 'Jumlah air minum wajib diisi.',
        ]);

        $data['user_id'] = auth()->id();

        AktivitasHarian::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'tanggal' => $data['tanggal'],
            ],
            $data
        );

        return redirect()
            ->route('aktivitas')
            ->with('success', 'Aktivitas harian berhasil disimpan.');
    }

    public function artikel()
    {
        return view('pages.artikel');
    }

    public function profil()
    {
        return view('pages.profil');
    }

    private function buatRekomendasi(AktivitasHarian $aktivitas): array
    {
        $rekomendasi = [];

        if ($aktivitas->tidur < 7) {
            $rekomendasi[] = 'Durasi tidur masih kurang. Usahakan tidur 7-8 jam setiap hari.';
        } else {
            $rekomendasi[] = 'Durasi tidur sudah cukup baik. Pertahankan pola istirahat Anda.';
        }

        if ($aktivitas->air_minum < 8) {
            $rekomendasi[] = 'Minum air putih masih kurang. Coba targetkan sekitar 8 gelas per hari.';
        } else {
            $rekomendasi[] = 'Konsumsi air minum sudah baik. Pertahankan agar tubuh tetap terhidrasi.';
        }

        if ($aktivitas->olahraga < 30) {
            $rekomendasi[] = 'Aktivitas olahraga masih rendah. Coba olahraga ringan minimal 30 menit.';
        } else {
            $rekomendasi[] = 'Aktivitas olahraga sudah bagus. Lanjutkan kebiasaan sehat ini.';
        }

        if ($aktivitas->makan < 3) {
            $rekomendasi[] = 'Pola makan masih kurang teratur. Usahakan makan utama 3 kali sehari.';
        } else {
            $rekomendasi[] = 'Pola makan sudah cukup teratur.';
        }

        return $rekomendasi;
    }
}
