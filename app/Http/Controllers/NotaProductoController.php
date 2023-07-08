<?php

namespace App\Http\Controllers;

use App\Models\DetalleProducto;
use App\Models\NotaProducto;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Producto;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
class NotaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_nota_producto = NotaProducto::join('proveedors','nota_productos.proveedor_id','proveedors.id')
                                           ->select('nota_productos.*','proveedors.nombre')->get();
        return view('modulo_compras/compra_producto/index',['lista_nota_producto'=>$lista_nota_producto]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista_proveedores = Proveedor::where('estado','=',true)->select('*')->get();
        $lista_productos = Producto::all();
        return view('modulo_compras/compra_producto/create',['lista_proveedores'=>$lista_proveedores,'lista_productos'=>$lista_productos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor_id = $request->proveedor_id;
        $producto_list = $request->producto_list;
        $total = $request->total;
        $fecha_hora = new DateTime();  
        $fecha_hora->setTimezone(new DateTimeZone('America/La_Paz'));
        $DateAndTime = $fecha_hora->format("Y-m-d H:i:s"); 
        

        $nota_producto =  new NotaProducto();
        $nota_producto->proveedor_id=$proveedor_id;
        $nota_producto->fecha=$DateAndTime;
        $nota_producto->total=$total;
        $nota_producto->save();
        
        

        foreach ($producto_list as $producto) {
            $detalle_producto = new DetalleProducto();
            $detalle_producto->cantidad=$producto['cantidad'];
            $detalle_producto->precio_compra = $producto['precio'];
            $detalle_producto->nota_producto_id=$nota_producto->id;
            $detalle_producto->producto_id=$producto['producto_id'];
            $detalle_producto->save();

            $refill = Producto::find($producto['producto_id']);
            $refill->cantidad = $refill->cantidad + $producto['cantidad'];
            $refill->estado = true;
            $refill->save();
        }

        
        return $nota_producto->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $nota_producto_id = NotaProducto::where('nota_productos.id','=', $id)->select('nota_productos.id')->first();

        $nota_producto = NotaProducto::join('proveedors','nota_productos.proveedor_id','proveedors.id')
                                           ->where('nota_productos.id','=', $id)
                                           ->select('nota_productos.*','proveedors.*')->first();
                                       
        $lista_productos = DetalleProducto::join('producto','detalle_productos.producto_id','producto.id')
                                            ->where('detalle_productos.nota_producto_id','=',$id)
                                            ->select('detalle_productos.*','producto.nombre')->get();                                   
                                       
        return view('modulo_compras.compra_producto.show',compact('nota_producto','lista_productos','nota_producto_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
