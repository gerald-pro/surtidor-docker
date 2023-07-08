<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCargaRequest;
use App\Http\Requests\UpdateCargaRequest;
use App\Models\Tanque;
use App\Models\Carga;
use App\Models\Combustible;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Support\Facades\Validator;

class CargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $cargas = Carga::orderby('codigo', 'desc')->get();
        return view('pages.cargas.index',compact('cargas')); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* $cargas= new Carga();
        $tanques=Tanque::pluck('codigo','id');
        $combustibles=Combustible::pluck('codigo','id');
        return view('pages.cargas.create',compact('cargas','tanques','combustibles')); */

       /*  $lista_combustibles = Combustible::all();//combustibles
        $lista_tanques = Tanque::all(); //productos
        return view('pages/cargas/create',['lista_combustibles'=>$lista_combustibles,'lista_tanques'=>$lista_tanques]); */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCargaRequest $request, Carga $carga)
    {
       /*  $codTanque= $request->cod_tanque;
        $sql = "SELECT * FROM tanques where codigo='".$codTanque."'";
        $tanque = DB::select($sql);


        $cargaDisponible=0;
        foreach($tanque as $item){
            if($item->cantidad_disponible){
                $cargaDisponible=$item->cantidad_disponible;
            }
         }
        foreach($tanque as $tan){
            if($tan->capacidad >=($request->cantidad+$cargaDisponible)){
    
            $Carga = Carga::create([
            'codigo'=>$request->codigo,
            'fecha'=>$request->fecha,
            'cantidad'=>$request->cantidad,
            'precio_unitario'=>$request->precio_unitario,
            'precio_total'=>$request->precio_total,
            ]);
            //--TRIGGER->PROCEDIMIENTO ALMACENADO
            $cantidadRenovada=$cargaDisponible+=$request->cantidad;
            $sql = "UPDATE tanques  SET cantidad_disponible='".$cantidadRenovada."' where codigo='".$codTanque."' ";
            DB::select($sql);
            return redirect()->route('cargas.show', $Carga);
             }
        } */

        /* $combustible_id = $request->combustible_id;
        $tanque_list = $request->tanque_list;
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

        
        return $nota_producto->id; */
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Carga $carga)
    {
     /*    return view('pages.cargas.show', compact('carga')); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Carga $carga)
    {
       /*  return view('pages.cargas.edit', compact('carga')); */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCargaRequest $request, Carga $carga)
    {
       
        /* $carga->update($request->all());
        return redirect()->route('cargas.show', $carga); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carga $carga)
    {
        /* $carga->delete();
        return redirect()->route('cargas.index'); */
    }

    //Para la tabla dinamica
    public function tabla(){
        

    }
}
