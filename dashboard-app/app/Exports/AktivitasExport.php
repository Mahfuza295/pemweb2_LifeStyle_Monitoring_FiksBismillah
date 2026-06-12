<?php

namespace App\Exports;

use App\Models\AktivitasHarian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AktivitasExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        $query = AktivitasHarian::query();

        if (auth()->check()) {
            $query->where('user_id', auth()->id());
        }

        return $query->latest('tanggal')->get()->map(function ($item) {
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

    public function headings(): array
    {
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