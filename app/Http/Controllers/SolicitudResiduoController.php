<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SolResUpdateRequest;
use App\SolicitudResiduo;
use App\audit;
use App\Respel;
use App\Recurso;
use App\ResiduosGener;
use App\SolicitudServicio;


class SolicitudResiduoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Residuos = DB::table('solicitud_residuos')
        //     ->join('respels', 'respels.ID_Respel', '=', 'solicitud_residuos.FK_SolResRespel')
        //     ->join('solicitud_servicios', 'solicitud_servicios.ID_SolSer', '=', 'solicitud_residuos.FK_SolResSolSer')
        //     ->join('sedes', 'solicitud_servicios.Fk_SolSerTransportador', '=', 'sedes.ID_Sede')
        //     ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
        //     ->select('clientes.CliShortname', 'clientes.CliSlug','respels.RespelName', 'solicitud_residuos.*', 'solicitud_servicios.ID_SolSer')
        //     ->get();

        return "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Se ejecuta en el controlador de solicitud de servicio
        $SolRes = DB::table('solicitud_residuos')
            ->join('respels', 'solicitud_residuos.FK_SolResRespel', '=', 'respels.ID_Respel')
            ->select('respels.RespelName', 'respels.ID_Respel')
            ->get();
        $SolSers = SolicitudServicio::all();
        return view('solicitud-resid.create', compact('SolRes', 'SolSers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "hola"; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //comparte show con recursos
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.JefeLogistica') || Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno')){
        
            $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
            $SolSer = SolicitudServicio::where('ID_SolSer', $SolRes->FK_SolResSolSer)->first();
            $RespelSgener = ResiduosGener::where('ID_SGenerRes', $SolRes->FK_SolResRg)->first();
            
            $Respel = DB::table('respels')
            ->join('residuos_geners', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->join('solicitud_residuos', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
            ->select('respels.RespelSlug', 'respels.RespelName', 'respels.ID_Respel')
            ->where('residuos_geners.ID_SGenerRes', $SolRes->FK_SolResRg)
            ->first();
            
            if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
                if($SolSer->SolSerStatus === 'Programado' || $SolSer->SolSerStatus === 'Completado' || $SolSer->SolSerStatus === 'Tratado'  || $SolSer->SolSerStatus === 'Certificacion'){
                    abort(403);
                }
            }
            return view('solicitud-resid.edit', compact('SolRes', 'Respel', 'RespelSgener'));
        }else{
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
    public function updateSolRes(Request $request, $id){

    }

    public function update(SolResUpdateRequest $request, $id)
    {
        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){

            $Respel = Respel::select('ID_Respel')->where('RespelSlug', $request->input('FK_SolResSolSer'))->first();

            $Validate = $request->validate([
                'SolResTypeUnidad' => 'nullable',
                'SolResEmbalaje' => 'required',
                'SolResKgEnviado' => 'max:11|required',
                'SolResCantiUnidad' => 'max:20|nullable',
                'SolResAlto' => 'max:20|nullable',
                'SolResAncho' => 'max:20|nullable',
                'SolResProfundo' => 'max:20|nullable',
                'SolResFotoDescargue_Pesaje' => 'max:1|nullable',
                'SolResFotoTratamiento' => 'max:1|nullable',
                'SolResVideoDescargue_Pesaje' => 'max:1|nullable',
                'SolResVideoTratamiento' => 'max:1|nullable',
            ]);

            $SolRes->SolResKgEnviado = $request->input('SolResKgEnviado');
            $SolRes->SolResCantiUnidad = $request->input('SolResCantiUnidad');
            $SolRes->SolResAlto = $request->input('SolResAlto');
            $SolRes->SolResAncho = $request->input('SolResAncho');
            $SolRes->SolResProfundo = $request->input('SolResProfundo');
            $SolRes->SolResFotoDescargue_Pesaje = $request->input('SolResFotoDescargue_Pesaje');
            $SolRes->SolResFotoTratamiento = $request->input('SolResFotoTratamiento');
            $SolRes->SolResVideoDescargue_Pesaje = $request->input('SolResVideoDescargue_Pesaje');
            $SolRes->SolResVideoTratamiento = $request->input('SolResVideoTratamiento');
    
            switch($request->input('SolResTypeUnidad')){
                case 99: 
                    $SolRes->SolResTypeUnidad = 'Unidad';
                    break;
                case 98: 
                    $SolRes->SolResTypeUnidad = 'Peso';
                    break;
            }
    
            switch($request->input('SolResEmbalaje')){
                case 99: 
                    $SolRes->SolResEmbalaje = 'Bolsas';
                    break;
                case 98: 
                    $SolRes->SolResEmbalaje = 'Canecas';
                    break;
                case 97: 
                    $SolRes->SolResEmbalaje = 'Estibas';
                    break;
                case 96: 
                    $SolRes->SolResEmbalaje = 'Garrafones';
                    break;
                case 95: 
                    $SolRes->SolResEmbalaje = 'Cajas';
                    break;
                default: 
                    abort(500);
            }
        }
        if(Auth::user()->UsRol === trans('adminlte_lang::message.JefeLogistica')){
            $Validate = $request->validate([
                'SolResKgConciliado' => 'numeric',
            ]);
            $SolRes->SolResKgConciliado = $request->input('SolResKgConciliado');
        }

        if(Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno')){
            $Validate = $request->validate([
                'SolResKgRecibido' => 'numeric',
                'SolResKgTratado' => 'numeric',
            ]);
            $SolRes->SolResKgRecibido = $request->input('SolResKgRecibido');
            $SolRes->SolResKgTratado = $request->input('SolResKgTratado');
        }

        $SolRes->save();

        $log = new audit();
        $log->AuditTabla="solicitud_residuos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$SolRes->ID_SolRes;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        return redirect()->route('recurso.show', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
        $Recursos = Recurso::where('FK_RecSolRes', $SolRes->ID_SolRes)->get();
        $SolSer = SolicitudServicio::where('ID_SolSer', $SolRes->FK_SolResSolSer)->first();
        
        $log = new audit();
        $log->AuditTabla="solicitud_residuos";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$SolRes->ID_SolRes;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$SolRes->SolResDelete;
        $log->save();

        if(is_null($Recursos)){
            foreach($Recursos as $Recurso){
                unlink(public_path("img/Recursos/$Recurso->RecSrc")."/$Recurso->RecRmSrc");
            }
            rmdir(public_path("img/Recursos/").$Recursos[0]->RecSrc);
        }

        SolicitudResiduo::destroy($SolRes->ID_SolRes);
        $id = $SolSer->SolSerSlug;

        return redirect()->route('solicitud-servicio.show', compact('id'));
    }
}
