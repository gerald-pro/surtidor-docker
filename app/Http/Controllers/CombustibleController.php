<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCombustibleRequest;
use App\Http\Requests\UpdateCombustibleRequest;
use App\Models\Combustible;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CombustibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

/*     public function byTanque()
    {
        return Combustible::where('tanque_id', $id)->get();
    } */
    public function index()

    {
        $combustibles = Combustible::orderby('nombre', 'desc')->get();
        return view('pages.combustibles.index', compact('combustibles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $combustibles = new Combustible();

        $categorias = Categoria::pluck('codigo', 'id');

        return view('pages.combustibles.create', compact('combustibles', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Http\Requests\StoreCombustibleRequest  $request

     * @return \Illuminate\Http\Response
     */
    public function store(StoreCombustibleRequest $request)
    {
        $Combustible = Combustible::create($request->all());
        return redirect()->route('combustibles.show', $Combustible);
    }

    /**
     * Display the specified resource.
     *

     * @param  int  $id

     * @param  \App\Models\Combustible  $combustible

     * @return \Illuminate\Http\Response
     */
    public function show(Combustible $combustible)
    {
        return view('pages.combustibles.show', compact('combustible'));
    }

    /**
     * Show the form for editing the specified resource.
     *

     * @param  int  $id

     * @param  \App\Models\Combustible  $combustible

     * @return \Illuminate\Http\Response
     */
    public function edit(Combustible $combustible)
    {
        return view('pages.combustibles.edit', compact('combustible'));
    }

    /**
     * Update the specified resource in storage.
     *

     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  \App\Http\Requests\UpdateCombustibleRequest  $request
     * @param  \App\Models\Combustible  $combustible
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCombustibleRequest $request, Combustible $combustible)
    {

        $combustible->update($request->all());
        return redirect()->route('combustibles.show', $combustible);
    }

    /**
     * Remove the specified resource from storage.
     *

     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Combustible $combustible)
    {
        $combustible->delete();
        return redirect()->route('combustibles.index');
    }

    public function nivelesCombustible()
    {
        $niveles_combustible = DB::table('tanques')
            ->join('combustibles', 'tanques.combustible_id', '=', 'combustibles.id')
            ->select('tipo', DB::raw('SUM(cantidad_disponible) as cantidad_disponible'))->groupBy('tipo')->get();
        return $niveles_combustible;
    }
}
