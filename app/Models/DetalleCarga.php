<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCarga extends Model
{
    use HasFactory;
    protected $table = 'detalle_cargas';
    protected $fillable = [
        'cantidad',
        'precio_unitario', //que es el precio compra
        'nota_carga_id',
        'tanque_codigo',
    ];
}
