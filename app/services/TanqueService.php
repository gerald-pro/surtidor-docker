<?php

namespace App\Services;

use App\Models\Tanque;
use Carbon\Carbon;

class TanqueService
{
    public function list()
    {
        $tanques = Tanque::orderby('codigo', 'desc')->get();
        return compact('tanques');
    }

    public function recargar($cantidad_recarga, Tanque $tanque)
    {
        $cantidad_actual = $tanque->cantidad_disponible + $cantidad_recarga;

        $tanque->update([
            'cantidad_disponible' => $cantidad_actual,
            'fecha_carga' => Carbon::now(),
        ]);
    }

    public function llenar(Tanque $tanque)
    {
        $tanque->update([
            'cantidad_disponible' => $tanque->capacidad,
            'fecha_carga' => Carbon::now(),
        ]);
    }
}
