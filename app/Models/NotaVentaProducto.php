<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVentaProducto extends Model
{
    use HasFactory;
    protected $table = 'nota_venta_producto';
    protected $fillable = [
        'fecha',
        'total',
        'cliente_id',
      ];

}
