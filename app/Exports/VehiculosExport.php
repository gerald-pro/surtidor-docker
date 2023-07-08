<?php

namespace App\Exports;

use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehiculosExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return  DB::table('vehiculos')
        ->join('clientes', 'vehiculos.cliente_id', '=', 'clientes.id')
        ->select(['vehiculos.placa', 'vehiculos.tipo', 'vehiculos.marca','clientes.nombre as cliente'])
        ->orderBy('placa');

    }

    public function headings(): array
    {
        return [
            'PLACA',
            'TIPO',
            'MARCA',
            'CLIENTE'
        ];
    }
}
