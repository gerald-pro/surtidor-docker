<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'tipo',
        'marca',
        'b_sisa',
        'cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function NotaVentaCombustible()
    {
        return $this->hasMany(NotaVentaCombustible::class);
    }
}
