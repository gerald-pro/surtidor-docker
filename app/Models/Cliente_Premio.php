<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Cliente_Premio extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;
    protected $table = 'cliente_premio';

    protected $fillable = [
        'cliente_id',
        'premio_id',
        'puntos_canjeados',
    ];
}
