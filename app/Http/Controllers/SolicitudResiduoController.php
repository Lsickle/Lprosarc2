<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SolicitudResiduo;
use App\audit;
use App\Respel;
use App\Recurso;
use App\ResiduosGener;
use App\SolicitudServicio;
use App\ProgramacionVehiculo;

class SolicitudResiduoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
            $Programacion = ProgramacionVehiculo::where('FK_ProgServi', $SolSer->ID_SolSer)->first();
            
            $Respel = DB::table('respels')
                ->join('residuos_geners', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
                ->join('solicitud_residuos', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
                ->select('respels.RespelSlug', 'respels.RespelName', 'respels.ID_Respel')
                ->where('residuos_geners.ID_SGenerRes', $SolRes->FK_SolResRg)
                ->first();

            switch(Auth::user()->UsRol){
                case trans('adminlte_lang::message.Cliente'):
                    if($SolSer->SolSerStatus === 'Programado' || $SolSer->SolSerStatus === 'Completado' || $SolSer->SolSerStatus === 'Conciliado' || $SolSer->SolSerStatus === 'Tratado'  || $SolSer->SolSerStatus === 'Certificacion'){
                        abort(403);
                    }
                    break;
                case trans('adminlte_lang::message.JefeLogistica'):
                    if($SolSer->SolSerStatus !== 'Completado'){
                        abort(403);
                    }
                    break;
                case trans('adminlte_lang::message.SupervisorTurno'):
                    if(($SolSer->SolSerStatus === 'Programado' || $SolSer->SolSerStatus === 'Conciliado') && $Programacion->ProgVehEntrada !== Null){
                    }else{
                        abort(403);
                    }
                    break;
            }
            return view('solicitud-resid.edit', compact('SolRes', 'Respel', 'RespelSgener', 'SolSer', 'Programacion'));
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
        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
        $SolSer = SolicitudServicio::where('ID_SolSer', $SolRes->FK_SolResSolSer)->first();

        $Validate = $request->validate([
            'SolResKg'  => 'required|max:11',
        ]);
        switch($SolSer->SolSerStatus){
            case 'Programado':
                if($SolRes->SolResTypeUnidad === 'Litros' || $SolRes->SolResTypeUnidad === 'Unidades'){
                    $SolRes->SolResCantiUnidadRecibida = $request->input('SolResCantiUnidadRecibida');
                    $SolRes->SolResCantiUnidadConciliada = $request->input('SolResCantiUnidadRecibida');
                }
                $SolRes->SolResKgRecibido = $request->input('SolResKg');
                $SolRes->SolResKgConciliado = $request->input('SolResKg');
                break;
            case 'Completado':
                if($SolRes->SolResTypeUnidad === 'Litros' || $SolRes->SolResTypeUnidad === 'Unidades'){
                    $SolRes->SolResCantiUnidadConciliada = $request->input('SolResKg');
                }else{
                    $SolRes->SolResKgConciliado = $request->input('SolResKg');
                }
                break;
            case 'Conciliado':
                if( $request->input('ValorConciliado') === NULL){
                    $SolRes->SolResKgTratado = $request->input('SolResKg');
                }else{
                    $SolRes->SolResKgTratado = $request->input('ValorConciliado');
                }
                break;
            default:
                abort(500);
                break;
        }
        $SolRes->save();

        $log = new audit();
        $log->AuditTabla="solicitud_residuos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$SolRes->ID_SolRes;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        $id = $SolSer->SolSerSlug;

        return redirect()->route('solicitud-servicio.show', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            $Respel = Respel::select('ID_Respel')->where('RespelSlug', $request->input('FK_SolResSolSer'))->first();

            $Validate = $request->validate([
                'SolResTypeUnidad' => 'nullable',
                'SolResEmbalaje' => 'required',
                'SolResKgEnviado' => 'max:11|required',
                'SolResCantiUnidad' => 'max:20|nullable',
                'SolResAlto' => 'max:20|nullable|numeric',
                'SolResAncho' => 'max:20|nullable|numeric',
                'SolResProfundo' => 'max:20|nullable|numeric',
                'SolResFotoDescargue_Pesaje' => 'max:1|nullable',
                'SolResFotoTratamiento' => 'max:1|nullable',
                'SolResVideoDescargue_Pesaje' => 'max:1|nullable',
                'SolResVideoTratamiento' => 'max:1|nullable',
            ]);
            
            if($request->input('SolResTypeUnidad') === NULL && ($request->input('SolResCantiUnidad') === NULL || $request->input('SolResCantiUnidad') !== NULL)){
                $SolRes->SolResTypeUnidad = null;
                $SolRes->SolResCantiUnidad = null;
            }elseif($request->input('SolResCantiUnidad') === NULL && ($request->input('SolResTypeUnidad') === NULL || $request->input('SolResTypeUnidad') !== NULL)){
                $SolRes->SolResTypeUnidad = null;
                $SolRes->SolResCantiUnidad = null;
            }else{
                $SolRes->SolResTypeUnidad = $request->input('SolResTypeUnidad');
                $SolRes->SolResCantiUnidad = $request->input('SolResCantiUnidad');
            }

            $SolRes->SolResKgEnviado = $request->input('SolResKgEnviado');
            
            if($request->input('SolResAlto') === Null){
            }elseif($request->input('SolResAncho') === Null){
            }elseif($request->input('SolResProfundo') === Null){
            }else{
                $SolRes->SolResAlto = $request->input('SolResAlto');
                $SolRes->SolResAncho = $request->input('SolResAncho');
                $SolRes->SolResProfundo = $request->input('SolResProfundo');
            }


            if($request->input('SolResFotoDescargue_Pesaje') !== Null){
                if($request->input('SolResFotoDescargue_Pesaje') === 0 || $request->input('SolResFotoDescargue_Pesaje') === 1){
                    $SolRes->SolResFotoDescargue_Pesaje = $request->input('SolResFotoDescargue_Pesaje');
                }else{
                    abort(500);
                }
            }
            if($request->input('SolResFotoTratamiento') !== Null){
                if($request->input('SolResFotoTratamiento') == 0 || $request->input('SolResFotoTratamiento') == 1){
                    $SolRes->SolResFotoTratamiento = $request->input('SolResFotoTratamiento');
                }else{
                    abort(500);
                }
            }
            if($request->input('SolResVideoDescargue_Pesaje') !== Null){
                if($request->input('SolResVideoDescargue_Pesaje') == 0 || $request->input('SolResVideoDescargue_Pesaje') == 1){
                    $SolRes->SolResVideoDescargue_Pesaje = $request->input('SolResVideoDescargue_Pesaje');
                }else{
                    abort(500);
                }
            }
            if($request->input('SolResVideoTratamiento') !== Null){
                if($request->input('SolResVideoTratamiento') == 0 || $request->input('SolResVideoTratamiento') == 1){
                    $SolRes->SolResVideoTratamiento = $request->input('SolResVideoTratamiento');
                }else{
                    abort(500);
                }
            }
            switch($request->input('SolResTypeUnidad')){
                case 99: 
                    $SolRes->SolResTypeUnidad = 'Unidad';
                    break;
                case 98: 
                    $SolRes->SolResTypeUnidad = 'Litros';
                    break;
                case Null: 
                    $SolRes->SolResTypeUnidad = Null;
                    break;
                default: 
                    abort(500);
            }
            switch ($request->input('SolResEmbalaje')) {
                case 99:
                    $SolRes->SolResEmbalaje = "Sacos/Bolsas";
                    break;
                case 98:
                    $SolRes->SolResEmbalaje = "Bidones Pequeños";
                    break;
                case 97:
                    $SolRes->SolResEmbalaje = "Bidones Grandes";
                    break;
                case 96:
                    $SolRes->SolResEmbalaje = "Estibas";
                    break;
                case 95:
                    $SolRes->SolResEmbalaje = "Garrafones/Jerricanes";
                    break;
                case 94:
                    $SolRes->SolResEmbalaje = "Cajas";
                    break;
                case 93:
                    $SolRes->SolResEmbalaje = "Cuñetes";
                    break;
                case 92:
                    $SolRes->SolResEmbalaje = "Big Bags";
                    break;
                case 91:
                    $SolRes->SolResEmbalaje = "Isotanques";
                    break;
                case 90:
                    $SolRes->SolResEmbalaje = "Tachos";
                    break;
                case 89:
                    $SolRes->SolResEmbalaje = "Embalajes Compuestos";
                    break;
                case 88:
                    $SolRes->SolResEmbalaje = "Granel";
                    break;
                default:
                    abort(500);
            }
        }
        if(Auth::user()->UsRol === trans('adminlte_lang::message.JefeLogistica')){
            $Validate = $request->validate([
                'SolResKgConciliado' => 'max:11|required',
            ]);
            $SolRes->SolResKgConciliado = $request->input('SolResKgConciliado');
        }

        if(Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno')){
            $Validate = $request->validate([
                'SolResKgRecibido' => 'max:11|nullable',
                'SolResKgTratado' => 'max:11|nullable',
            ]);
            if($SolRes->SolResTypeUnidad === 'Litros' || $SolRes->SolResTypeUnidad === 'Unidad'){
                if($request->input('SolResCantiUnidadRecibida') === null){
                }else{
                    $SolRes->SolResCantiUnidadRecibida = $request->input('SolResCantiUnidadRecibida');
                    if($SolRes->SolResCantiUnidadConciliada === null && $request->input('SolResCantiUnidadConciliada') === null){
                        $SolRes->SolResCantiUnidadConciliada = $request->input('SolResCantiUnidadRecibida');
                    }
                }
                if($request->input('SolResCantiUnidadConciliada') === null){
                }else{
                    $SolRes->SolResCantiUnidadConciliada = $request->input('SolResCantiUnidadConciliada');
                }
                if($request->input('ValorConciliado') !== Null){
                    $SolRes->SolResKgTratado = $request->input('ValorConciliado');
                }else{
                    if($request->input('SolResKgTratado') !== Null){
                        $SolRes->SolResKgTratado = $request->input('SolResKgTratado');
                    }elseif($SolRes->SolResKgTratado === Null && $request->input('SolResKgTratado') === Null){
                        $SolRes->SolResKgTratado = 0;
                    }else{
                        $SolRes->SolResKgTratado = $SolRes->SolResKgTratado;
                    }
                }
            }else{
                if($SolRes->SolResKgRecibido === Null){
                    if($request->input('SolResKgRecibido') === Null){
                        $SolRes->SolResKgRecibido = 0;
                        $SolRes->SolResKgConciliado = 0;
                    }else{
                        $SolRes->SolResKgRecibido = $request->input('SolResKgRecibido');
                        $SolRes->SolResKgConciliado = $request->input('SolResKgRecibido');
                    }
                }elseif($request->input('SolResKgTratado') === Null && $request->input('ValorConciliado') === Null){
                    $SolRes->SolResKgRecibido = $request->input('SolResKgRecibido');
                    $SolRes->SolResKgConciliado = $request->input('SolResKgRecibido');
                }
                
                if($request->input('ValorConciliado') !== Null){
                    $SolRes->SolResKgTratado = $request->input('ValorConciliado');
                }else{
                    if($request->input('SolResKgTratado') !== Null){
                        $SolRes->SolResKgTratado = $request->input('SolResKgTratado');
                    }elseif($SolRes->SolResKgTratado === Null && $request->input('SolResKgTratado') === Null){
                        $SolRes->SolResKgTratado = 0;
                    }else{
                        $SolRes->SolResKgTratado = $SolRes->SolResKgTratado;
                    }
                }
            }
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
