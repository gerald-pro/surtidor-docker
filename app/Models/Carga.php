<?php

namespace App\Models;
use App\Models\Tanque;
use App\Models\Combustible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carga extends Model
{
    use HasFactory;
    protected $fillable=['codigo','fecha','cantidad_total','cantidad_tanque','precio_unitario','precio_total','tanque_id','combustible_id'];

    public function tanques(){
        return $this->belongsToMany(Tanque::class,'id','codigo'); // PErtenece a categoria 1 bomba pertenece a una categoria

    }
    public function combustibles(){
        return $this->belongsToMany(Combustible::class,'id','combustible_id'); // PErtenece a categoria 1 bomba pertenece a una categoria

    }
}
