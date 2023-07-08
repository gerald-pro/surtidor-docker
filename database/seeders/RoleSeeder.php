<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Empleado']);
        
        //permisos para un empleado encargado de una bomba
        // Modulo Inventario
            //productos
            //
            $role2->givePermissionTo('productos'); // ver todo el caso de uso producto
            //
            $role2->givePermissionTo('producto.index');
            $role2->givePermissionTo('producto.create');
            $role2->givePermissionTo('producto.edit');
            $role2->givePermissionTo('producto.destroy');
            //premios
            //
            $role2->givePermissionTo('premios'); // ver todo el caso de uso premios
            //
            $role2->givePermissionTo('premios.index');
            $role2->givePermissionTo('premios.create');
            $role2->givePermissionTo('premios.edit');
            $role2->givePermissionTo('premios.destroy');
        // Modulo Ventas     
            //combustible
            $role2->givePermissionTo('nota_venta_combustible.index');
            $role2->givePermissionTo('nota_venta_combustible.create');
            $role2->givePermissionTo('nota_venta_combustible.show');
            //productos
            $role2->givePermissionTo('nota_venta_producto.index');
            $role2->givePermissionTo('nota_venta_producto.create');
            $role2->givePermissionTo('nota_venta_producto.show');
            //-----------------------------------------------------------------------------
            //clientes
            $role2->givePermissionTo('clientes.index');
            $role2->givePermissionTo('clientes.create');
            $role2->givePermissionTo('clientes.edit');
            //vehiculos
            $role2->givePermissionTo('vehiculos.index');
            $role2->givePermissionTo('vehiculos.show');
            $role2->givePermissionTo('vehiculos.edit');
            $role2->givePermissionTo('vehiculos.destroy');
            //-----------------------------------------------------------------------------    

    }
}
