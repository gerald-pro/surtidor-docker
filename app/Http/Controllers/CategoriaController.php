<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Exports\CategoriasExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Categoria;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $categorias = Categoria::orderby('codigo', 'desc')->get();
        
        return view('pages.categorias.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias= new Categoria();
       //$categorias=Categoria::pluck('codigo','id'); //se aumento para ver los datos de tanque
        
       return view('pages.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriaRequest $request)
    {
        $Categoria = Categoria::create($request->all());
        return redirect()->route('categorias.show', $Categoria);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return view('pages.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('pages.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->all());
        return redirect()->route('categorias.show', $categoria);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index');
    }

    public function exportCategoria(Request $request){

        return Excel::download(new CategoriasExport, 'categorias.xlsx');
    }

    public function categoriahtml(Request $request){

      
      return (new CategoriasExport)->download('categorias-html', \Maatwebsite\Excel\Excel::HTML);

    }

    public function downloadPDF(Categoria $categoria){

       $categorias = Categoria::all();
       
        view()->share('pages.categorias.download', $categorias);
        
       $pdf = Pdf::loadView('pages.categorias.download', ['categorias' => $categorias])
        ->setPaper('letter', 'portrait');

        return $pdf->stream('Lista de Categorias' . '.pdf', ['Attachment' => 'true']);

    }
}
