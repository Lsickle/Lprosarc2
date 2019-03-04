<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\audit;
use App\Cargo;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $Cargos = DB::table('cargos')
            ->join('areas','cargos.CargArea', '=', 'areas.ID_Area')
            ->select('cargos.CargName','cargos.CargSalary','cargos.CargGrade','areas.AreaName')
            ->get();
        return view('cargos.index', compact('Cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $Areas = DB::table('areas')
            ->select('ID_Area', 'AreaName')
            ->get();
        return view('cargos.create', compact('Areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $cargo = new Cargo();
        $cargo->CargName = $request->input('NomCarg');
        $cargo->CargSalary= $request->input('CargSalary');
        $cargo->CargGrade = $request->input('CargGrade');
        $cargo->CargArea = $request->input('SelectArea');
        $cargo->save();

        $log = new audit();
        $log->AuditTabla="cargos";
        $log->AuditType="Creado";
        $log->AuditRegistro=$cargo->ID_Carg;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('cargos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
}
