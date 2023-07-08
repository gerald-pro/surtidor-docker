<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ProductoController extends Controller
{
    public $imageDefault = 'https://png.pngtree.com/png-vector/20190927/ourlarge/pngtree-cancel-cart-product-icon-png-image_1736147.jpg';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        function existImg($img): bool
        {
            if (app('firebase.storage')->getBucket()->object($img)->exists()) {
                return true;
            }
            return false;
        }
        if ($request->ajax()) {

            $productos = Producto::all();

            return DataTables::of($productos)->editColumn('imagen', function (Producto $producto) {

                if ($producto->imagen) {
                    $imageReference = app('firebase.storage')->getBucket()->object($producto->imagen);
                    if ($imageReference->exists()) {
                        $expiresAt = Carbon::now()->addSeconds(5);
                        $urlImage =  $imageReference->signedUrl($expiresAt);
                    }
                    return $urlImage;
                }
                return null;
            })->make(true);
        }
        return view('modulo_inventario/producto/index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modulo_inventario/producto/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = Producto::create($request->except('imagen'));

        if ($request->hasfile('imagen')) {
            $image = $request->file('imagen');
            $firebase_storage_path = 'Productos/';
            $localfolder = public_path('firebase-temp-uploads') . '/';
            $extension = $image->getClientOriginalExtension();
            $file      = $producto->id . '.' . $extension;
            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);

                $producto->update(['imagen' => $firebase_storage_path . $file]);
                unlink($localfolder . $file);
            }
        }
        return redirect('/producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        $image = $this->imageDefault;

        if ($producto->imagen) {
            $expiresAt = Carbon::now()->addSeconds(10);
            $imageReference = app('firebase.storage')->getBucket()->object($producto->imagen);
            if ($imageReference->exists()) {
                $image = $imageReference->signedUrl($expiresAt);
            }
        }
        return view('modulo_inventario.producto.show', compact('producto', 'image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('modulo_inventario.producto.edit', compact('producto'));
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
        $producto = Producto::find($id);
        if ($request->hasfile('imagen')) {

            if ($producto->imagen) {
                if (app('firebase.storage')->getBucket()->object($producto->imagen)->exists()) {
                    app('firebase.storage')->getBucket()->object($producto->imagen)->delete();
                }
                $producto->update(['imagen' => null]);
            }
            $image = $request->file('imagen');
            $firebase_storage_path = 'Productos/';
            $extension = $image->getClientOriginalExtension();
            $file = $producto->id . '.' . $extension;
            $localfolder = public_path('firebase-temp-uploads') . '/';

            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                $producto->update((['imagen' => $firebase_storage_path . $file]));
                unlink($localfolder . $file);
            }
        }

        $producto->update($request->except(['imagen']));
        return redirect('/producto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        if ($producto->imagen) {
            app('firebase.storage')->getBucket()->object($producto->imagen)->delete();
        }
        Producto::destroy($id);
        return redirect('producto');
    }
}
