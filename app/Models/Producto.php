<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;
class Producto extends Model //implements Auditable
{
    //use AuditingAuditable;
    use HasFactory;

    protected $table = 'producto';

    protected $fillable = [
        'codigo',
        'nombre',
        'precio_compra',
        'precio_venta',
        'cantidad',
        'estado',
        'descripcion',
        'imagen',
    ];
    
    public function premio()
    {
        return $this->belongsTo(Premio::class, 'producto_id', 'id');
    }

}
