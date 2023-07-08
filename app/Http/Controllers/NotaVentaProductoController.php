<?php

namespace App\Http\Controllers;

use App\Exports\VentasProductosExport;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\NotaVentaProducto;
use App\Models\DetalleNotaVentaProducto;
use App\Models\FacturaProducto;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Traits\ReporteTrait;

class NotaVentaProductoController extends Controller
{
    use ReporteTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $nota_venta_producto = DB::table('nota_venta_producto')
                ->join('clientes', 'nota_venta_producto.cliente_id', '=', 'clientes.id')
                ->select(['nota_venta_producto.*' , 'clientes.nombre as cliente'])
                ->orderBy('id');


            return DataTables::of($nota_venta_producto)
                ->addColumn('actions', 'modulo_ventas.nota_venta_producto.partials.actions')
                ->rawColumns(['actions'])
                ->filter(function ($query) use ($request) {
                    if ($request->has('buscar') && !empty($request->get('buscar'))) {
                        $query->where('clientes.nombre', 'ilike', "%" . $request->get('buscar') . "%");
                    }
                    if (!empty($request->get('start_date')) && !empty($request->get('end_date'))) {
                        $end_date = Carbon::create($request->get('end_date'));
                        $query->where('fecha', '>=', $request->get('start_date'))->where('fecha', '<=', $end_date->addDay());
                    }
                })->toJson();
        }
        return view('modulo_ventas/nota_venta_producto/reportes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::where('estado', '=', true)->select('*')->get();
        $clientes =  Cliente::where('estado', '=', true)->select('*')->get();
        return view('modulo_ventas/nota_venta_producto/create', compact('productos', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente_id = $request->cliente_id;
        $producto_list = $request->producto_list;
        $total = $request->total;
        $fecha_hora = new DateTime();
        $fecha_hora->setTimezone(new DateTimeZone('America/La_Paz'));
        $DateAndTime = $fecha_hora->format("Y-m-d H:i:s");
        


        $nota_venta_producto =  new NotaVentaProducto();
        $nota_venta_producto->cliente_id = $cliente_id;
        $nota_venta_producto->fecha = $DateAndTime;
        $nota_venta_producto->total = $total;
        $nota_venta_producto->save();



        foreach ($producto_list as $producto) {
            $refill = Producto::find($producto['producto_id']);
            if ($producto['cantidad'] <= $refill->cantidad) {
                $detalle_producto = new DetalleNotaVentaProducto();
                $detalle_producto->cantidad = $producto['cantidad'];
                $detalle_producto->nota_venta_producto_id = $nota_venta_producto->id;
                $detalle_producto->producto_id = $producto['producto_id'];
                $detalle_producto->save();

                $refill->cantidad = $refill->cantidad - $producto['cantidad'];
                if ($refill->cantidad < 1) {
                    $refill->estado = false;
                }

                $refill->save();
            }
        }

        return $nota_venta_producto->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $nota_venta_producto = NotaVentaProducto::join('clientes', 'nota_venta_producto.cliente_id', 'clientes.id')
            ->where('nota_venta_producto.id', '=', $id)
            ->select('nota_venta_producto.*', 'clientes.*')->first();


        $detalles = DetalleNotaVentaProducto::join('producto', 'detalle_nota_venta_producto.producto_id', 'producto.id')
            ->where('detalle_nota_venta_producto.nota_venta_producto_id', '=', $id)
            ->select('detalle_nota_venta_producto.*', 'producto.nombre', 'producto.precio_venta')->get();


        $listaFacturaProducto = FacturaProducto::where('nota_venta_producto_id', '=', $id)->select('*')->get();

        $existeFactura = count($listaFacturaProducto) > 0 ? true : false;

        return view('modulo_ventas.nota_venta_producto.show', compact('nota_venta_producto', 'detalles', 'existeFactura'));
    }

    /**
     * Muestra las graficas de reportes
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function graficas()
    {
        return view('modulo_ventas.nota_venta_producto.graficas');
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

    public function exportHTML()
    {
        return (new VentasProductosExport)->download('reportede ventas.html', \Maatwebsite\Excel\Excel::HTML);
    }

    /**
     * Retorna un json con el monto total de las ventas de productos realizadas por mes.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function ventasMes(Request $request)
    {
        $end_month = today();
        $pivot_month = today()->subMonths($request->rango - 1);

        $query_ventas_mes = DB::table('nota_venta_producto')
            ->selectRaw("date_part('year',fecha) as año, date_part('month',fecha) as mes, sum(total) as total")
            ->whereDate('fecha', '>=', $pivot_month->setDay(01))
            ->groupBy(["año", "mes"])
            ->orderBy('año')
            ->orderBy("mes")
            ->get();

        //verificacion de los 12 meses y correcion si algun mes falta
        $ventas_mes = array();
        $c = 0;

        while ($pivot_month->format('m') != $end_month->format('m')) {
            if (array_key_exists($c, $query_ventas_mes->toArray()) && $query_ventas_mes[$c]->mes == $pivot_month->format('m')) {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query_ventas_mes[$c]->mes), "total" => $query_ventas_mes[$c]->total]);
            } else {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "total" => 0]);
                --$c;
            }
            ++$c;
            $pivot_month->addMonth(1);
        };

        if (array_key_exists($c, $query_ventas_mes->toArray()) && $query_ventas_mes[$c]->mes == $pivot_month->format('m')) {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query_ventas_mes[$c]->mes), "total" => $query_ventas_mes[$c]->total]);
        } else {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "total" => 0]);
            --$c;
        }
        return $ventas_mes;
    }

    public function montoPromedioVentaMes(Request $request)
    {
        $end_month = today();
        $pivot_month = today()->subMonths($request->rango - 1);

        $query_ventas_mes = DB::table('nota_venta_producto')
            ->selectRaw("date_part('year',fecha) as año, date_part('month',fecha) as mes, sum(total)/count(id) as monto_promedio")
            ->whereDate('fecha', '>=', $pivot_month->setDay(01))
            ->groupBy(["año", "mes"])
            ->orderBy('año')
            ->orderBy("mes")
            ->get();

        //verificacion de los 12 meses y correcion si algun mes falta
        $ventas_mes = array();
        $c = 0;

        while ($pivot_month->format('m') != $end_month->format('m')) {
            if (array_key_exists($c, $query_ventas_mes->toArray()) && $query_ventas_mes[$c]->mes == $pivot_month->format('m')) {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query_ventas_mes[$c]->mes), "monto_promedio" => $query_ventas_mes[$c]->monto_promedio]);
            } else {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "monto_promedio" => 0]);
                --$c;
            }
            ++$c;
            $pivot_month->addMonth(1);
        };

        if (array_key_exists($c, $query_ventas_mes->toArray()) && $query_ventas_mes[$c]->mes == $pivot_month->format('m')) {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query_ventas_mes[$c]->mes), "monto_promedio" => $query_ventas_mes[$c]->monto_promedio]);
        } else {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "monto_promedio" => 0]);
            --$c;
        }

        return $ventas_mes;
    }
}
