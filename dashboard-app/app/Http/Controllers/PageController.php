<?php

namespace App\Http\Controllers;

// Mengimpor (import) library DomPDF untuk fitur cetak PDF
use Barryvdh\DomPDF\Facade\Pdf;
// Mengimpor Model AktivitasHarian agar controller bisa mengakses tabel 'aktivitas_harians' di database
use App\Models\AktivitasHarian;
// Mengimpor objek Request untuk menangkap data yang dikirim dari form input HTML
use Illuminate\Http\Request;
// Mengimpor library Laravel Excel untuk fitur cetak/export file Excel
use Maatwebsite\Excel\Facades\Excel;
// Mengimpor blueprint ekspor Excel yang mengatur format kolom tabel Excel
use App\Exports\AktivitasExport;
// Mengimpor Model User agar controller bisa mengakses data pengguna di tabel 'users'
use App\Models\User;

class PageController extends Controller
{
    // ==========================================
    // 1. FUNGSI UTAMA DASHBOARD (MULTI-ROLE)
    // ==========================================
    public function dashboard()
    {
        // 🛡️ JIKA YANG LOGIN ADALAH ADMIN
        if (auth()->user()->role == 'admin') {

            // Mengambil 1 data aktivitas terbaru dari database secara global (dari semua user) berdasarkan tanggal terbaru
            $aktivitasTerakhir = AktivitasHarian::latest('tanggal')->first();

            // Mengambil skor dari aktivitas terakhir. Jika datanya kosong (belum ada yang isi), set nilainya jadi 0
            $skorKesehatan = $aktivitasTerakhir?->skor ?? 0;

            // Mengubah nilai angka skor menjadi teks kondisi (misal: "Baik", "Cukup") lewat fungsi pembantu getKondisi()
            $kondisi = $this->getKondisi($skorKesehatan);

            // Menghitung statistik global untuk dashboard admin
            $totalUser = User::count(); // Menghitung total semua user yang terdaftar di aplikasi
            $totalAktivitas = AktivitasHarian::count(); // Menghitung total seluruh catatan aktivitas yang pernah diinput semua orang
            $rataSkor = AktivitasHarian::avg('skor'); // Menghitung nilai rata-rata skor kesehatan dari seluruh data di database

            // Mengambil seluruh data user untuk ditampilkan pada tabel daftar user di halaman admin
            $users = User::all(); 

            // Karena admin memantau data global, ringkasan aktivitas diisi teks penanda statis
            $ringkasanAktivitas = [
                'makan' => 'Data seluruh user',
                'olahraga' => 'Data seluruh user',
                'tidur' => 'Data seluruh user',
                'air_minum' => 'Data seluruh user',
            ];

            // Memberikan pesan teks petunjuk khusus untuk halaman admin
            $rekomendasiHarian = [
                'Dashboard admin (data global sistem)',
                'Gunakan menu riwayat untuk detail user',
            ];

            // Membuka file view 'admin.dashboard' sambil mengirimkan semua variabel di atas menggunakan compact()
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

        // 👤 JIKA YANG LOGIN ADALAH USER/PENGGUNA BIASA
        // Mengambil 1 data aktivitas terbaru yang ID pemiliknya cocok dengan ID user yang sedang login saat ini
        $aktivitasTerakhir = AktivitasHarian::where('user_id', auth()->id())
            ->latest('id') 
            ->first();

        // Jika user ini sudah pernah mengisi data aktivitas sebelumnya
        if ($aktivitasTerakhir) {

            $skorKesehatan = $aktivitasTerakhir->skor; // Mengambil angka skor kesehatan milik user tersebut
            $kondisi = $this->getKondisi($skorKesehatan); // Mengonversi angka skor menjadi teks kondisi tubuh

            // Menyusun data mentah database ke dalam array rapi ditambah satuan teks (kali, menit, jam, gelas)
            $ringkasanAktivitas = [
                'makan' => $aktivitasTerakhir->makan . ' kali',
                'olahraga' => $aktivitasTerakhir->olahraga . ' menit',
                'tidur' => $aktivitasTerakhir->tidur . ' jam',
                'air_minum' => $aktivitasTerakhir->air_minum . ' gelas',
                'kalori' => ($aktivitasTerakhir->kalori ?? 0) . ' kcal', // Mengambil data kalori, jika null diisi 0
            ];

            // Membuat daftar saran medis otomatis berdasarkan angka aktivitas terakhir lewat fungsi private buatRekomendasi()
            $rekomendasiHarian = $this->buatRekomendasi($aktivitasTerakhir);

        } else {
            // Jika user baru login pertama kali dan datanya masih kosong melompong di database
            $skorKesehatan = 0;
            $kondisi = "Belum ada data";

            $ringkasanAktivitas = [
                'makan' => 'Belum ada data',
                'olahraga' => 'Belum ada data',
                'tidur' => 'Belum ada data',
                'air_minum' => 'Belum ada data',
                'kalori' => 'Belum ada data', 
            ];

            $rekomendasiHarian = []; // Mengosongkan kotak rekomendasi di halaman web
        }

        // Membuka file view 'pages.dashboard' (halaman dashboard user biasa) dan mengirim datanya
        return view('pages.dashboard', compact(
            'skorKesehatan',
            'ringkasanAktivitas',
            'rekomendasiHarian',
            'aktivitasTerakhir',
            'kondisi'
        ));
    }

    // ==========================================
    // 2. FUNGSI MEMBUKA FORM INPUT AKTIVITAS
    // ==========================================
    public function aktivitas()
    {
        // 🛑 SISTEM KEAMANAN: Jika admin mencoba mengetik URL /aktivitas secara paksa, langsung blokir (Error 403)
        if (auth()->user()->role == 'admin') {
            abort(403, 'Admin tidak memiliki akses untuk menginput aktivitas.');
        }

        // Jika lolos (dia user biasa), izinkan masuk ke halaman form input aktivitas harian
        return view('pages.aktivitas');
    }

    // ==========================================
    // 3. FUNGSI MENAMPILKAN RIWAYAT TABEL
    // ==========================================
    public function riwayatIndex()
    {
        // Menyiapkan perintah query dasar ke tabel AktivitasHarian
        $query = AktivitasHarian::query();

        // Jika yang login BUKAN admin, saring datanya agar user HANYA bisa melihat catatan miliknya sendiri
        if (auth()->user()->role != 'admin') {
            $query->where('user_id', auth()->id());
        }

        // Eksekusi pengambilan data dari database, urutkan dari tanggal yang paling baru
        $riwayat = $query->latest('tanggal')->get();

        // Buka halaman riwayat tabel dan kirimkan data variabel $riwayat ke dalam view
        return view('pages.riwayat', compact('riwayat'));
    }

    // ==========================================
    // 4. FUNGSI MEMPROSES & MENGHITUNG FORM INPUT
    // ==========================================
    public function storeAktivitas(Request $request)
    {
        // 🛑 SISTEM KEAMANAN: Blokir admin jika mencoba mengirim data manipulasi lewat form bypass
        if (auth()->user()->role == 'admin') {
            abort(403, 'Admin tidak diizinkan menyimpan data aktivitas.');
        }

        // VALIDASI INPUT: Memastikan data wajib diisi, berupa angka, dan tidak melewati batas logika manusia
        $data = $request->validate([
            'tanggal' => 'required|date', // Wajib diisi dan harus berformat tanggal kalender
            'makan' => 'required|integer|min:0|max:10', // Angka bulat, minimal 0 kali, maksimal 10 kali sehari
            'olahraga' => 'required|integer|min:0|max:300', // Angka bulat satuan menit (maksimal 5 jam)
            'tidur' => 'required|numeric|min:0|max:24', // Angka desimal/boleh koma satuan jam (maksimal 24 jam)
            'air_minum' => 'required|integer|min:0|max:30', // Angka bulat satuan gelas (maksimal 30 gelas)
            'catatan' => 'nullable|string|max:500', // Boleh dikosongkan, berupa teks tulisan max 500 karakter
        ]);

        // Menyisipkan ID user yang sedang login ke dalam array data agar sistem tahu ini catatan milik siapa
        $data['user_id'] = auth()->id();

        // 🧮 LOGIKA PERHITUNGAN SKOR OTOMATIS (Maksimal akumulasi poin = 100)
        $skor = 0;
        // Jika makan 3 kali atau lebih dapat 25 poin, jika kurang dari 3 kali cuma dapat 10 poin
        $skor += ($data['makan'] >= 3) ? 25 : 10;
        // Jika olahraga 30 menit atau lebih dapat 25 poin, jika kurang cuma dapat 10 poin
        $skor += ($data['olahraga'] >= 30) ? 25 : 10;
        // Jika tidur 7 jam atau lebih dapat 25 poin, jika kurang cuma dapat 10 poin
        $skor += ($data['tidur'] >= 7) ? 25 : 10;
        // Jika minum air 8 gelas atau lebih dapat 25 poin, jika kurang cuma dapat 10 poin
        $skor += ($data['air_minum'] >= 8) ? 25 : 10;

        // Masukkan hasil total perhitungan skor di atas ke dalam array data kolom 'skor'
        $data['skor'] = $skor;

        // 🍳 HITUNG ESTIMASI KALORI: Diasumsikan setiap 1 kali porsi makan rata-rata mengandung 500 kilo kalori
        $data['kalori'] = $data['makan'] * 500; 

        // SIMPAN DATA MENGGUNAKAN METODE UPDATE-OR-CREATE
        // Jika pada tanggal tersebut user ini sudah pernah menginput data, maka data lama akan DI-UPDATE/DIPERBARUI.
        // Jika tanggal tersebut belum pernah diisi, maka sistem otomatis MEMBUAT BARIS CATATAN BARU di database.
        AktivitasHarian::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'tanggal' => $data['tanggal'],
            ],
            $data
        );

        // Alihkan user kembali ke halaman dashboard disertai kiriman notifikasi sukses berwarna hijau di layar web
        return redirect()->route('dashboard')
            ->with('success', 'Aktivitas berhasil disimpan.');
    }

    // ==========================================
    // 5. FUNGSI NAVIGASI LINK SEDERHANA
    // ==========================================
    public function artikel()
    {
        return view('pages.artikel'); // Membuka halaman membaca artikel kesehatan
    }

    public function profil()
    {
        return view('pages.profil'); // Membuka halaman edit profil akun user
    }

    // ==========================================
    // 6. FUNGSI CETAK LAPORAN (PDF & EXCEL)
    // ==========================================
    public function exportPdf()
    {
        $query = AktivitasHarian::query();

        // Jika bukan admin, batasi agar file PDF yang terdownload hanya berisi riwayat milik dirinya sendiri
        if (auth()->user()->role != 'admin') {
            $query->where('user_id', auth()->id());
        }

        $riwayat = $query->latest('tanggal')->get();

        // Memasukkan data riwayat ke dalam file desain HTML 'pages.export-pdf' untuk diubah struktur layout-nya oleh DomPDF
        $pdf = Pdf::loadView('pages.export-pdf', compact('riwayat'));

        // Memerintahkan browser untuk langsung mengunduh file hasil konversi tadi menjadi dokumen PDF resmi
        return $pdf->download('riwayat-aktivitas.pdf');
    }

    public function exportExcel()
    {
        // Memanfaatkan library Laravel Excel untuk mengunduh file spreadsheet Excel berpatokan pada file AktivitasExport
        return Excel::download(new AktivitasExport, 'riwayat-aktivitas.xlsx');
    }

    // =========================================================
    // 7. FUNGSI RAHASIA INTERNAL (PRIVATE) - GENERATOR SARAN MEDIS
    // =========================================================
    private function buatRekomendasi(AktivitasHarian $aktivitas): array
    {
        $rekomendasi = []; // Menyiapkan wadah array kosong untuk menampung daftar saran

        // EVALUASI TOTAL SKOR KESEHATAN GLOBAL
        if ($aktivitas->skor < 40) {
            $rekomendasi[] = [
                'tipe' => 'bahaya', // Memicu kotak card berwarna merah di tampilan CSS web
                'judul' => 'Peringatan kesehatan',
                'isi' => 'Skor kesehatan Anda rendah. Segera perbaiki pola makan, tidur, olahraga, and konsumsi air minum.',
                'icon' => 'fa-triangle-exclamation' // Menggunakan icon tanda seru segitiga (FontAwesome)
            ];
        } elseif ($aktivitas->skor < 60) {
            $rekomendasi[] = [
                'tipe' => 'waspada', // Memicu kotak card berwarna kuning di tampilan CSS web
                'judul' => 'Kesehatan perlu diperhatikan',
                'isi' => 'Kondisi Anda belum stabil. Mulailah memperbaiki kebiasaan harian secara bertahap.',
                'icon' => 'fa-circle-exclamation' // Icon tanda seru lingkaran
            ];
        }

        // EVALUASI POLA TIDUR USER
        if ($aktivitas->tidur < 7) {
            $rekomendasi[] = [
                'tipe' => 'waspada',
                'judul' => 'Tidur kurang',
                'isi' => 'Tidur Anda kurang dari 7 jam. Coba tidur lebih awal agar tubuh lebih segar.',
                'icon' => 'fa-bed' // Icon tempat tidur
            ];
        } else {
            $rekomendasi[] = [
                'tipe' => 'aman', // Memicu kotak card berwarna hijau di tampilan CSS web
                'judul' => 'Tidur cukup',
                'isi' => 'Durasi tidur Anda sudah baik. Pertahankan pola tidur ini.',
                'icon' => 'fa-circle-check' // Icon centang hijau
            ];
        }

        // EVALUASI KONSUMSI AIR MINUM
        if ($aktivitas->air_minum < 8) {
            $rekomendasi[] = [
                'tipe' => 'waspada',
                'judul' => 'Kurang minum air',
                'isi' => 'Minum air Anda masih kurang. Usahakan minimal 8 gelas per hari.',
                'icon' => 'fa-droplet' // Icon tetesan air
            ];
        } else {
            $rekomendasi[] = [
                'tipe' => 'aman',
                'judul' => 'Hidrasi baik',
                'isi' => 'Konsumsi air minum Anda sudah cukup.',
                'icon' => 'fa-circle-check'
            ];
        }

        // EVALUASI KEBIASAAN OLAHRAGA
        if ($aktivitas->olahraga < 30) {
            $rekomendasi[] = [
                'tipe' => 'waspada',
                'judul' => 'Kurang olahraga',
                'isi' => 'Olahraga Anda kurang dari 30 menit. Coba jalan kaki ringan atau stretching.',
                'icon' => 'fa-person-running' // Icon orang berlari
            ];
        } else {
            $rekomendasi[] = [
                'tipe' => 'aman',
                'judul' => 'Olahraga cukup',
                'isi' => 'Aktivitas olahraga Anda sudah bagus. Pertahankan kebiasaan ini.',
                'icon' => 'fa-circle-check'
            ];
        }

        // EVALUASI FREKUENSI MAKAN NASI
        if ($aktivitas->makan < 3) {
            $rekomendasi[] = [
                'tipe' => 'bahaya',
                'judul' => 'Pola makan kurang',
                'isi' => 'Anda makan kurang dari 3 kali. Usahakan makan teratur agar energi tetap stabil.',
                'icon' => 'fa-utensils' // Icon sendok dan garpu
            ];
        } else {
            $rekomendasi[] = [
                'tipe' => 'aman',
                'judul' => 'Pola makan baik',
                'isi' => 'Pola makan Anda sudah cukup teratur.',
                'icon' => 'fa-circle-check'
            ];
        }

        return $rekomendasi; // Mengembalikan kumpulan array daftar saran ke halaman dashboard untuk di-looping
    }

    // =========================================================
    // 8. FUNGSI DATA GRAFIK DASHBOARD ADMIN
    // =========================================================
    public function adminDashboard()
    {
        // Mengambil total angka statistik global sistem untuk pajangan di card dashboard admin
        $totalUser = User::count();
        $totalAktivitas = AktivitasHarian::count();
        $rataSkor = AktivitasHarian::avg('skor');
        $users = User::all();

        // 📈 LOGIKA GRAFIK KESEHATAN: Mengambil rata-rata nilai skor seluruh user, 
        // lalu dikelompokkan (GROUP BY) berdasarkan tanggal kalender agar membentuk diagram garis yang urut.
        $dataSkor = AktivitasHarian::selectRaw('DATE(tanggal) as tanggal, AVG(skor) as skor')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Mengirimkan variabel data grafik ($dataSkor) ke file view admin dashboard
        return view('admin.dashboard', compact(
            'totalUser',
            'totalAktivitas',
            'rataSkor',
            'dataSkor',
            'users'
        ));
    }

    // =========================================================
    // 9. FUNGSI PRIVATE KONVERSI LABEL KONDISI TUBUH
    // =========================================================
    private function getKondisi($skor)
    {
        // Menerjemahkan angka skor mentah (0-100) menjadi kalimat kondisi status fisik manusia
        if ($skor >= 80)
            return "Sangat baik";
        if ($skor >= 60)
            return "Baik";
        if ($skor >= 40)
            return "Cukup";
        if ($skor >= 20)
            return "Buruk";
        return "Sangat buruk"; // Jika nilai skor di bawah 20
    }
}