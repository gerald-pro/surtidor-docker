<?php

namespace App\Exports;

use App\Models\NotaVentaCombustible;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VentasCombustiblesExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return DB::table('nota_venta_combustible')
            ->join('vehiculos', 'nota_venta_combustible.vehiculo_id', 'vehiculos.id')
            ->join('clientes', 'vehiculos.cliente_id', 'clientes.id')
            ->select(['nota_venta_combustible.id','nota_venta_combustible.fecha','nota_venta_combustible.total', 'clientes.nombre as cliente', 'vehiculos.placa',])
            ->orderBy('fecha');
    }

    public function headings(): array
    {
        return [
            'ID',
            'FECHA',
            'TOTAL',
            'CLIENTE',
            'PLACA',
        ];
    }
}
