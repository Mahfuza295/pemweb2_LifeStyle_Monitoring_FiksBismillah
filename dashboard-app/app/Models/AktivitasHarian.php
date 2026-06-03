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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSkorAttribute(): int
    {
        $skor = 0;
        $skor += min((int) $this->makan, 3) * 10;
        $skor += min((int) $this->olahraga, 30) / 30 * 25;
        $skor += min((float) $this->tidur, 8) / 8 * 25;
        $skor += min((int) $this->air_minum, 8) / 8 * 20;

        return (int) round($skor);
    }

    public function getKategoriAttribute(): string
    {
        if ($this->skor >= 85) {
            return 'Sangat Baik';
        }

        if ($this->skor >= 70) {
            return 'Baik';
        }

        if ($this->skor >= 55) {
            return 'Cukup';
        }

        return 'Perlu Ditingkatkan';
    }
}
