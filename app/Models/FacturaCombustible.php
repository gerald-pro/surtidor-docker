<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaCombustible extends Model
{
    use HasFactory;

    protected $table = 'factura_combustible';

    protected $fillable = [
        //vendedor
        //turno del vendedor
        //bomba desde donde vende
        //placa del automovil
        'placa',
        'nro_factura',
        'fecha_emision',
        'lugar_emision',
        'numero_autorizacion',
        'total',
        'codigo_control',
        'nit',
        'fecha_limite_emision',
        'nombre_razon_social',
        'nota_venta_combustible_id',
    ];

    public function NotaVentaCombustible()
    {
        return $this->hasOne(NotaVentaCombustible::class,'nota_venta_combustible_id');
    }
}
