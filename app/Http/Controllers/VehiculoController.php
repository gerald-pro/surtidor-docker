<?php

namespace App\Http\Controllers;

use App\Exports\VehiculosExport;
use App\Models\Vehiculo;
use App\Http\Requests\StoreVehiculoRequest;
use App\Http\Requests\UpdateVehiculoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipos = ['automovil', 'camioneta', 'camion', 'minibus', 'bus', 'vagoneta'];
        if ($request->ajax()) {
            $vehiculos = DB::table('vehiculos')
                ->join('clientes', 'vehiculos.cliente_id', '=', 'clientes.id')
                ->select(['vehiculos.*', 'clientes.nombre as cliente']);

            return DataTables::of($vehiculos)
                ->addColumn('actions', 'partials.vehiculos.actions')
                ->rawColumns(['actions'])
                ->filter(function ($query) use ($request) {
                    if ($request->has('buscar') && !empty($request->get('buscar'))) {
                        $query->where('placa', 'ilike', "%" . $request->get('buscar') . "%")->orWhere('clientes.nombre', 'ilike', "%" . $request->get('buscar') . "%");
                    }
                    if ($request->has('tipo') && !empty($request->get('tipo'))) {
                        $query->where('tipo', $request->get('tipo'));
                    }
                })->toJson();
        }

        return view('pages.vehiculos.index', compact('tipos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.vehiculos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVehiculoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehiculoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        return view('pages.vehiculos.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculo $vehiculo)
    {
        return view('pages.vehiculos.edit', compact('vehiculo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehiculoRequest  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehiculoRequest $request, Vehiculo $vehiculo)
    {
        $request->merge(['placa' => strtoupper($request->placa)]);

        $vehiculo->update($request->all());
        return view('pages.vehiculos.show', compact('vehiculo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->back();
    }

    public function exportHTML() 
    {
        return (new VehiculosExport)->download('vehiculos.html', \Maatwebsite\Excel\Excel::HTML);
    }
}
