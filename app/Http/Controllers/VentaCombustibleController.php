<?php

namespace App\Http\Controllers;

use App\Models\Bomba;
use App\Models\VentaCombustible;
use Illuminate\Http\Request;
use App\Models\UserBomba;
use App\Models\ventas;

class VentaCombustibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $userbombas = UserBomba::where('user_id', $user->id)->get();
    }

    public function bombasList()
    {
        $user = auth()->user();
        $userbombas = UserBomba::select('bomba_id')-> where('user_id', $user->id)->get();

        $bombas = Bomba::whereIn('id',$userbombas)->get();
        return view('pages.ventas_combustible.bombas_list', compact('bombas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Bomba $bomba)
    {
        return view('pages.ventas_combustible.create', compact('bomba'));
    }

    public function vendido(Request $request, Bomba $bomba )
    {
        $venta= ventas::create([

        ]);
        return redirect()->route('venta.combustible.bombasList');
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
     * @param  \App\Models\VentaCombustible  $ventaCombustible
     * @return \Illuminate\Http\Response
     */
    public function show(VentaCombustible $ventaCombustible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VentaCombustible  $ventaCombustible
     * @return \Illuminate\Http\Response
     */
    public function edit(VentaCombustible $ventaCombustible)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaCombustible  $ventaCombustible
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaCombustible $ventaCombustible)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaCombustible  $ventaCombustible
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaCombustible $ventaCombustible)
    {
        //
    }
}
