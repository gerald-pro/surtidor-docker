<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NotaComprasExport implements FromQuery, ShouldAutoSize
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return DB::table('nota_cargas')
            ->join('combustibles', 'nota_cargas.combustible_id', '=', 'combustibles.id')
            ->select(['nota_cargas.id', 'nota_cargas.total','combustibles.nombre as combustible'])
            ->orderBy('id');
    }

    public function headings(): array
    {
        return [
            'ID',
            'FECHA',
            'COMBUSTIBLE',
        ];
    }
    
}
