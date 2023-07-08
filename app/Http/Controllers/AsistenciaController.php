<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\Turno;
use App\Models\UserTurno;
use App\Models\UserBomba;
use App\Models\Bomba;
use Asistencias;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $turno_id = $request->turno_id;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
            $usuario = $request->usuario;
            $asistencias = DB::select('select * from listaAsistencia(?,?,?,?)', [$turno_id, $fecha_inicio, $fecha_fin, $usuario]);
            return DataTables::of($asistencias)->make(true);
        }
        $turnos_list = Turno::all();
        return view('modulo_administrativo/asistencia/index', ['turnos_list' => $turnos_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Turno $turno)
    {

        return view('modulo_administrativo.asistencia.create', compact('turno'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function entrada($turno_id, $user_id)
    {
        $intermedia_id = UserTurno::where('turno_id', '=', $turno_id)->where('user_id', "=", $user_id)->select('id')->first()->id;
        $asistencia = new Asistencia();
        $fecha_hora = new DateTime();
        $fecha_hora->setTimezone(new DateTimeZone('America/La_Paz'));
        $DateAndTime = $fecha_hora->format("Y-m-d H:i:s");
        $asistencia->fecha_entrada = $DateAndTime;
        $asistencia->user_turno_id = $intermedia_id;
        $asistencia->save();
        $turno = Turno::find($turno_id);
        return redirect()->route('asistencia.create', ['turno' => $turno]);
    }

    public function salida($turno_id, $user_id)
    {
        $intermedia_id = UserTurno::where('turno_id', '=', $turno_id)->where('user_id', "=", $user_id)->select('id')->first()->id;
        $fecha_hora = new DateTime();
        $fecha_hora->setTimezone(new DateTimeZone('America/La_Paz'));
        $DateAndTime = $fecha_hora->format("Y-m-d H:i:s");
        $asistencia = Asistencia::where('user_turno_id', '=', $intermedia_id)->select('*')->first();
        $asistencia->fecha_salida = $DateAndTime;
        $asistencia->save();
        $turno = Turno::find($turno_id);

        $bomba_id = UserBomba::where('user_id', '=', $user_id)->orderBy('fecha_asignacion', 'desc')->first()->bomba_id;
        $bomba = Bomba::find($bomba_id);
        $bomba->libre = true;
        $bomba->save();

        return redirect()->route('asistencia.create', ['turno' => $turno]);
    }

    public function getUserByTurno($turno_id)
    {
        $turno = Turno::find($turno_id);
        $users = $turno->users;
        return $users;
    }

}
