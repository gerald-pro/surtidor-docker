<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable  implements Auditable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellido',
        'email',
        'password',
        'direccion',
        'telefono',
        'estado',
        'foto_perfil',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'users_turnos', 'user_id', 'turno_id')->withPivot('id')->withTimestamps();
    }

    public function role_name()
    {
        $role = DB::table('model_has_roles')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('model_has_roles.model_id', '=', $this->id)
            ->select('roles.*')
            ->get()
            ->first();
            
            return $role? $role->name:"";
    }

    public function userBombas()
    {
        return $this->hasMany(UserBomba::class);
    }

    public function userTurno()
    {
        return $this->hasMany(UserTurno::class);
    }
}
