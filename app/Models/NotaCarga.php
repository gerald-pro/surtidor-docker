<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaCarga extends Model
{
    use HasFactory;
    protected $table = 'nota_cargas';
    protected $fillable = [
        'fecha',
        'total',
        'combustible_nombre',
    ];
}
