<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Activo;
use App\audit;
use App\MovimientoActivo;
use App\Personal;
use App\cargo;


class MovimientoActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Movimientos = DB::table('movimiento_activos')
            ->leftjoin('activos', 'movimiento_activos.FK_MovInv', '=', 'activos.ID_Act')
            ->join('sedes', 'sedes.ID_Sede', '=', 'activos.FK_ActSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->leftjoin('personals', 'movimiento_activos.FK_ActPerson', '=', 'personals.ID_Pers')
            ->select('movimiento_activos.*', 'activos.ActName', 'personals.PersFirstName', 'clientes.CliShortname')
            ->get();

        return view('movimientoActivo.index', compact('Movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Activos = Activo::all();

        $Personales = DB::table('personals')
        ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
        ->select('cargos.CargName',  'personals.PersFirstName', 'personals.ID_Pers')
        ->get();

        return view('movimientoActivo.create', compact('Personales', 'Activos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Movimientos = new MovimientoActivo();
        $Movimientos->MovTipo = $request->input("MovTipo");
        $Movimientos->FK_MovInv = $request->input("FK_MovInv");
        $Movimientos->FK_ActPerson = $request->input("FK_ActPerson");
        $Movimientos->save();

        return redirect()->route('movimiento-activos.index');
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
        $Movimientos = MovimientoActivo::where('ID_MovAct', $id)->first();

        if($Movimientos->FK_ActPerson !== NULL){
            $Personal = Personal::where('ID_Pers', $Movimientos->FK_ActPerson)->first();
            $Cargos = Cargo::where('ID_Carg', $Personal->FK_PersCargo)->first();
        }

        $Activo = Activo::where('ID_Act', $Movimientos->FK_MovInv)->first();

        $Activos = Activo::where('ID_Act', '<>', $Movimientos->FK_MovInv)->get();

        $Personales = DB::table('personals')
            ->leftjoin('movimiento_activos', 'movimiento_activos.FK_ActPerson', '=', 'personals.ID_Pers')
            ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
            ->select('Cargos.CargName',  'personals.PersFirstName', 'personals.ID_Pers')
            ->where('personals.ID_Pers', '<>', $Movimientos->FK_ActPerson)
            ->get();
       
        return view('movimientoActivo.edit', compact('Movimientos', 'Personales', 'Activos', 'Personal', 'Cargos', 'Activo'));
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
        $Movimientos = MovimientoActivo::where('ID_MovAct', $id)->first();
        $Movimientos->fill($request->all());
        $Movimientos->save();
        
        $log = new audit();
        $log->AuditTabla = "movimiento_activos";
        $log->AuditType = "Modificado";
        $log->AuditRegistro = $Movimientos->ID_MovAct;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $request->all();
        $log->save();

        return redirect()->route('movimiento-activos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Movimientos = MovimientoActivo::where('ID_MovAct', $id)->first();

        if ($Movimientos->MovActDelete == 0){
            $Movimientos->MovActDelete = 1;
        }
        else{
            $Movimientos->MovActDelete = 0;
        }
        $Movimientos->save();

        $log = new audit();
        $log->AuditTabla = "articulo_por_proveedors";
        $log->AuditType = "Eliminado";
        $log->AuditRegistro = $Movimientos->ID_MovAct;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $Movimientos->MovActDelete;
        $log->save();

        return redirect()->route('movimiento-activos.index');
    }
}
