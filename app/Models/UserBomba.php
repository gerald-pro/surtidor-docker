<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBomba extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'fecha_asignacion',
        'asignacion_vigente',
        'user_id',
        'bomba_id',
    ];

    public function bomba()
    {
        return $this->belongsTo('App\Models\Bomba','bomba_id');
    }

    public function notaVentaCombustible()
    {
        return $this->hasMany(NotaVentaCombustible::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}