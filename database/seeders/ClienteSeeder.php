<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cliente = new Cliente();
        $cliente->nombre = 'Gerald José';
        $cliente->apellido = 'Avalos Severiche';
        $cliente->ci = '14495734';
        $cliente->telefono = '70480741';
        $cliente->puntos = 5000;
        $cliente->estado = true;
        $cliente->save();

        $cliente = new Cliente();
        $cliente->nombre = 'Predeterminado';
        $cliente->apellido = '';
        $cliente->ci = '0';
        $cliente->telefono = '0';
        $cliente->puntos = 0;
        $cliente->estado = true;
        $cliente->save();
    }
}
