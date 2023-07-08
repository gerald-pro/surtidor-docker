<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupsController extends Controller
{

    private $disk = "publicApp";
    public function index(Request $request)
    {

         $archivos=[];
        foreach (Storage::disk($this->disk)->files() as $file){
            $name =  str_replace("$this->disk/","",$file);
            $sinExe = str_replace(".zip","",$name);
            $names= ".".Storage::url($file);
            $archivos [] = [
                "name" => $names,
                "fecha" => $sinExe,
                "size" => Storage::disk($this->disk)->size($name)
            ];
        }
          $archivos;
        return view('pages.backups.index', ["archivos"=>$archivos])
            ->with('i');
    }

    public function create(Request $request) {
        Artisan::call('backup:run --only-db');
        return redirect('backups');
    }


}
