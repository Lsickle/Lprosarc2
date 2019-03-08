<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;   
use App\Requerimiento;
use App\Respel;
use App\audit;
// use App\Http\Controllers\respels;
class RequerimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $Requerimientos = DB::table('requerimientos')
            ->join('respels', 'respels.ID_Respel', '=', 'requerimientos.FK_ReqRespel')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'respels.FK_RespelGenerSede')
            ->join('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            ->select('requerimientos.*', 'generadors.GenerName')
            ->get();
        // $Requerimientos = Requerimiento::all();

        return view('requerimientos.index', compact('Requerimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requerimientos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Requerimientos = Respel::where('RespelSlug',$request->input('FK_ReqRespel'))->first();

        $Requerimiento = new Requerimiento();
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
        $Requerimiento->ReqSlug = 'ReqSlug'.$request->input('ReqRespel');
        $Requerimiento->FK_ReqRespel =  $Requerimientos->ID_Respel;
        $Requerimiento->save();

        $log = new audit();
        $log->AuditTabla="requerimientos";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Requerimiento->ID_Req;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('respels.index', compact('Requerimientos'));
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
        $Requerimientos = Requerimiento::all();        
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
        $Requerimiento->fill($request->all());
        $Requerimiento->save();

        $log = new audit();
        $log->AuditTabla="requerimientos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Requerimiento->ID_Req;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id->delete();
        return $id;

        $log = new audit();
        $log->AuditTabla="requerimientos";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Requerimiento->ID_Req;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
    }
}
