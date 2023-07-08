<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Combustible extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;
    protected $fillable = ['nombre','tipo','precio_compra', 'precio_venta', 'unidad_medida'];

    public function tanques()
        {
            return $this->hasMany(Tanque::class);
        }

}
