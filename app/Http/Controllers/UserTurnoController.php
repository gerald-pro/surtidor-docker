<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Turno;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserTurno;
use UsersTurnos;

class UserTurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $turno = Turno::find($id);
        $user_list_turno = $turno->users()->get();
        return view('modulo_administrativo/empleado_turno/index', [ 
            'id_turno' => $id, 'listaEmpleados' => $user_list_turno
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $id)
    {
        $user_list = User::all(); 

        $turno = Turno::find($id);
        return $user_list = $turno->users()->get();
        return view('modulo_administrativo/empleado_turno/create', [
            'user_list' => $user_list,
            'id_turno' => $id,
            'listaEmpleados' => $user_list
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,int $id)
    {
        $user_turno = new UserTurno();
        $user_turno->id_user = $request->id_user;
        $user_turno->id_turno = $id ;
        $user_turno->save();

       return redirect('/user_turno/create/' . $id);
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
    public function destroy(int $id_turno, int $user_turno_id)
    {
        $user_turno = UserTurno::find($user_turno_id);
        $user = User::find($user_turno->user_id);
        $user->turnos()->wherePivot('id', '=', $user_turno_id)->detach();
        return redirect('/user_turno/create/' . $id_turno);
    }
}
