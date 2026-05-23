<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artikel;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run()
    {
        Artikel::create([
            'judul' => 'Penyakit Tidak Menular: Ancaman Senyap',
            'gambar' => 'pemweb_1.jpg',
            'link' => 'https://cisdi.org/artikel/penyakit-tidak-menular'
        ]);

        Artikel::create([
            'judul' => 'Kiat Mencegah Penyakit Tidak Menular',
            'gambar' => 'pemweb_2.jpg',
            'link' => 'https://keslan.kemkes.go.id'
        ]);

        Artikel::create([
            'judul' => 'Penyakit Tidak Menular PTM, Penyebab dan Pencegahannya',
            'gambar' => 'pemweb_3.jpg',
            'link' => 'https://puskesmasbaganbatu.rohilkab.go.id/detailpost/penyakit-tidak-menular-ptm-penyebab-dan-pencegahannya'
        ]);

        Artikel::create([
            'judul' => 'Ayo, Lakukan Deteksi Dini untuk Cegah dan Kendalikan PTM',
            'gambar' => 'pemweb_5.jpg',
            'link' => 'https://www.youtube.com/watch?v=5VpizHVkj8M'
        ]);

        Artikel::create([
            'judul' => '10 Cara Meredakan dan Mencegah Gejala Asam Lambung',
            'gambar' => 'pemweb_4.jpg',
            'link' => 'https://fk.umsida.ac.id/10-cara-mencegah-gejala-asam-lambung/'
        ]);

        Artikel::create([
            'judul' => '10 Cara Menjaga Kesehatan Paru-Paru agar Tetap Optimal',
            'gambar' => 'pemweb_6.jpg',
            'link' => 'https://royalprogress.com/id/blog/kesehatan-umum/cara-menjaga-kesehatan-paru/'
        ]);

        Artikel::create([
            'judul' => 'Cara Mencegah Penyakit Ginjal dengan Langkah Sederhana',
            'gambar' => 'pemweb_7.jpg',
            'link' => 'https://puskesmassedau-dikes.lombokbaratkab.go.id/artikel/cara-mencegah-penyakit-ginjal-dengan-langkah-sederhana/'
        ]);

        Artikel::create([
            'judul' => 'Kenali Cara Pencegahan GERD',
            'gambar' => 'pemweb_8.jpg',
            'link' => 'https://www.rspondokindah.co.id/id/news/hindari-gangguan-asam-lambung'
        ]);

        Artikel::create([
            'judul' => 'Edukasi Pencegahan Obesitas dan Diabetes melalui Pola Hidup Sehat',
            'gambar' => 'pemweb_9.jpg',
            'link' => 'https://share.google/nQASy9rBbnoUxhuVo'
        ]);

    }
}
