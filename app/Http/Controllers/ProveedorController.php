<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_proveedores = Proveedor::all();
        return view('modulo_compras/proveedor/index',['lista_proveedores'=>$lista_proveedores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modulo_compras/proveedor/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo = $request->correo;
        $proveedor->direccion = $request->direccion;
        $proveedor->nit = $request->nit;
        $proveedor->descripcion = $request->descripcion;
        $proveedor->estado = true;
        $proveedor->save();

       return redirect('/proveedor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('modulo_compras.proveedor.show',compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id); 
        return view('modulo_compras.proveedor.edit',compact('proveedor'));
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
        $lista = [

            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'direccion' => $request->direccion,
            'nit' => $request->nit,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado, 

        ];
        Proveedor::where('id','=',$id)->update($lista);
        return redirect('/proveedor')->with('status', 'Producto Actualizado Exitosamente!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Proveedor::destroy($id);
        return redirect('proveedor');
    }

    public function desactivar(int $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->estado = false;
        $proveedor->save();
        return redirect('/proveedor')->with('status', 'Proveedor Deshabilitado Exitosamente!');
    }

    public function activar(int $id)
    { 
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->estado = true;
        $proveedor->save();
        return redirect('/proveedor')->with('status', 'Proveedor Habilitado Exitosamente!');
    }
}
