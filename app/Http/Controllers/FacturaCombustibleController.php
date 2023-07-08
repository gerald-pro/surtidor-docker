<?php

namespace App\Http\Controllers;
use App\Models\FacturaCombustible;
use App\Models\NotaVentaCombustible;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Combustible;

class FacturaCombustibleController extends Controller
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
        $nota_venta_combustible = NotaVentaCombustible::find($id);
        $cliente = $nota_venta_combustible->vehiculo->cliente;
        return view('modulo_ventas/factura_combustible/create',compact('nota_venta_combustible','cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$nota_venta_combustible_id)
    {
        $fecha_hora = new DateTime();
        $fecha_hora->setTimezone(new DateTimeZone('America/La_Paz'));
        $DateAndTime = $fecha_hora->format("Y-m-d H:i:s");
        $permitted_chars  =  '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' ;
        $nota_venta_combustible = NotaVentaCombustible::find($nota_venta_combustible_id);

        $factura = new FacturaCombustible();
        $factura->placa = $nota_venta_combustible->vehiculo->placa;
        $factura->nro_factura = random_int(1000, 999999999);
        $factura->fecha_emision = $DateAndTime;
        $factura->lugar_emision = "Santa Cruz de la Sierra";
        $factura->numero_autorizacion = random_int(10000, PHP_INT_MAX);
        $factura->total = $nota_venta_combustible->total;
        $factura->codigo_control = substr ( str_shuffle ( $permitted_chars ),  0 ,  16 );
        $factura->nit = $request->nit;
        $factura->fecha_limite_emision = $this->fechaLimiteEmision($DateAndTime);
        $factura->nombre_razon_social = $request->nombre;
        $factura->nota_venta_combustible_id = $nota_venta_combustible_id;
        $factura->save();

        return redirect('factura_combustible/'.$nota_venta_combustible_id.'/generateInvoice');
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

    public function generateInvoice($nota_venta_combustible_id){

        $nota_venta_combustible = NotaVentaCombustible::find($nota_venta_combustible_id);                               
        $combustible =  $nota_venta_combustible->userBombas->bomba->tanque->combustible;
        $factura = FacturaCombustible::where('nota_venta_combustible_id', '=', $nota_venta_combustible_id)->select('*')->first(); 

        //Cliente
        $customer = new Buyer([
                'name' => $factura->nombre_razon_social,
                'custom_fields' => [
                    'Nit' => $factura->nit,
                    'Lugar' => $factura->lugar_emision,
                    'Placa' => $factura->placa,
                ],
        ]);

        //vendedor-negocio
            $user = $nota_venta_combustible->userBombas->user;
            $turno = $nota_venta_combustible->turno->descripcion;
            
            $bomba = $nota_venta_combustible->userBombas->bomba;
            $seller = new Buyer([
                'name' => 'Surtidor Bicentenario',
                'custom_fields' => [
                    'Nit' => '2371912234567',
                    'Lugar' => 'Santa Cruz de la Sierra',
                    'Razon Social' => 'Venta de Combustible y Productos automotor',
                    'Vendedor' => $user->name,
                    'Turno' => $turno,
                    'Bomba' => $bomba->nombre,
                ],
            ]);
         
        $items[] = (new InvoiceItem())->title($combustible->nombre)->pricePerUnit($combustible->precio_venta)->quantity($nota_venta_combustible->cantidad_combustible);

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
