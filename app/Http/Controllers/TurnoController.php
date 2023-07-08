<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTurnoUserRequest;
use Illuminate\Http\Request;
use App\Models\Turno;
use App\Models\User;
use App\Models\UserTurno;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_turnos = Turno::all();
        return view('modulo_administrativo/turno/index',['lista_turnos'=>$lista_turnos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modulo_administrativo.turno.create' );
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUser(Turno $turno)
    {
        $user_list = User::all(); 
        return view('modulo_administrativo.turno.add_user', compact('user_list','turno'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $turno = new Turno();
        $turno->hora_entrada = $request->hora_entrada;
        $turno->hora_salida = $request->hora_salida;
        $turno->descripcion = $request->descripcion;
        $turno->save();

       return redirect('/turno');
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(StoreTurnoUserRequest $request, Turno $turno)
    {
        if (UserTurno::where([['turno_id','=',$turno->id], ['user_id','=',$request->user_id]])->exists()) {
            return redirect()->route('turno.addUser', $turno);
        }else{
            $turno->users()->attach(['user_id' => $request->user_id]);
            return redirect()->route('turno.addUser', $turno);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Turno $turno)
    {
        return view('modulo_administrativo.turno.show',compact('turno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $turno = Turno::findOrFail($id); 
        return view('modulo_administrativo.turno.edit',compact('turno'));
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
       $turno = Turno::find($id);
       $turno->descripcion = $request->descripcion;
       $turno->hora_entrada = $request->hora_entrada;
       $turno->hora_salida = $request->hora_salida;
       $turno->save();
       return redirect('turno');
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
    public function destroyUser(Turno $turno,int $user_id)
    {
        $turno->users()->detach($user_id);
        $user_list = User::all(); 
        return view('modulo_administrativo.turno.add_user', compact('turno','user_list'));
    }
}
