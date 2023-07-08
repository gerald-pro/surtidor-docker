<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaProducto extends Model
{
    use HasFactory;

    protected $table = 'factura_producto';

    protected $fillable = [
        'nro_factura',
        'fecha_emision',
        'lugar_emision',
        'numero_autorizacion',
        'total',
        'codigo_control',
        'nit',
        'fecha_limite_emision',
        'nombre_razon_social',
        'nota_venta_producto_id',
    ];
}
