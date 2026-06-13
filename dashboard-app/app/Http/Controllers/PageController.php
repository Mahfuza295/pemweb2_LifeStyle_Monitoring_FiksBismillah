<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AktivitasHarian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AktivitasExport;
use App\Models\User;

class PageController extends Controller
{
    public function dashboard()
    {
        // 👑 ADMIN DASHBOARD (GLOBAL)
        if (auth()->user()->role == 'admin') {

            $aktivitasTerakhir = AktivitasHarian::latest('tanggal')->first();

            $skorKesehatan = $aktivitasTerakhir?->skor ?? 0;

            $kondisi = $this->getKondisi($skorKesehatan);

            $totalUser = User::count();
            $totalAktivitas = AktivitasHarian::count();
            $rataSkor = AktivitasHarian::avg('skor');

            $users = User::all(); 

            $ringkasanAktivitas = [
                'makan' => 'Data seluruh user',
                'olahraga' => 'Data seluruh user',
                'tidur' => 'Data seluruh user',
                'air_minum' => 'Data seluruh user',
            ];

            $rekomendasiHarian = [
                'Dashboard admin (data global sistem)',
                'Gunakan menu riwayat untuk detail user',
            ];

            return view('admin.dashboard', compact(
                'skorKesehatan',
                'ringkasanAktivitas',
                'rekomendasiHarian',
                'aktivitasTerakhir',
                'kondisi',
                'totalUser',
                'totalAktivitas',
                'rataSkor',
                'users'
            ));
        }

        // 👤 USER DASHBOARD
        $aktivitasTerakhir = AktivitasHarian::where('user_id', auth()->id())
            ->latest('id') 
            ->first();

        if ($aktivitasTerakhir) {

            $skorKesehatan = $aktivitasTerakhir->skor;
            $kondisi = $this->getKondisi($skorKesehatan);

            $ringkasanAktivitas = [
                'makan' => $aktivitasTerakhir->makan . ' kali',
                'olahraga' => $aktivitasTerakhir->olahraga . ' menit',
                'tidur' => $aktivitasTerakhir->tidur . ' jam',
                'air_minum' => $aktivitasTerakhir->air_minum . ' gelas',
                'kalori' => ($aktivitasTerakhir->kalori ?? 0) . ' kcal', // 🔥 KIRIM KALORI KE DASHBOARD
            ];

            $rekomendasiHarian = $this->buatRekomendasi($aktivitasTerakhir);

        } else {

            $skorKesehatan = 0;
            $kondisi = "Belum ada data";

            $ringkasanAktivitas = [
                'makan' => 'Belum ada data',
                'olahraga' => 'Belum ada data',
                'tidur' => 'Belum ada data',
                'air_minum' => 'Belum ada data',
                'kalori' => 'Belum ada data', // 🔥 DATA CADANGAN JIKA KOSONG
            ];

            $rekomendasiHarian = [];
        }

        return view('pages.dashboard', compact(
            'skorKesehatan',
            'ringkasanAktivitas',
            'rekomendasiHarian',
            'aktivitasTerakhir',
            'kondisi'
        ));
    }

    public function aktivitas()
    {
        // 🛑 KEAMANAN: Blokir admin jika mencoba tembus lewat URL langsung
        if (auth()->user()->role == 'admin') {
            abort(403, 'Admin tidak memiliki akses untuk menginput aktivitas.');
        }

        return view('pages.aktivitas');
    }

    public function riwayatIndex()
    {
        $query = AktivitasHarian::query();

        if (auth()->user()->role != 'admin') {
            $query->where('user_id', auth()->id());
        }

        $riwayat = $query->latest('tanggal')->get();

        return view('pages.riwayat', compact('riwayat'));
    }

    public function storeAktivitas(Request $request)
    {
        // 🛑 KEAMANAN: Blokir admin jika mencoba kirim form bypass data
        if (auth()->user()->role == 'admin') {
            abort(403, 'Admin tidak diizinkan menyimpan data aktivitas.');
        }

        $data = $request->validate([
            'tanggal' => 'required|date',
            'makan' => 'required|integer|min:0|max:10',
            'olahraga' => 'required|integer|min:0|max:300',
            'tidur' => 'required|numeric|min:0|max:24',
            'air_minum' => 'required|integer|min:0|max:30',
            'catatan' => 'nullable|string|max:500',
        ]);

        $data['user_id'] = auth()->id();

        // 🔥 HITUNG SKOR (Cukup 1 kali eksekusi)
        $skor = 0;
        $skor += ($data['makan'] >= 3) ? 25 : 10;
        $skor += ($data['olahraga'] >= 30) ? 25 : 10;
        $skor += ($data['tidur'] >= 7) ? 25 : 10;
        $skor += ($data['air_minum'] >= 8) ? 25 : 10;

        $data['skor'] = $skor;

        // 🍳 HITUNG PERKIRAAN KALORI (1x makan = 500 kkal)
        $data['kalori'] = $data['makan'] * 500; 

        // Simpan data (Cukup 1 kali eksekusi)
        AktivitasHarian::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'tanggal' => $data['tanggal'],
            ],
            $data
        );

        return redirect()->route('dashboard')
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

    // EXPORT PDF
    public function exportPdf()
    {
        $query = AktivitasHarian::query();

        if (auth()->user()->role != 'admin') {
            $query->where('user_id', auth()->id());
        }

        $riwayat = $query->latest('tanggal')->get();

        $pdf = Pdf::loadView('pages.export-pdf', compact('riwayat'));

        return $pdf->download('riwayat-aktivitas.pdf');
    }

    // EXPORT EXCEL
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

    // DASHBOARD ADMIN
    public function adminDashboard()
    {
        $totalUser = User::count();
        $totalAktivitas = AktivitasHarian::count();
        $rataSkor = AktivitasHarian::avg('skor');
        $users = User::all();

        $dataSkor = AktivitasHarian::selectRaw('DATE(tanggal) as tanggal, AVG(skor) as skor')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalAktivitas',
            'rataSkor',
            'dataSkor',
            'users'
        ));
    }

    private function getKondisi($skor)
    {
        if ($skor >= 80)
            return "Sangat baik";
        if ($skor >= 60)
            return "Baik";
        if ($skor >= 40)
            return "Cukup";
        if ($skor >= 20)
            return "Buruk";
        return "Sangat buruk";
    }
}
