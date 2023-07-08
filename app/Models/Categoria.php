<?php

namespace App\Models;
use App\Models\Combustible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable=['codigo','nombre','descripcion','descripcion'];

    public function combustibles(){
        return $this->hasMany(Combustible::class,'id'); 

    }
}
