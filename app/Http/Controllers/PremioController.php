<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use App\Http\Requests\StorePremioRequest;
use App\Http\Requests\UpdatePremioRequest;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PremioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->updateEstados();
        $productos = Producto::get();
        $premios = Premio::orderby('id', 'asc')->paginate(9);
        return view('pages.premios.index', compact('premios', 'productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::get();
        return view('pages.premios.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePremioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePremioRequest $request)
    {
        
        if (is_null($request->producto_id)) {
            $request->merge(['unidades_producto' => null]);
        }

        $premio = Premio::create($request->all());
        return redirect()->route('premios.show', $premio);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Premio  $premio
     * @return \Illuminate\Http\Response
     */
    public function show(Premio $premio)
    {
        $productos = Producto::get();
        return view('pages.premios.show', compact('premio', 'productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premio  $premio
     * @return \Illuminate\Http\Response
     */
    public function edit(Premio $premio)
    {
        $productos = Producto::get();
        return view('pages.premios.edit', compact('premio', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePremioRequest  $request
     * @param  \App\Models\Premio  $premio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePremioRequest $request, Premio $premio)
    {
        $premio->update($request->all());
        return redirect()->route('premios.show', compact('premio'));
    }

    /**
     * Actualiza el campo estado de la tabla premio de acuerdo al stock y la fecha fin  
     *
     * @param  \App\Http\Requests\UpdatePremioRequest  $request
     * @param  \App\Models\Premio  $premio
     * @return \Illuminate\Http\Response
     */
    public function updateEstados()
    {
        DB::table('premios')
            ->whereNotNull('fecha_fin')
            ->where([
                ['estado', '!=', 0],
                ['fecha_fin', '<=', Carbon::now()]
            ])
            ->update(['estado' => 0]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premio  $premio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Premio $premio)
    {
        $premio->delete();
        return redirect()->route('premios.index');
    }
}
