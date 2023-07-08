<?php

namespace App\Http\Controllers;

use App\Models\FacturaProducto;
use App\Models\NotaVentaProducto;
use App\Models\DetalleNotaVentaProducto;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Carbon\Carbon;
use App\Models\Cliente;




class FacturaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $nota_venta_producto = NotaVentaProducto::find($id);
        $cliente = Cliente::find($nota_venta_producto->cliente_id);
        return view('modulo_ventas/factura_producto/create',['nota_venta_producto_id' => $id,'cliente'=>$cliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$nota_venta_producto_id)
    {
        $fecha_hora = new DateTime();
        $fecha_hora->setTimezone(new DateTimeZone('America/La_Paz'));
        $DateAndTime = $fecha_hora->format("Y-m-d H:i:s");
        $permitted_chars  =  '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' ;
        $nota_venta_producto = NotaVentaProducto::find($nota_venta_producto_id);

        $factura = new FacturaProducto();
        $factura->nro_factura = random_int(1000, 999999999);
        $factura->fecha_emision = $DateAndTime;
        $factura->lugar_emision = "Santa Cruz de la Sierra";
        $factura->numero_autorizacion = random_int(10000, PHP_INT_MAX);
        $factura->total = $nota_venta_producto->total;
        $factura->codigo_control = substr ( str_shuffle ( $permitted_chars ),  0 ,  16 );
        $factura->nit = $request->nit;
        $factura->fecha_limite_emision = $this->fechaLimiteEmision($DateAndTime);
        $factura->nombre_razon_social = $request->nombre;
        $factura->nota_venta_producto_id = $nota_venta_producto_id;
        $factura->save();

        return redirect('factura_producto/'.$nota_venta_producto_id.'/generateInvoice');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function fechaLimiteEmision($fechaEmision){
        //sumo 5 meses
        return date("Y-m-d", strtotime($fechaEmision . "+ 5 month"));
    }

    public function generateInvoice($nota_venta_producto_id){

        $cliente = NotaVentaProducto::join('clientes', 'nota_venta_producto.cliente_id', 'clientes.id')
                                             ->where('nota_venta_producto.id', '=', $nota_venta_producto_id)
                                             ->select('clientes.nombre','clientes.apellido')->first();

        $lista_productos = DetalleNotaVentaProducto::join('producto', 'detalle_nota_venta_producto.producto_id', 'producto.id')
                                                     ->where('detalle_nota_venta_producto.nota_venta_producto_id', '=', $nota_venta_producto_id)
                                                     ->select('detalle_nota_venta_producto.*', 'producto.nombre', 'producto.precio_venta')->get();
                                                
        
        
        $factura = FacturaProducto::where('nota_venta_producto_id', '=', $nota_venta_producto_id)->select('*')->first(); 

        //Cliente
        $customer = new Buyer([
                'name' => $factura->nombre_razon_social,
                'custom_fields' => [
                    'Nit' => $factura->nit,
                    'Lugar' => $factura->lugar_emision,
                ],
            ]);

        //vendedor-negocio
            $seller = new Buyer([
                'name' => 'Surtidor Bicentenario',
                'custom_fields' => [
                    'Nit' => '2371912234567',
                    'Lugar' => 'Santa Cruz de la Sierra',
                    'Razon Social' => 'Venta de Combustible y Productos automotor'
                ],
            ]);

        foreach ($lista_productos as $producto) {
            $items[] = (new InvoiceItem())->title($producto->nombre)->pricePerUnit($producto->precio_venta)->quantity($producto->cantidad);
        }    

        $fecha_emision = new DateTime($factura->fecha_limite_emision);
        $cadena = $fecha_emision->format('d/m/Y');

        $notes = [
            $factura->lugar_emision,
            'Nro. de autorizacion: '. $factura->numero_autorizacion,
            'Cod. de control: '. $factura->codigo_control,
            'Fecha limite emision: '. $cadena,
            
        ];
        $notes = implode("<br>", $notes);
        
        $fecha = Carbon::createFromFormat('Y-m-d H:i:s',$factura->fecha_emision);

        $invoice = Invoice::make()
            
            ->serialNumberFormat('{SERIES}')
            ->date($fecha)
            ->dateFormat('d/m/Y')
            ->buyer($customer)
            ->seller($seller)
            ->currencySymbol('Bs')
            ->currencyCode('BOB')
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('img/logo/LogoSurtidor.jpg'))
            ->series($factura->nro_factura)
            ->payUntilDays(0);
        return $invoice->stream();
    }
}
