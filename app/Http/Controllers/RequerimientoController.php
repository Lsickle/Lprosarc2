<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;   
use App\Requerimiento;
use App\Respel;
use App\audit;
use App\Tratamiento;
use App\Tarifa;

class RequerimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $Requerimientos = DB::table('requerimientos')
            // ->rightjoin('tarifas', 'tarifas.ID_Tarifa', '=', 'requerimientos.FK_ReqTarifa')
            // ->join('tratamientos', 'tratamientos.ID_Trat', '=', 'requerimientos.FK_ReqTrata')
            ->join('respels', 'respels.ID_Respel', '=', 'requerimientos.FK_ReqRespel')
            ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
            ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            // ->select('requerimientos.*', 'clientes.CliName', 'respels.RespelName', 'tratamientos.TratName', 'tarifas.ID_Tarifa')
            ->select('requerimientos.*', 'clientes.CliName', 'respels.RespelName')
            ->get();

        return view('requerimientos.index', compact('Requerimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // En el controlador de respel
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // En el controlador de respel
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Requerimientos = Requerimiento::where('ReqSlug', $id)->first();

        return view('requerimientos.show', compact('Requerimientos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Requerimientos = Requerimiento::where('ReqSlug', $id)->first();

        $Tratamiento = Tratamiento::select('TratName')->where('ID_Trat', $Requerimientos->FK_ReqTrata)->first();
        $Tratamientos = Tratamiento::select('ID_Trat', 'TratName')->where('ID_Trat', '<>', $Requerimientos->FK_ReqTrata)->get();

        $Tarifa = Tarifa::where('ID_Tarifa', $Requerimientos->FK_ReqTarifa)->first();
        $Tarifas = Tarifa::where('ID_Tarifa', '<>', $Requerimientos->FK_ReqTarifa)->get();

        return view('requerimientos.edit', compact('Requerimientos', 'Tratamientos', 'Tratamiento', 'Tarifas', 'Tarifa'));  
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
        $Requerimiento = Requerimiento::where('ReqSlug', $id)->first();
        $Requerimiento->ReqFotoCargue = $request->input('ReqFotoCargue');
        $Requerimiento->ReqFotoDescargue = $request->input('ReqFotoDescargue');
        $Requerimiento->ReqFotoPesaje = $request->input('ReqFotoPesaje');
        $Requerimiento->ReqFotoReempacado = $request->input('ReqFotoReempacado');
        $Requerimiento->ReqFotoMezclado = $request->input('ReqFotoMezclado');
        $Requerimiento->ReqFotoDestruccion = $request->input('ReqFotoDestruccion');

        $Requerimiento->ReqVideoCargue = $request->input('ReqVideoCargue');
        $Requerimiento->ReqVideoDescargue = $request->input('ReqVideoDescargue');
        $Requerimiento->ReqVideoPesaje = $request->input('ReqVideoPesaje');
        $Requerimiento->ReqVideoReempacado = $request->input('ReqVideoReempacado');
        $Requerimiento->ReqVideoMezclado = $request->input('ReqVideoMezclado');
        $Requerimiento->ReqVideoDestruccion = $request->input('ReqVideoDestruccion');

        $Requerimiento->ReqAuditoria = $request->input('ReqAuditoria');
        $Requerimiento->ReqAuditoriaTipo = $request->input('ReqAuditoriaTipo');
        $Requerimiento->ReqDevolucion = $request->input('ReqDevolucion');
        $Requerimiento->ReqDevolucionTipo = $request->input('ReqDevolucionTipo');
        // $Requerimiento->ReqDevolucionCant = $request->input('ReqDevolucionCant');
        $Requerimiento->ReqDatosPersonal = $request->input('ReqDatosPersonal');
        $Requerimiento->ReqPlanillas = $request->input('ReqPlanillas');
        $Requerimiento->ReqAlistamiento = $request->input('ReqAlistamiento');
        $Requerimiento->ReqCapacitacion = $request->input('ReqCapacitacion');
        $Requerimiento->ReqBascula = $request->input('ReqBascula');
        $Requerimiento->ReqMasPerson = $request->input('ReqMasPerson');
        $Requerimiento->ReqPlatform = $request->input('ReqPlatform');
        $Requerimiento->ReqCertiEspecial = $request->input('ReqCertiEspecial');
        
        $Requerimiento->FK_ReqTrata = $request->input('FK_ReqTrata');
        $Requerimiento->FK_ReqTarifa = $request->input('FK_ReqTarifa');
        $Requerimiento->save();

        $log = new audit();
        $log->AuditTabla="requerimientos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Requerimiento->ID_Req;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        // return redirect()->route('respels.index');
        return redirect()->route('requerimientos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $log = new audit();
        $log->AuditTabla="requerimientos";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$Requerimiento->ID_Req;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
    }
}
