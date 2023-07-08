<?php

namespace App\Http\Controllers;

use App\Http\Traits\ReporteTrait;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    use ReporteTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $users_activos = collect();
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                $users_activos->push($user);
            }
        }
        return view('admin/index', compact('users_activos'));
    }

    /**
     * Retorna una lista con todos los usuarios activos.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaActivos()
    {
        $lista_activos = collect();
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                $lista_activos->push($user);
            }
        }
        return $lista_activos;
    }
}
