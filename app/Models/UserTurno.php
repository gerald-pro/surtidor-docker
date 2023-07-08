<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTurno extends Model
{
    use HasFactory;
    protected $table = 'users_turnos';
    protected $fillable = [
     'user_id',
     'turno_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class,'turno_id');;
    }

}
