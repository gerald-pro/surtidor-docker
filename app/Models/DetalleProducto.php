<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProducto extends Model
{
    use HasFactory;
    protected $table = 'detalle_productos';
    protected $fillable = [
        'cantidad',
        'precio_compra',
        'nota_producto_id',
        'producto_id',
    ];
}
