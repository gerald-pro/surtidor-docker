<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNotaVentaProducto extends Model
{
    use HasFactory;
    protected $table = 'detalle_nota_venta_producto';
    protected $fillable = [
        'cantidad',
        'nota_venta_producto_id',
        'producto_id',
      ];
}
