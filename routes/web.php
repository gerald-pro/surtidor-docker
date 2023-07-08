<?php

use App\Http\Controllers\BackupsController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TanqueController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\PremioController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\UserTurnoController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\BombaController;
use App\Http\Controllers\CombustibleController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FacturaCombustibleController;
use App\Http\Controllers\NotaCargaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\NotaProductoController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserBombaController;
//use App\Http\Controllers\VentaCombustibleController;


use App\Http\Controllers\NotaVentaProductoController;
use App\Http\Controllers\FacturaProductoController;

use App\Http\Controllers\NotaVentaCombustibleController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
/* Route::get('/', function () {
    return view('adminlte::page');
})->middleware('auth'); */

Route::get('',[HomeController::class, 'dashboard'])->name('admin.home');

//-----------------EMPLEADO-----------------//
Route::resource('empleados', UserController::class);
Route::get('empleados-bombas/{user}',[UserController::class, 'bombas'])->name('empleadobombas.index');
Route::post('empleados-bombas/{user}',[UserController::class, 'asignarbombas'])->name('empleadobombas.create');
Route::delete('empleados-bombas/{user_bomba}',[UserController::class, 'eliminarbombas'])->name('empleadobombas.destroy');

Route::resource('roles',RoleController::class)->names('admin.roles');
//-----------------TURNO-----------------//
Route::resource('turno',TurnoController::class);
Route::get('turno/{turno}/add-user', [TurnoController::class, 'addUser'])->name('turno.addUser');
Route::post('turno/{turno}/add-user/', [TurnoController::class, 'storeUser'])->name('turno.storeUser');
Route::delete('turno/{turno}/destroy-user/{user_id}',[TurnoController::class, 'destroyUser'])->name('turno.destroyUser');
//-----------------EMPLEADO_TURNO-----------------//
Route::get('/user_turno/{id_turno}', [UserTurnoController::class, 'index'])->name('user_turno.index');
Route::get('/user_turno/create/{id_turno}', [UserTurnoController::class, 'create'])->name('user_turno.create');
Route::post('/user_turno/create/{id_turno}', [UserTurnoController::class, 'store'])->name('user_turno.store');
Route::delete('/user_turno/{id_turno}/delete/{id_empleadoturno}', [UserTurnoController::class, 'destroy'])->name('user_turno.destroy');
//-----------------PRODUCTO----------------------//
Route::resource('producto',ProductoController::class);
//-----------------NOTAPRODUCTO----------------------//
Route::get('nota_producto',[NotaProductoController::class,'index'])->name('nota_producto.index');
Route::get('nota_producto/create',[NotaProductoController::class,'create'])->name('nota_producto.create');
Route::post('nota_producto',[NotaProductoController::class,'store'])->name('nota_producto.store');
//-----------------DETALLEPRODUCTO----------------------//
Route::get('detalle_producto/{nota_producto_id}',[NotaProductoController::class,'show'])->name('detalle_producto.show');

//-----------------NOTAVENTAPRODUCTO-----------------//
Route::get('ventas-productos/reportes',[NotaVentaProductoController::class,'index'])->name('ventas_productos.reportes');
Route::get('ventas-productos/graficas',[NotaVentaProductoController::class,'graficas'])->name('ventas_productos.graficas');
Route::get('nota_venta_producto/create',[NotaVentaProductoController::class,'create'])->name('nota_venta_producto.create');
Route::post('nota_venta_producto',[NotaVentaProductoController::class,'store'])->name('nota_venta_producto.store');
Route::get('ventas-productos/reportes/export-html', [NotaVentaProductoController::class, 'exportHTML'])->name('ventas_productos.export.html');
Route::post('/fetch/ventas-productos/monto-total-mes',[NotaVentaProductoController::class, 'ventasMes'])->name('fetch.ventas_productos.mes');
Route::post('/fetch/ventas-productos/monto-promedio-x-venta',[NotaVentaProductoController::class, 'montoPromedioVentaMes'])->name('fetch.ventas_productos.monto_promedio.mes');

//-----------------DETALLENOTAVENTAPRODUCTO-----------------//
Route::get('detalle_nota_venta_producto/{nota_venta_producto_id}',[NotaVentaProductoController::class,'show'])->name('detalle_nota_venta_producto.show');

//------------------Generar Factura/Producto--------------------------
Route::get('factura_producto/{nota_venta_producto_id}/generateInvoice',[FacturaProductoController::class,'generateInvoice'])->name('factura_producto.generateInvoice');
Route::get('factura_producto/{nota_venta_producto_id}',[FacturaProductoController::class,'create'])->name('factura_producto.create');
Route::post('factura_producto/{nota_venta_producto_id}',[FacturaProductoController::class,'store'])->name('factura_producto.store');


//------------------Generar Factura/Combustible--------------------------
Route::get('factura_combustible/{nota_venta_combustible_id}/generateInvoice',[FacturaCombustibleController::class,'generateInvoice'])->name('factura_combustible.generateInvoice');
Route::get('factura_combustible/{nota_venta_combustible_id}',[FacturaCombustibleController::class,'create'])->name('factura_combustible.create');
Route::post('factura_combustible/{nota_venta_combustible_id}',[FacturaCombustibleController::class,'store'])->name('factura_combustible.store');



//------------------NotaVentaCombustible--------------------------
Route::get('nota_venta_combustible',[NotaVentaCombustibleController::class,'index'])->name('nota_venta_combustible.index');
Route::get('nota_venta_combustible/create',[NotaVentaCombustibleController::class,'create'])->name('nota_venta_combustible.create');
Route::post('nota_venta_combustible',[NotaVentaCombustibleController::class,'store'])->name('nota_venta_combustible.store');
Route::get('nota_venta_combustible/{nota_venta_combustible_id}/show',[NotaVentaCombustibleController::class,'show'])->name('nota_venta_combustible.show');
Route::get('nota_venta_combustible/reportes/export-html', [NotaVentaCombustibleController::class, 'exportHTML'])->name('ventas_combustibles.export.html');
Route::get('ventas-combustibles/graficas',[NotaVentaCombustibleController::class,'graficas'])->name('ventas_combustibles.graficas');
Route::post('/fetch/ventas-combustibles/monto-total-mes',[NotaVentaCombustibleController::class, 'ventasMes'])->name('fetch.ventas_combustibles.mes');
Route::post('/fetch/ventas-combustibles/monto-promedio-x-venta',[NotaVentaCombustibleController::class, 'montoPromedioVentaMes'])->name('fetch.ventas_combustibles.monto_promedio.mes');
Route::post('/fetch/ventas-combustibles/ventas-promedio-x-dia',[NotaVentaCombustibleController::class, 'ventasPromedioDia'])->name('fetch.ventas_combustibles.ventas_promedio.dia');
Route::post('/fetch/ventas-combustibles/litros-vendidos',[NotaVentaCombustibleController::class, 'litrosVendidosMes'])->name('fetch.ventas_combustibles.litros_vendidos');

//-----------------PROVEEDORES------------------//
Route::resource('proveedor', ProveedorController::class);
Route::get('/proveedor/{id}/desactivar', [ProveedorController::class, 'desactivar']);
Route::get('/proveedor/{id}/activar', [ProveedorController::class, 'activar']);

//-----------------CLIENTES--------------------//
Route::resource('clientes', ClienteController::class)->middleware('auth');
Route::get('clientes/{cliente}/canjear', [ClienteController::class, 'canjeo'])->name('clientes.canjeo');
Route::patch('clientes/{cliente}/canjear', [ClienteController::class, 'canjear'])->name('clientes.canjear');
Route::put('clientes/{cliente}/premios/{premio}', [ClienteController::class, 'destroyPremio'])->name('clientes.destroyPremio');
Route::post('clientes/{cliente}/vehiculos', [ClienteController::class, 'storeVehiculo'])->name('clientes.vehiculos.store');
Route::post('/fetch/clientes/find-by-vehiculo',[ClienteController::class, 'findByVehiculo'])->name('fetch.clientes.find');
//-----------------ASISTENCIA------------------//
Route::get('asistencia', [AsistenciaController::class,'index'])->name('asistencia.index'); 
Route::get('asistencia/{turno}/create', [AsistenciaController::class,'create'])->name('asistencia.create'); 
Route::post('asistencia/{turno_id}/{user_id}/entrada', [AsistenciaController::class,'entrada'])->name('asistencia.entrada');
Route::put('asistencia/{turno_id}/{user_id}/salida', [AsistenciaController::class,'salida'])->name('asistencia.salida');
Route::get('asistencia/user_turno/{turno_id}', [AsistenciaController::class,'getUserByTurno'])->name('asistencia.user_turno');
//-----------------TANQUES-----------------//
Route::resource('tanques', TanqueController::class)->middleware('auth');
Route::put('tanques/{tanque}/recargar', [TanqueController::class, 'recargar'])->name('tanques.recargar');
Route::put('tanques/{tanque}/llenar', [TanqueController::class, 'llenar'])->name('tanques.llenar');
//-----------------PREMIOS-----------------//
Route::resource('premios', PremioController::class)->middleware('auth');
//-----------------VEHICULOS-----------------//
Route::resource('vehiculos', VehiculoController::class);
Route::get('vehiculos/reportes/export-html', [VehiculoController::class, 'exportHTML'])->name('vehiculos.export.html');
//---------------BOMBAS------------//
Route::resource('bombas', BombaController::class);

Route::put('bombas/{bomba_id}/liberar',[BombaController::class,'liberarBomba'])->name('bombas.liberar');


//Route::resource('cargas', CargaController::class);

Route::resource('categorias', CategoriaController::class);
Route::resource('combustibles', CombustibleController::class);

Route::get('/fetch/combustibles/niveles',[CombustibleController::class, 'nivelesCombustible'])->name('fetch.combustibles.niveles');
Route::resource('pedidos', PedidoController::class);


//-----------------NOTACARGA----------------------//
//Route::get('cargas/index',[NotaCargaController::class,'index'])->name('cargas.index');
Route::get('cargas/create',[NotaCargaController::class,'create'])->name('cargas.create');
Route::post('cargas',[NotaCargaController::class,'store'])->name('cargas.store');
Route::get('cargas/reportes',[NotaCargaController::class,'index'])->name('cargas.reportes');
Route::get('pages/cargas/reportes/export-html', [NotaCargaController::class, 'exportHTML'])->name('cargas.export.html');
//-----------------DETALLECARGA----------------------//
Route::get('cargas/show/{nota_carga_id}',[NotaCargaController::class,'show'])->name('cargas.show');


//Bombas Reportes//
Route::get('/pages/bombas/export',[BombaController::class, 'exportBomba'])->name('bombas.export');
Route::get('/pages/bombas/download', [BombaController::class, 'downloadPDF'])->name('download-pdf');
Route::get('/bombas-html',[BombaController::class, 'bombaHtml'])->name('bombas-html');
//Categorias Reportes//
Route::get('/pages/categorias/export',[CategoriaController::class, 'exportCategoria'])->name('categorias.export');
//Route::get('/pages/categorias/download', [CategoriaController::class, 'downloadPDF'])->name('download-pdf');
Route::get('/categorias-html',[CategoriaController::class, 'categoriahtml'])->name('categorias-html');

//USER_BOMBA
Route::get('user-bombas/index',[UserBombaController::class, 'index'])->name('userbombas.index');

//VENTA COMBUSTIBLE
/* Route::get('venta/combustible/create/{bomba}',[VentaCombustibleController::class, 'create'])->name('venta.combustible.create');
Route::get('venta/combustible/bomba',[VentaCombustibleController::class, 'bombasList'])->name('venta.combustible.bombasList');
Route::post('venta/combustible/bomba_v/{bomba}',[VentaCombustibleController::class, 'vendido'])->name('venta.combustible.bomba_v'); */

//Bitacora
Route::resource('bitacora', BitacoraController::class)->middleware('auth');
Route::get('backups/{name}/downloadFile',[BackupsController::class,'downloadFile'])->middleware('auth');
Route::resource('backups', BackupsController::class)->middleware('auth');
