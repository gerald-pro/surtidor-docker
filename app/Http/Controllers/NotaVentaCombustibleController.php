<?php

namespace App\Http\Controllers;

use App\Exports\VentasCombustiblesExport;
use App\Http\Traits\ReporteTrait;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\NotaVentaCombustible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bomba;
use App\Models\Tanque;
use App\Models\UserBomba;
use App\Models\Combustible;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use DateTimeZone;
use App\Models\FacturaCombustible;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NotaVentaCombustibleController extends Controller
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
            $nota_venta_combustible = DB::table('nota_venta_combustible')
                ->join('vehiculos', 'nota_venta_combustible.vehiculo_id', 'vehiculos.id')
                ->join('clientes', 'vehiculos.cliente_id', 'clientes.id')
                ->select(['nota_venta_combustible.*', 'clientes.nombre as cliente', 'vehiculos.placa',]);

            return DataTables::of($nota_venta_combustible)
                ->addColumn('actions', 'modulo_ventas.nota_venta_combustible.partials.actions')
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
        return view('modulo_ventas.nota_venta_combustible.reportes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user_bomba = UserBomba::where('user_id', '=', $user->id)->where('asignacion_vigente', '=', true)->first();

        if ($user_bomba == null) {
            return view('modulo_ventas/nota_venta_combustible/create', ['sin_bomba_asignada' => true]);
        } else {
            $bomba_id = $user_bomba->bomba_id;

            $bomba = Bomba::find($bomba_id);
            $tanque = Tanque::where('id', '=', $bomba->tanque_id)->first();
            $combustible = Combustible::find($tanque->combustible_id);
            $lista_vehiculos = Vehiculo::all();

            return view('modulo_ventas/nota_venta_combustible/create', ['lista_vehiculos' => $lista_vehiculos, 'bomba' => $bomba, 'tanque' => $tanque, 'combustible' => $combustible, 'sin_bomba_asignada' => false]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha_hora = new DateTime();
        $fecha_hora->setTimezone(new DateTimeZone('America/La_Paz'));
        $DateAndTime = $fecha_hora->format("Y-m-d H:i:s");
        $permitted_chars  =  '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $placa = $request->placa;
        $cliente_id = null;
        $vehiculo_id = Vehiculo::where('placa', strtoupper($placa))->get();

        if ($vehiculo_id->first()) {
            $vehiculo_id = $vehiculo_id[0]->id;
            $vehiculo = Vehiculo::find($vehiculo_id);
            $cliente_id = $vehiculo->cliente->id;
        } else {
            $vehiculo_id = null;
        }
        $user = Auth::user();
        $user_bomba_id = UserBomba::where('user_id', '=', $user->id)->orderBy('fecha_asignacion', 'desc')->first()->id;
        $user_bomba = UserBomba::find($user_bomba_id);
        $tanque = $user_bomba->bomba->tanque;

        $user_model = User::find($user->id);
        $turno = $user_model->join('users_turnos', 'users.id', 'users_turnos.user_id')
            ->join('turnos', 'turnos.id', 'users_turnos.turno_id')
            ->orderBy('users_turnos.id', 'desc')->select('turnos.*')->first();

        if ($tanque->cantidad_disponible - $request->cantidad_combustible > 0) {
            $nota_venta_combustible = new NotaVentaCombustible();
            $nota_venta_combustible->fecha =  $DateAndTime;
            $nota_venta_combustible->total = $request->total;
            $nota_venta_combustible->cantidad_combustible = $request->cantidad_combustible;
            $nota_venta_combustible->vehiculo_id = $vehiculo_id;
            $nota_venta_combustible->placa = $placa;
            $nota_venta_combustible->cliente_id = $cliente_id;
            $nota_venta_combustible->user_bombas_id = $user_bomba_id;
            $nota_venta_combustible->turno_id = $turno->id;
            $nota_venta_combustible->save();

            $tanque->cantidad_disponible = $tanque->cantidad_disponible - $request->cantidad_combustible;
            $tanque->save();

            if ($cliente_id && $nota_venta_combustible->total >= 100) {
                $cliente = Cliente::find($cliente_id);
                $cliente->puntos =  $cliente->puntos + 1;
                $cliente->save();
            }

            $factura = new FacturaCombustible();
            $factura->placa = $placa;
            $factura->nro_factura = random_int(1000, 999999999);
            $factura->fecha_emision = $DateAndTime;
            $factura->lugar_emision = "Santa Cruz de la Sierra";
            $factura->numero_autorizacion = random_int(10000, PHP_INT_MAX);
            $factura->total = $nota_venta_combustible->total;
            $factura->codigo_control = substr(str_shuffle($permitted_chars),  0,  16);
            $factura->nit = $request->nit;
            $factura->fecha_limite_emision = $this->fechaLimiteEmision($DateAndTime);
            $factura->nombre_razon_social = $request->cliente;
            $factura->nota_venta_combustible_id = $nota_venta_combustible->id;
            $factura->save();
            
            return $nota_venta_combustible->id;
            //return redirect()->route('nota_venta_combustible.show', $nota_venta_combustible);
        } else {
            $vehiculo = Vehiculo::find($vehiculo_id);
            return redirect()->route('nota_venta_combustible.create')->with(['vehiculo_id' => $vehiculo->id . '`' . $vehiculo->b_sisa])->withErrors(['errors' => 'cantidad de combustible insuficiente!']);
        }
    }

    public function fechaLimiteEmision($fechaEmision)
    {
        //sumo 5 meses
        return date("Y-m-d", strtotime($fechaEmision . "+ 5 month"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota_venta_combustible = NotaVentaCombustible::find($id);
        $combustible =  $nota_venta_combustible->userBombas->bomba->tanque->combustible;


        $listaFacturaCombustible = FacturaCombustible::where('nota_venta_combustible_id', '=', $id)->select('*')->get();

        $existeFactura = count($listaFacturaCombustible) > 0 ? true : false;

        return view('modulo_ventas.nota_venta_combustible.show', compact('nota_venta_combustible', 'combustible', 'existeFactura'));
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
        return (new VentasCombustiblesExport)->download('reporte de ventas de combustibles.html', \Maatwebsite\Excel\Excel::HTML);
    }

    /**
     * Muestra las graficas de reportes
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function graficas()
    {
        $meses = [];
        $periodo = CarbonPeriod::create(today()->subMonths(11)->setDay(1), '1 month', today());
        foreach ($periodo as $mes) {
            array_push($meses, ['fecha' => $mes, 'nombre' => $this->intToLiteralMonth($mes->format('m'))]);
        }
        return view('modulo_ventas.nota_venta_combustible.graficas', compact('meses'));
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
        $pivot_month = today()->subMonths($request->rango - 1)->setDay(01);

        $query = DB::table('nota_venta_combustible')
            ->selectRaw("date_part('year',fecha) as año, date_part('month',fecha) as mes, sum(total) as total")
            ->whereDate('fecha', '>=', $pivot_month)
            ->groupBy(["año", "mes"])
            ->orderBy('año')
            ->orderBy("mes")
            ->get();

        //verificacion de los 12 meses y correcion si algun mes falta
        $ventas_mes = array();
        $c = 0;

        while ($pivot_month->format('m') != $end_month->format('m')) {
            if (array_key_exists($c, $query->toArray()) && $query[$c]->mes == $pivot_month->format('m')) {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query[$c]->mes), "total" => $query[$c]->total]);
            } else {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "total" => 0]);
                --$c;
            }
            ++$c;
            $pivot_month->addMonth(1);
        };

        if (array_key_exists($c, $query->toArray()) && $query[$c]->mes == $pivot_month->format('m')) {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query[$c]->mes), "total" => $query[$c]->total]);
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

        $query = DB::table('nota_venta_combustible')
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
            if (array_key_exists($c, $query->toArray()) && $query[$c]->mes == $pivot_month->format('m')) {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query[$c]->mes), "monto_promedio" => $query[$c]->monto_promedio]);
            } else {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "monto_promedio" => 0]);
                --$c;
            }
            ++$c;
            $pivot_month->addMonth(1);
        };

        if (array_key_exists($c, $query->toArray()) && $query[$c]->mes == $pivot_month->format('m')) {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query[$c]->mes), "monto_promedio" => $query[$c]->monto_promedio]);
        } else {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "monto_promedio" => 0]);
            --$c;
        }

        return $ventas_mes;
    }

    public function litrosVendidosMes(Request $request)
    {
        $fecha_mes = new Carbon($request->mes);
        $query = DB::table('nota_venta_combustible as nvc')
            ->selectRaw("c.nombre as combustible, sum(cantidad_combustible) as litros")
            ->join('user_bombas as ub', 'ub.id', '=', 'nvc.user_bombas_id')
            ->join('bombas as b', 'b.id', '=', 'ub.bomba_id')
            ->join('tanques as t', 'b.tanque_id', '=', 't.id')
            ->join('combustibles as c', 't.combustible_id', '=', 'c.id')
            ->whereYear('fecha', '=', $fecha_mes->format('Y'))
            ->whereMonth('fecha', '=', $fecha_mes->format('m'))
            ->groupBy("c.id")
            ->get();

        return $query;
    }

    public function ventasPromedioDia(Request $request)
    {
        $start_month = today()->subMonths($request->rango - 1)->setDay(1);
        $query = DB::table('nota_venta_combustible as nvc')
            ->selectRaw("extract(dow from fecha) as dia, cast(count(nvc.id) as decimal(8,2))/ cast(count(distinct date_part('day',fecha)) as decimal(8,2)) as promedio")
            ->whereDate('fecha', '>=', $start_month)
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        $ventas_dia = array();
        $c = 0;
        $dia = 0;

        while ($dia <= 6) {
            if (array_key_exists($c, $query->toArray()) && $query[$c]->dia == $dia) {
                array_push($ventas_dia, ["dia" => $this->intToLiteralDay($dia), "promedio" => $query[$c]->promedio]);
            } else {
                array_push($ventas_dia, ["dia" => $this->intToLiteralDay($dia), "promedio" => 0]);
                --$c;
            }
            ++$c;
            ++$dia;
        };
        array_push($ventas_dia, $ventas_dia[0]);
        array_shift($ventas_dia);
        return $ventas_dia;
    }
}
