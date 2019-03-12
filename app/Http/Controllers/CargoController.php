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
        if(Auth::user()->UsRol === "Programador"){
            $Cargos = DB::table('cargos')
                ->join('areas','cargos.CargArea', '=', 'areas.ID_Area')
                ->select('cargos.ID_Carg','cargos.CargDelete','cargos.CargName','cargos.CargSalary','cargos.CargGrade','areas.AreaName')
                ->get();
            return view('cargos.index', compact('Cargos'));
        }
        $Cargos = DB::table('cargos')
                ->join('areas','cargos.CargArea', '=', 'areas.ID_Area')
                ->select('cargos.ID_Carg','cargos.CargDelete','cargos.CargName','cargos.CargSalary','cargos.CargGrade','areas.AreaName')
                ->where('cargos.CargDelete', 0)
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
        $cargo->CargDelete = 0;
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
        $Cargos = DB::table('cargos')
            ->select('*')
            ->where('ID_Carg',$id)
            ->get();
        $Areas = DB::table('areas')
            ->select('ID_Area', 'AreaName')
            ->get();
        return view('cargos.edit', compact('Areas','Cargos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $Cargo = Cargo::where('ID_Carg', $id)->first();
        $Cargo->fill($request->all());
        $Cargo->CargArea = $request->input('SelectArea');
        $Cargo->save();

        $log = new audit();
        $log->AuditTabla="cargos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Cargo->ID_Carg;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('cargos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $Cargo = Cargo::where('ID_Carg', $id)->first();
            if ($Cargo->CargDelete == 0) {
                $Cargo->CargDelete = 1;
            }
            else{
                $Cargo->CargDelete = 0;
            }
        $Cargo->save();

        $log = new audit();
        $log->AuditTabla = "cargos";
        $log->AuditType = "Eliminado";
        $log->AuditRegistro = $Cargo->ID_Carg;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $Cargo->CargDelete;
        $log->save();

        return redirect()->route('cargos.index');
    }
}
