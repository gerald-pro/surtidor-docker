<?php

namespace App\Http\Controllers;
use App\Exports\BombasExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreBombaRequest;
use App\Http\Requests\UpdateBombaRequest;
use App\Models\Bomba;
use App\Models\UserBomba;
use App\Models\Tanque;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class BombaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //return true;
         $bombas = Bomba::orderby('codigo', 'desc')->paginate(3);
        //return view('pages.bombas.index', compact('bombas'));
        //$bombas=Bomba::all();
        return view('pages.bombas.index',compact('bombas'));
    }

    public function indexApi()
    {
        $tanques = Bomba::orderby('id', 'asc')->get();
        return response($tanques, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $bombas= new Bomba();
        //$tanques = Tanque::pluck('codigo','id'); //se aumento para ver los datos de tanque
        $tanques = Tanque::all();
        return view('pages.bombas.create',compact('bombas','tanques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBombaRequest $request)
    {
        //$this->validate(request(),['codigo'=>'required','nombre'=>'required','decripcion'=>'required']);
        //$bomb = bomba::create(request(['codigo','nombre','descripcion']));
        //$product->save();
       /* $request->validate([
            'codigo'=>'required|unique:bombas',
            'nombre'=>'required',
            'descripcion'=>'required'
            
        ]);*/
        
        $Bomba = Bomba::create($request->all());
        
       return redirect()->route('bombas.show', $Bomba);
/*         $bomba = Bomba::create($request->all);
        return redirect()->route('pages.bombas.index');  */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bomba $bomba)
    {
        return view('pages.bombas.show', compact('bomba'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bomba $bomba)
    {   
        return view('pages.bombas.edit', compact('bomba'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBombaRequest $request, Bomba $bomba)
    {
        $bomba->update($request->all());
        return redirect()->route('bombas.show', $bomba);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bomba $bomba)
    {
        $bomba->delete();
        return redirect()->route('bombas.index');
    }

    public function exportBomba(Request $request){

        return Excel::download(new BombasExport, 'bombas.xlsx');
    }

    public function bombaHtml(Request $request){

      
        return (new BombasExport)->download('bombas-html', \Maatwebsite\Excel\Excel::HTML);
  
      }

    public function downloadPDF(Request $request){

       // return (new BombasExport)->download('bombas.pdf',Excel::DOMPDF);
       
       $bombas = Bomba::all();
       
        view()->share('pages.bombas.download', $bombas);
        
       $pdf = Pdf::loadView('pages.bombas.download', ['bombas' => $bombas])
        ->setPaper('letter', 'portrait');

        return $pdf->stream('Lista de Bombas' . '.pdf', ['Attachment' => 'true']);

    }

    public function liberarBomba( Request $request, $id ){
        
        $bomba = Bomba::find($id);
        $bomba->libre = true;
        $bomba_liberada = $bomba->save();

        if($bomba_liberada){
          $user_bomba = UserBomba::where('bomba_id','=',$id)->orderBy('fecha_asignacion','desc')->first();
          $user_bomba->asignacion_vigente = false;
          $user_bomba->save();
        }
        return redirect()->route('bombas.index');
    }

}
