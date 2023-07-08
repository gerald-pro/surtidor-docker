<?php

namespace App\Exports;

use App\Models\Bomba;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class BombasExport implements FromView, ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view():View
    {
        
        return view('pages.bombas.export', [
            'bombas'=>Bomba::all()
        ]);
      
    }
}
