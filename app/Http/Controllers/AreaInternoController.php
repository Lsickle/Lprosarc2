<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\userController;
use App\Area;
use App\audit;
use Illuminate\Support\Facades\Auth;

class AreaInternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
            $Areas = DB::table('areas')
            ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
            ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->select('areas.ID_Area', 'areas.AreaName','areas.AreaDelete','sedes.SedeName','clientes.CliShortname','clientes.ID_Cli')
            ->where(function($query){
                $id = userController::IDClienteSegunUsuario();
                /*Validacion del personal de Prosarc autorizado para las areas solo los que no esten eliminados*/
                if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
                    $query->where('clientes.ID_Cli', '=', $id);
                    $query->where('areas.AreaDelete', '=', 0);
                }
                /*Validacion del Programador para ver todas las areas aun asi este eliminado*/
                else{
                    $query->where('clientes.ID_Cli', '=', $id);
                }
            })
            ->get();
            return view('areas.areasInterno.index', compact('Areas'));
        }
        else{
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
            $Sedes = DB::table('sedes')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('ID_Sede', 'SedeName')
                ->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
                ->get();
            return view('areas.areasInterno.create', compact('Sedes'));
        }
        else{
            return back();
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
            'AreaName'       => 'required|min:8',
            'FK_AreaSede'    => 'required',
        ]);
        $area = new Area();
        $area->AreaName = $request->input('AreaName');
        $area->FK_AreaSede= $request->input('FK_AreaSede');
        $area->AreaDelete = 0;
        $area->save();

        return redirect()->route('areasInterno.index');
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
    public function edit($id){
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
            $Areas = Area::where('ID_Area', $id)->first();
            $Sedes = DB::table('sedes')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('ID_Sede', 'SedeName')
                ->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
                ->get();
            return view('areas.areasInterno.edit', compact('Sedes', 'Areas'));
        }
        else{
            return back();
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
        $Area = Area::where('ID_Area', $id)->first();
        $Area->AreaName = $request->input('NomArea');
        $Area->FK_AreaSede = $request->input('AreaSede');
        $Area->save();

        $log = new audit();
        $log->AuditTabla="areas";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Area->ID_Area;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('areasInterno.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $Area = Area::where('ID_Area', $id)->first();
            if ($Area->AreaDelete == 0) {
                $Area->AreaDelete = 1;
            }
            else{
                $Area->AreaDelete = 0;
            }
        $Area->save();

        $log = new audit();
        $log->AuditTabla = "areas";
        $log->AuditType = "Eliminado";
        $log->AuditRegistro = $Area->ID_Area;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $Area->AreaDelete;
        $log->save();

        return redirect()->route('areasInterno.index');
    }
}
