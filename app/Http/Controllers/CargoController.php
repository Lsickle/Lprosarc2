<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
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
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            $Cargos = DB::table('cargos')
                ->join('areas','cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('cargos.CargSlug','cargos.CargDelete','cargos.CargName','cargos.CargSalary','cargos.CargGrade','areas.AreaName','clientes.ID_Cli', 'clientes.CliShortname')
                ->where(function($query){
                    $id = userController::IDClienteSegunUsuario();
                        /*Validacion del cliente que pueda ver solo los cargos que tiene a cargo solo los que no esten eliminados*/
                        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
                            $query->where('clientes.ID_Cli', '=', $id);
                            $query->where('cargos.CargDelete', '=', 0);
                        }
                        /*Validacion del personal de Prosarc autorizado para loscargos del cliente solo los que no esten eliminados*/
                        else if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
                            $query->where('clientes.ID_Cli', '<>', $id);
                            $query->where('cargos.CargDelete', '=', 0);
                        }
                        /*Validacion del Programador para ver todas los cargos del cliente aun asi este eliminado*/
                        else{
                            $query->where('clientes.ID_Cli', '<>', $id);
                        }
                    }
                )
                ->get();
            return view('cargos.index', compact('Cargos'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            $Areas = DB::table('areas')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('areas.ID_Area', 'areas.AreaName')
                ->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
                ->where('areas.AreaDelete', 0)
                ->get();
            return view('cargos.create', compact('Areas'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validate = $request->validate([
            'CargName'       => 'required|min:4|max:128',
            'CargArea'       => 'required',
        ]);
        $cargo = new Cargo();
        $cargo->CargName = $request->input('CargName');
        $cargo->CargArea = $request->input('CargArea');
        $cargo->CargDelete = 0;
        $cargo->CargSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $cargo->save();

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
        $Cargos = Cargo::where('CargSlug', $id)->first();
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') && $Cargos <> null){
            $Areas = DB::table('areas')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('areas.ID_Area', 'areas.AreaName')
                ->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
                ->where('areas.AreaDelete', 0)
                ->get();
            return view('cargos.edit', compact('Areas','Cargos'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $validate = $request->validate([
            'CargName'       => 'required|min:4|max:128',
            'CargArea'       => 'required',
        ]);
        $Cargo = Cargo::where('CargSlug', $id)->first();
        $Cargo->fill($request->all());
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
        $Cargo = Cargo::where('CargSlug', $id)->first();
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
