<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaProducto extends Model
{
    use HasFactory;
    protected $table = 'nota_productos';
    protected $fillable = [
        'fecha',
        'total',
        'proveedor_id',
    ];

}
