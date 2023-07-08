<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencias';

    protected $fillable = [
        'fecha_entrada',
        'fecha_salida',
        'user_turno_id',
    ];
}
