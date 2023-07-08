<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VentasProductosExport implements FromQuery, ShouldAutoSize
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return DB::table('nota_venta_producto')
            ->join('clientes', 'nota_venta_producto.cliente_id', '=', 'clientes.id')
            ->select(['nota_venta_producto.id', 'nota_venta_producto.total','clientes.nombre as cliente'])
            ->orderBy('id');
    }

    public function headings(): array
    {
        return [
            'ID',
            'FECHA',
            'TOTAL',
            'CLIENTE',
        ];
    }
    
}
