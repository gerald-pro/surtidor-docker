<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;
    protected $fillable = [
        'hora_entrada',
        'hora_salida',
        'descripcion',   
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_turnos', 'turno_id', 'user_id')->withPivot('id')->withTimestamps();
    }

    public function userTurno()
    {
        return $this->hasMany(UserTurno::class);
    }

    public function notaVentaCombustible()
    {
        return $this->hasMany(notaVentaCombustible::class);
    }
}
