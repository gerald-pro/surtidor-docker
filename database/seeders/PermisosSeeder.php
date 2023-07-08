<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            ['name' => 'admin.home', 'description'=>'Ver dashboard'],
            // Modulo Inventario
            //productos
            //------------------------------------------------------------------------
            ['name' => 'productos', 'description'=>'Gestionar productos'],
            //------------------------------------------------------------------------
            ['name' => 'producto.index', 'description'=>'Ver lista de productos'],
            ['name' => 'producto.create', 'description'=>'Crear producto'],
            ['name' => 'producto.edit', 'description'=>'Editar producto'],
            ['name' => 'producto.destroy', 'description'=>'Eliminar producto'],
            //premios
            //------------------------------------------------------------------------
            ['name' => 'premios', 'description'=>'Gestionar premios'],
            //------------------------------------------------------------------------
            ['name' => 'premios.index', 'description'=>'Ver lista de premios'],
            ['name' => 'premios.create', 'description'=>'Crear premio'],
            ['name' => 'premios.edit', 'description'=>'Editar premio'],
            ['name' => 'premios.destroy', 'description'=>'Eliminar premio'],
            // Modulo Compras
            //carga
            //------------------------------------------------------------------------
            ['name' => 'carga', 'description'=>'Gestionar carga'],
            //------------------------------------------------------------------------
            ['name' => 'cargas.index', 'description'=>'Ver lista de cargas'],
            ['name' => 'cargas.create', 'description'=>'Registrar nueva carga'],
            ['name' => 'cargas.edit', 'description'=>'Editar precio de combustible'],
            //combustible
            //------------------------------------------------------------------------
            ['name' => 'combustible_compra', 'description'=>'Gestionar compra de combustible'],
            //------------------------------------------------------------------------
            ['name' => 'combustibles_compra.index', 'description'=>'Ver lista de  pedidos combustibles'],
            ['name' => 'combustibles_compra.create', 'description'=>'Registrar nuevo pedido'],
            //producto
            //------------------------------------------------------------------------
            ['name' => 'producto', 'description'=>'Gestionar compra de productos'],
            //------------------------------------------------------------------------
            ['name' => 'nota_producto.index', 'description'=>'Ver lista de notas de compra de productos'],
            ['name' => 'nota_producto.create', 'description'=>'Registrar nueva nota de compra'],
            ['name' => 'nota_producto.show', 'description'=>'Ver nota de compra'],
            //proveedor
            //------------------------------------------------------------------------
            ['name' => 'proveedor', 'description'=>'Gestionar proveedor'],
            //------------------------------------------------------------------------
            ['name' => 'proveedor.index', 'description'=>'Ver lista de proveedores'],
            ['name' => 'proveedor.create', 'description'=>'Registrar nuevo proveedor'],
            ['name' => 'proveedor.show', 'description'=>'Ver detalle de proveedor'],
            ['name' => 'proveedor.edit', 'description'=>'Editar proveedor'],
            ['name' => 'proveedor.destroy', 'description'=>'Eliminar proveedor'],
            // Modulo Ventas
            //combustible
            //------------------------------------------------------------------------
            ['name' => 'combustible_venta', 'description'=>'Gestionar carga'],
            //------------------------------------------------------------------------
            ['name' => 'nota_venta_combustible.index', 'description'=>'Ver lista de notas de venta de combustible'],
            ['name' => 'nota_venta_combustible.create', 'description'=>'Registrar nueva nota de venta de combustible'],
            ['name' => 'nota_venta_combustible.show', 'description'=>'Ver detalle de nota de venta de combustible'],
            ['name' => 'nota_venta_combustible.graficas', 'description'=>'Ver reporte de graficas de venta de combustible'],
            //productos
            ['name' => 'nota_venta_producto.index', 'description'=>'Ver lista de notas de venta de producto'],
            ['name' => 'nota_venta_producto.create', 'description'=>'Registrar nueva nota de venta de producto'],
            ['name' => 'nota_venta_producto.show', 'description'=>'Ver detalle de nota de venta de producto'],
            ['name' => 'nota_venta_producto.graficas', 'description'=>'Ver reporte de graficas de venta de producto'],
            //-----------------------------------------------------------------------------
            //clientes
            ['name' => 'clientes.index', 'description'=>'Ver lista de clientes'],
            ['name' => 'clientes.create', 'description'=>'Crear nuevo cliente'],
            ['name' => 'clientes.edit', 'description'=>'Editar cliente'],
            //vehiculos
            ['name' => 'vehiculos.index', 'description'=>'Ver lista de vehiculos'],
            ['name' => 'vehiculos.show', 'description'=>'Ver detalle de vehiculo'],
            ['name' => 'vehiculos.edit', 'description'=>'Editar vehiculo'],
            ['name' => 'vehiculos.destroy', 'description'=>'Eliminar vehiculo'],
            //-----------------------------------------------------------------------------
            // Modulo Infraestructura
            //bombas
            ['name' => 'bombas.index', 'description'=>'Ver lista de bombas'],
            ['name' => 'bombas.create', 'description'=>'Registrar nueva bomba'],
            ['name' => 'bombas.show', 'description'=>'Ver detalle de bomba'],
            ['name' => 'bombas.liberar', 'description'=>'Liberar bomba'],
            ['name' => 'bombas.edit', 'description'=>'Editar bombas'],
            ['name' => 'bombas.destroy', 'description'=>'Eliminar bomba'],
            //tanques
            ['name' => 'tanques.index', 'description'=>'Ver lista de tanques'],
            ['name' => 'tanques.create', 'description'=>'Registrar nuevo tanque'],
            ['name' => 'tanques.show', 'description'=>'Ver detalle de tanque'],
            ['name' => 'tanques.destroy', 'description'=>'Eliminar tanque'],
            ['name' => 'tanques.edit', 'description'=>'Editar tanque'],
            //combustibles
            ['name' => 'combustibles.index', 'description'=>'Ver lista de combustibles'],
            ['name' => 'combustibles.create', 'description'=>'Registrar nuevo combustible'],
            ['name' => 'combustibles.show', 'description'=>'Ver detalle de combustible'],
            ['name' => 'combustibles.destroy', 'description'=>'Eliminar combustible'],
            ['name' => 'combustibles.edit', 'description'=>'Editar combustible'],
            // Modulo Administrativo
            //empleados
            ['name' => 'empleados.index', 'description'=>'Ver lista de usuarios'],
            ['name' => 'empleados.create', 'description'=>'Crear nuevo empleado'],
            ['name' => 'empleados.edit', 'description'=>'Editar Empleado'],
            ['name' => 'empleados.destroy', 'description'=>'Eliminar Empleado'],
            ['name' => 'empleados.bombas', 'description'=>'Ver bombas'],
            //roles
            ['name' => 'admin.roles.index', 'description'=>'Ver lista de roles'],
            ['name' => 'admin.roles.create', 'description'=>'Crear nuevo rol'],
            ['name' => 'admin.roles.edit', 'description'=>'Editar rol'],
            ['name' => 'admin.roles.destroy', 'description'=>'Eliminar rol'],
            //turnos
            ['name' => 'turno.index', 'description'=>'Ver lista de turnos'],
            ['name' => 'turno.create', 'description'=>'Crear nuevo turno'],
            ['name' => 'turno.edit', 'description'=>'Editar turno'],
            ['name' => 'turno.asignar', 'description'=>'Asignar empleado a un turno'],
            // Modulo Herramientas
            //bitacora
            ['name' => 'bitacora.index', 'description'=>'Ver lista de transacciones'],
            ['name' => 'bitacora.show', 'description'=>'Ver detalle de transaccion'],

        ];

        foreach ($permisos as $permiso) {
            Permission::create($permiso);
        }

    }

}
