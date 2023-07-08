<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Tanque;
use App\Http\Requests\StoreTanqueRequest;
use App\Http\Requests\UpdateTanqueRequest;
use App\Models\Combustible;
use App\Services\TanqueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TanqueController extends Controller
{

    protected $tanqueService;

    public function __construct(TanqueService $tanqueService)
    {
       $this->tanqueService = $tanqueService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tanques.index', $this->tanqueService->list());
    }

    /***********API-Controller********************************/
    public function indexApi()
    {
        $sql = 'select tanques.id, tanques.codigo, tanques.descripcion, tanques.capacidad,
        tanques.cantidad_disponible, tanques.cantidad_min, tanques.estado,
        tanques.fecha_carga, combustibles.nombre
        from tanques, combustibles
        where tanques.combustible_id = combustibles.id
        order by tanques.id';

        $tanques = DB::select($sql);

        return response($tanques, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $combustibles = Combustible::all();
        return view('pages.tanques.create', compact('combustibles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTanqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTanqueRequest $request)
    {
        $Tanque = Tanque::create($request->all());
        return redirect()->route('tanques.show', $Tanque);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function show(Tanque $tanque)
    {
        return view('pages.tanques.show', compact('tanque'));
    }

    /**
     * Recarga el tanque dada una cantidad espcificada.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recargar(Request $request, Tanque $tanque)
    {
        $aux = $tanque->capacidad - $tanque->cantidad_disponible;
        $validator = Validator::make($request->all(), [
            'cantidad_recarga' => 'required | lte:' . $aux,
        ], $messages = [
            'lte' => 'Se excedió la capacidad del tanque. La cantidad a recargar debe ser menor o igual a ' . $aux . ' lts',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tanques.show', $tanque)
                ->withErrors($validator)
                ->withInput();
        }

        $this->tanqueService->recargar($request->cantidad_recarga, $tanque);

        return redirect()->route('tanques.show', compact('tanque'))->with('mensaje', 'Se cargaron ' . $request->cantidad_recarga . ' litros al tanque');
    }

    /**
     * Llena el tanque a su capacidad maxima
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function llenar(Tanque $tanque)
    {
        $this->tanqueService->llenar($tanque);
        return redirect()->route('tanques.show', $tanque)->with('mensaje', 'Tanque cargado al máximo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function edit(Tanque $tanque)
    {
        $combustibles = Combustible::all();
        return view('pages.tanques.edit', compact('tanque', 'combustibles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTanqueRequest  $request
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTanqueRequest $request, Tanque $tanque)
    {
        $tanque->update($request->all());
        return redirect()->route('tanques.show', $tanque);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanque $tanque)
    {
        $tanque->delete();
        return redirect()->route('tanques.index');
    }
}
