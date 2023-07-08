<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Providers\LaravelBackupPanelServiceProvider;
use Encore\Admin\Grid\Filter\Where;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class AuditController
 * @package App\Http\Controllers
 */
class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $sql = 'select  bitacoras.id ,user_id, users."name", event, bitacoras.created_at, auditable_type, url, ip_address from bitacoras, users
         where bitacoras.user_id = users.id order by bitacoras.id desc';

        $audits = DB::select($sql);
        return view('pages.bitacora.index', compact('audits'))
            ->with('i');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $audit = Bitacora::find($id);

        return view('pages.bitacora.show', compact('audit'));
    }



    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $audit = Bitacora::find($id)->delete();

        return redirect()->route('audits.index')
            ->with('success', 'Audit deleted successfully');
    }
}
