<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AktivitasHarian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AktivitasExport;

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
                'makan' => $aktivitasTerakhir->makan . ' kali',
                'olahraga' => $aktivitasTerakhir->olahraga . ' menit',
                'tidur' => $aktivitasTerakhir->tidur . ' jam',
                'air_minum' => $aktivitasTerakhir->air_minum . ' gelas',
            ];

            $rekomendasiHarian = $this->buatRekomendasi($aktivitasTerakhir);
        } else {
            $skorKesehatan = 0;

            $ringkasanAktivitas = [
                'makan' => 'Belum ada data',
                'olahraga' => 'Belum ada data',
                'tidur' => 'Belum ada data',
                'air_minum' => 'Belum ada data',
            ];

            $rekomendasiHarian = [
                'Silakan isi aktivitas harian terlebih dahulu.',
                'Data akan muncul setelah disimpan.',
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
        return view('pages.aktivitas');
    }

    public function riwayatIndex()
    {
        $query = AktivitasHarian::query();

        if (auth()->check()) {
            $query->where('user_id', auth()->id());
        }

        $riwayat = $query->latest('tanggal')->get();

        return view('pages.riwayat', compact('riwayat'));
    }

    public function storeAktivitas(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'makan' => 'required|integer|min:0|max:10',
            'olahraga' => 'required|integer|min:0|max:300',
            'tidur' => 'required|numeric|min:0|max:24',
            'air_minum' => 'required|integer|min:0|max:30',
            'catatan' => 'nullable|string|max:500',
        ]);

        $data['user_id'] = auth()->id();

        AktivitasHarian::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'tanggal' => $data['tanggal'],
            ],
            $data
        );

        return redirect()->route('aktivitas')
            ->with('success', 'Aktivitas berhasil disimpan.');
    }

    public function artikel()
    {
        return view('pages.artikel');
    }

    public function profil()
    {
        return view('pages.profil');
    }

    // INI EXPORT PDF (BENAR)
    public function exportPdf()
    {
        $query = AktivitasHarian::query();

        if (auth()->check()) {
            $query->where('user_id', auth()->id());
        }

        $riwayat = $query->latest('tanggal')->get();

        $pdf = Pdf::loadView('pages.export-pdf', compact('riwayat'));

        return $pdf->download('riwayat-aktivitas.pdf');
    }

    public function exportExcel()
{
    return Excel::download(new AktivitasExport, 'riwayat-aktivitas.xlsx');
}

    private function buatRekomendasi(AktivitasHarian $aktivitas): array
    {
        $rekomendasi = [];

        if ($aktivitas->tidur < 7) {
            $rekomendasi[] = 'Tidur kurang dari 7 jam.';
        } else {
            $rekomendasi[] = 'Tidur sudah cukup.';
        }

        if ($aktivitas->air_minum < 8) {
            $rekomendasi[] = 'Kurang minum air.';
        } else {
            $rekomendasi[] = 'Hidrasi sudah baik.';
        }

        if ($aktivitas->olahraga < 30) {
            $rekomendasi[] = 'Kurang olahraga.';
        } else {
            $rekomendasi[] = 'Olahraga cukup.';
        }

        if ($aktivitas->makan < 3) {
            $rekomendasi[] = 'Pola makan kurang.';
        } else {
            $rekomendasi[] = 'Pola makan baik.';
        }

        return $rekomendasi;
    }
}