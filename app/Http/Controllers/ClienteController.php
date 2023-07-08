<?php

namespace App\Http\Controllers;

use App\Http\Requests\CanjearRequest;
use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\StoreVehiculoRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Premio;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ClienteController extends Controller
{
    public $search = 'gerald';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        $cliente = Cliente::create($request->all());
        return redirect()->route('clientes.show', $cliente);
    }

    /**
     * Registra un nuevo automovil para el cliente.
     *
     * @param  \App\Http\Requests\StoreVehiculoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeVehiculo(StoreVehiculoRequest $request, Cliente $cliente)
    {
        Vehiculo::create(
            [
                'cliente_id' => $cliente->id,
                'placa' => strtoupper($request->placa),
                'tipo' => $request->tipo,
                'marca' => $request->marca,
                'b_sisa' => $request->b_sisa,
            ]
        );
        return redirect()->route('clientes.show', $cliente);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $vehiculos = Vehiculo::where('cliente_id', '=', $cliente->id)
            ->select('vehiculos.*')
            ->paginate(9);
        return view('pages.clientes.show', compact('cliente', 'vehiculos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('pages.clientes.edit', compact('cliente'));
    }

    /**
     * Muestra el formulario para canjear los puntos acumulados del cliente por premios.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function canjeo(Cliente $cliente)
    {
        $premios = Premio::all();
        return view('pages.clientes.canjear', compact('cliente', 'premios'));
    }

    /**
     * Almacena el nuevo registro de la tabla cliente_premio.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function canjear(Cliente $cliente, CanjearRequest $request)
    {
        $premio = Premio::find($request->premio_id);

        $validator = Validator::make($request->all(), [
            'premio_id' => 'required',
        ], $messages = [
            'premio_id.required' => 'Seleccione el premio para canjear',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $total_puntos_req = $premio->puntos_requeridos * $request->cantidad;

        if ($request->cantidad <= $premio->stock) {
            if ($total_puntos_req <= $cliente->puntos) {
                $cliente->premios()->attach($request->premio_id, ['cantidad' => $request->cantidad, 'puntos_canjeados' => $total_puntos_req]);
                $sobrante = $cliente->puntos - $total_puntos_req;

                $cliente->update(['puntos' => $sobrante]);
                return redirect()->route('clientes.show', compact('cliente'));
            } else {
                $errors = new MessageBag();
                $errors->add('premio_id', 'Puntos insuficientes!');
                return redirect()->back()->withErrors($errors);
            }
        }
    }

    /**
     * Almacena el nuevo registro de la tabla cliente_premio.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroyPremio(Cliente $cliente, $cliente_premio_id)
    {
        $cliente->premios()->wherePivot('id', '=', $cliente_premio_id)->detach();
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->all());
        return redirect()->route('clientes.show', [$cliente]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index');
    }

    public function findByVehiculo(Request $request) 
    {
        $vehiculo = Vehiculo::where('placa', strtoupper($request->placa))->get();
        
        if ($vehiculo->first()) {
            return Cliente::find($vehiculo[0]->cliente_id);
        }else{
            return [];
        }
       
    }
}
