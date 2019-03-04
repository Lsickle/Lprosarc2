<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\audit;
use App\Activo;
use App\SubcategoriaActivo;
use App\CategoriaActivo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Activos = DB::table('subcategoria_activos')
            ->rightJoin('Activos', 'Activos.FK_ActSub', '=', 'subcategoria_activos.ID_SubCat')
            ->leftJoin('categoria_activos', 'subcategoria_activos.FK_SubCat', '=', 'categoria_activos.ID_CatAct')
            ->select('subcategoria_activos.*', 'categoria_activos.*', 'Activos.*')
            ->get();

        return view('activos.index', compact('Activos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $SubActivos = DB::table('subcategoria_activos')
            ->select('subcategoria_activos.*')
            ->get();

        $Categorias = DB::table('categoria_activos')
            ->select('categoria_activos.*')
            ->get();

        return view('activos.create', compact('SubActivos', 'Categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Activo = new Activo();
        $Activo->FK_ActSub = $request->input('subcategoria');
        $Activo->ActName = $request->input('nombre');
        $Activo->ActUnid = $request->input('Forma');
        $Activo->ActCant = $request->input('cantidad');
        $Activo->ActSerialProsarc = $request->input('serialPro');
        $Activo->ActModel = $request->input('modelo');
        $Activo->ActTalla = $request->input('talla');
        $Activo->ActObserv = $request->input('observacion');
        $Activo->ActSerialProveed = $request->input('serialproveedor');
        $Activo->FK_ActSede = 1;
        $Activo->save();

        $log = new audit();
        $log->AuditTabla="activos";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Activo->ID_Act;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('activos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
