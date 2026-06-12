<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasHarian extends Model
{
    protected $table = 'aktivitas_harian';

    protected $fillable = [
        'user_id',
        'tanggal',
        'makan',
        'olahraga',
        'tidur',
        'air_minum',
        'catatan',
        'skor',
    ];

    // AUTO HITUNG SKOR SAAT SIMPAN
    protected static function booted()
    {
        static::saving(function ($model) {

            $skor = 0;

            $skor += ($model->makan >= 3) ? 25 : 10;
            $skor += ($model->olahraga >= 30) ? 25 : 10;
            $skor += ($model->tidur >= 7) ? 25 : 10;
            $skor += ($model->air_minum >= 8) ? 25 : 10;

            $model->skor = $skor;
        });
    }

    // RELASI
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // OPTIONAL: kategori saja (ini aman)
    public function getKategoriAttribute(): string
    {
        if ($this->skor >= 85) return 'Sangat Baik';
        if ($this->skor >= 70) return 'Baik';
        if ($this->skor >= 55) return 'Cukup';
        return 'Perlu Ditingkatkan';
    }
}