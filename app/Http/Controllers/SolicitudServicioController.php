<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SolicitudServicio;
use App\SolicitudResiduo;
use App\audit;
use App\Sede;
use App\GenerSede;
use App\Respel;
use App\ResiduosGener;
use App\Cliente;
use App\Tratamiento;
use App\Generador;
use App\Personal;


class SolicitudServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->UsRol === "Programador"){
        $Servicios = DB::table('solicitud_servicios')
            ->join('sedes', 'sedes.ID_Sede', '=', 'solicitud_servicios.Fk_SolSerTransportador')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
            ->select('solicitud_servicios.*', 'clientes.CliShortname','personals.PersFirstName','personals.PersLastName', 'personals.PersAddress')
            ->get();
        $Residuos = SolicitudResiduo::all();
        return view('solicitud-serv.index', compact('Servicios', 'Residuos '));
        }
        $Servicios = DB::table('solicitud_servicios')
            ->join('sedes', 'sedes.ID_Sede', '=', 'solicitud_servicios.Fk_SolSerTransportador')
            ->leftjoin('gener_sedes', 'gener_sedes.ID_GSede', '=', 'solicitud_servicios.FK_SolSerGenerSede')
            ->leftjoin('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            ->join('residuos_geners', 'residuos_geners.FK_SolSer', '=', 'solicitud_servicios.ID_SolSer')
            ->leftjoin('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('solicitud_servicios.*', 'clientes.CliShortname', 'generadors.GenerName', 'respels.RespelName')
            ->where('solicitud_servicios.SolSerDelete', 0)
            ->get();


        return view('solicitud-serv.index', compact('Servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Sedes = Sede::all();
        $Clientes = Cliente::all();
        $Respels = DB::table('respels')
            ->select('ID_Respel', 'RespelName')
            ->get();
        $SGeneradors = DB::table('gener_sedes')
            ->select('ID_GSede', 'GSedeName')
            ->get();
        $Personals = Personal::all();
        $Tratamientos = Tratamiento::select('ID_Trat', 'TratName');
        return view('solicitud-serv.create', compact( 'Respels','Sedes','Personals','Clientes', 'SGeneradors', 'Tratamientos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $SolicitudServicio = new SolicitudServicio();
        $SolicitudServicio->SolSerStatus = 'Pendiente';
        $SolicitudServicio->SolSerTipo = $request->input('SolSerTipo');
        if ($request->input('SolSerAuditable')) {
            $SolicitudServicio->SolSerAuditable = 1;
        }
        $SolicitudServicio->SolSerFrecuencia = $request->input('SolSerFrecuencia');
        $SolicitudServicio->SolSerConducExter = $request->input('SolSerConducExter');
        $SolicitudServicio->SolSerVehicExter = $request->input('SolSerVehicExter');
        $SolicitudServicio->Fk_SolSerTransportador = $request->input('Fk_SolSerTransportador');
        $SolicitudServicio->SolSerSlug = now().'solicitud'.$request->input('FK_SolSerCliente').'deservicio';
        $SolicitudServicio->SolSerDelete = 0;
        $SolicitudServicio->FK_SolSerPersona = $request->input('FK_SolSerPersona');
        $SolicitudServicio->FK_SolSerCliente = $request->input('FK_SolSerCliente');
        $SolicitudServicio->save();
        for ($x=1; $x <= count($request['SGenerador']); $x++) {
            for ($y=0; $y < count($request['Respel'][$x]); $y++) {
                $SolicitudResiduo = new SolicitudResiduo();
                $FK_SolResRg = DB::table('residuos_geners')
                    ->select('ID_SGenerRes')
                    ->where('FK_SGener', $request['SGenerador'][$x])
                    ->where('FK_Respel', $request['Respel'][$x][$y])
                    ->get();
                $SolicitudResiduo->SolResCateEnviado = $request['CateEnviado'][$x][$y];
                $SolicitudResiduo->SolResCateRecibido = 0;
                $SolicitudResiduo->SolResDelete = 0;
                $SolicitudResiduo->SolResSlug = now()."solicitud".$request['Respel'][$x][$y].$x.$y."residuo";
                $SolicitudResiduo->FK_SolResSolSer = $SolicitudServicio->ID_SolSer;
                $SolicitudResiduo->FK_SolResTratamiento = $request['Tratamiento'][$x][$y];
                foreach ($FK_SolResRg as $FK_SolRg) {
                    $SolicitudResiduo->FK_SolResRg = $FK_SolRg->ID_SGenerRes;
                }
                if(isset($request['FotoCargue'][$x][$y])){
                    $SolicitudResiduo->SolResFotoCargue = 1;
                }
                if(isset($request['FotoDescargue'][$x][$y])) {
                    $SolicitudResiduo->SolResFotoDescargue = 1;
                }
                if(isset($request['FotoPesaje'][$x][$y])){
                    $SolicitudResiduo->SolResFotoPesaje = 1;
                }
                if(isset($request['FotoReempacado'][$x][$y])){
                    $SolicitudResiduo->SolResFotoReempacado = 1;
                }
                if(isset($request['FotoMezclado'][$x][$y])){
                    $SolicitudResiduo->SolResFotoMezclado = 1;
                }
                if(isset($request['FotoDestruccion'][$x][$y])){
                    $SolicitudResiduo->SolResFotoDestruccion = 1;
                }
                if(isset($request['VideoCargue'][$x][$y])){
                    $SolicitudResiduo->SolResVideoCargue = 1;
                }
                if(isset($request['VideoDescargue'][$x][$y])){
                    $SolicitudResiduo->SolResVideoDescargue = 1;
                }
                if(isset($request['VideoPesaje'][$x][$y])){
                    $SolicitudResiduo->SolResVideoPesaje = 1;
                }
                if(isset($request['VideoReempacado'][$x][$y])){
                    $SolicitudResiduo->SolResVideoReempacado = 1;
                }
                if(isset($request['VideoMezclado'][$x][$y])){
                    $SolicitudResiduo->SolResVideoMezclado = 1;
                }
                if(isset($request['VideoDestruccion'][$x][$y])){
                    $SolicitudResiduo->SolResVideoDestruccion = 1;
                }
                if(isset($request['Devolucion'][$x][$y])){
                    $SolicitudResiduo->SolResDevolucion = 1;
                }
                if(isset($request['Planillas'][$x][$y])){
                    $SolicitudResiduo->SolResPlanillas = 1;
                }
                if(isset($request['Alistamiento'][$x][$y])){
                    $SolicitudResiduo->SolResAlistamiento = 1;
                }
                if(isset($request['Capacitacion'][$x][$y])){
                    $SolicitudResiduo->SolResCapacitacion = 1;
                }
                if(isset($request['Bascula'][$x][$y])){
                    $SolicitudResiduo->SolResBascula = 1;
                }
                if(isset($request['Platform'][$x][$y])){
                    $SolicitudResiduo->SolResPlatform = 1;
                }
                if(isset($request['CertiEspecial'][$x][$y])){
                    $SolicitudResiduo->SolResCertiEspecial = 1;
                }
                $SolicitudResiduo->SolResTipoCate = $request['TipoCate'][$x][$y];
                $SolicitudResiduo->SolResAuditoria = $SolicitudServicio->SolSerAuditable;
                $SolicitudResiduo->SolResAuditoriaTipo = $request['SolResAuditoriaTipo'];
                $SolicitudResiduo->SolResUnidades = $request['Unidades'][$x][$y];
                $SolicitudResiduo->save();
            }
        }
        return redirect()->route('solicitud-servicio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $SolicitudServicio = DB::table('solicitud_servicios')
            ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
            ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
            ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->join('municipios', 'municipios.ID_Mun', 'sedes.FK_SedeMun')
            ->select('solicitud_servicios.*','clientes.CliNit','clientes.CliName','sedes.SedeAddress','personals.PersFirstName','personals.PersLastName', 'personals.PersAddress'/*se remplaza por email*/,'municipios.MunName')
            ->where('solicitud_servicios.SolSerSlug', $id)
            ->get();
        $TransPor = DB::table('solicitud_servicios')
            ->join('sedes', 'sedes.ID_Sede', '=', 'solicitud_servicios.Fk_SolSerTransportador')
            ->join('municipios', 'municipios.ID_Mun', 'sedes.FK_SedeMun')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('clientes.CliNit','clientes.CliName','sedes.SedeAddress','municipios.MunName')
            ->where('solicitud_servicios.SolSerSlug', $id)
            ->get();
        $GenerResiduos = DB::table('solicitud_residuos')
            ->distinct()
            ->join('residuos_geners', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
            ->join('generadors' , 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            ->join('municipios', 'municipios.ID_Mun', 'gener_sedes.FK_GSedeMun')
            ->select('gener_sedes.GSedeAddress','residuos_geners.FK_SGener', 'generadors.GenerNit', 'generadors.GenerName', 'municipios.MunName')
            ->where('solicitud_residuos.FK_SolResSolSer', $SolicitudServicio[0]->ID_SolSer)
            ->get();
        $Residuos = DB::table('solicitud_residuos')
            ->join('residuos_geners', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
            ->join('tratamientos', 'tratamientos.ID_Trat', '=', 'solicitud_residuos.FK_SolResTratamiento')
            ->join('respels' , 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->select('solicitud_residuos.*', 'residuos_geners.FK_SGener', 'tratamientos.TratName','respels.*')
            ->where('solicitud_residuos.FK_SolResSolSer', $SolicitudServicio[0]->ID_SolSer)
            ->get();
        return view('solicitud-serv.show', compact('SolicitudServicio','TransPor','Residuos', 'GenerResiduos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Solicitud = SolicitudServicio::where('SolSerSlug', $id)->first();
        $Sede = Sede::where('ID_Sede', $Solicitud->Fk_SolSerTransportador)
            ->select('SedeName','ID_Sede')
            ->first();
        $Sedes = Sede::where('ID_Sede', '<>', $Solicitud->Fk_SolSerTransportador)
            ->select('SedeName','ID_Sede')
            ->get();
        $Cliente = Cliente::where('ID_Cli', $Solicitud->FK_SolSerCliente)
            ->select('ID_Cli','CliName')
            ->first();
        // return $Cliente;
        $Clientes = Cliente::where('ID_Cli', '<>', $Solicitud->FK_SolSerCliente)
            ->select('ID_Cli','CliName')
            ->get();
        $Persona = Personal::where('ID_Pers', $Solicitud->FK_SolSerPersona)
            ->select('ID_Pers','PersFirstName','PersLastName')
            ->first();
        $Personal = Personal::where('ID_Pers', '<>', $Solicitud->FK_SolSerPersona)
            ->select('ID_Pers','PersFirstName','PersLastName')
            ->get();
        $GenerResiduos = DB::table('solicitud_residuos')
            ->distinct()
            ->join('residuos_geners', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
            ->select('gener_sedes.ID_GSede','gener_sedes.GSedeName','residuos_geners.FK_SGener')
            ->where('solicitud_residuos.FK_SolResSolSer', $Solicitud->ID_SolSer)
            ->get();
        $SGeneradors = GenerSede::select('ID_GSede','GSedeName');
        // return $GenerResiduos;
        $Residuos = DB::table('solicitud_residuos')
            ->join('residuos_geners', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
            ->join('tratamientos', 'tratamientos.ID_Trat', '=', 'solicitud_residuos.FK_SolResTratamiento')
            ->join('respels' , 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->select('solicitud_residuos.*', 'residuos_geners.FK_SGener','tratamientos.ID_Trat','tratamientos.TratName','respels.ID_Respel','respels.RespelName')
            ->where('solicitud_residuos.FK_SolResSolSer', $Solicitud->ID_SolSer)
            ->get();
        $Respels = Respel::select('ID_Respel','RespelName');
        $Tratamientos = Tratamiento::select('ID_Trat', 'TratName');
            // return $Respels;
        return view('solicitud-serv.edit', compact('Solicitud','Sede','Sedes','Cliente','Clientes','Persona','Personal','GenerResiduos','SGeneradors','Residuos','Respels','Tratamientos','id'));
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
        // return $request;
        $SolicitudServicio = SolicitudServicio::where('SolSerSlug', $id)->first();
        $SolicitudServicio->SolSerStatus = 'Pendiente';
        $SolicitudServicio->SolSerTipo = $request->input('SolSerTipo');
        if ($request->input('SolSerAuditable')) {
            $SolicitudServicio->SolSerAuditable = 1;
        }
        $SolicitudServicio->SolSerFrecuencia = $request->input('SolSerFrecuencia');
        $SolicitudServicio->SolSerConducExter = $request->input('SolSerConducExter');
        $SolicitudServicio->SolSerVehicExter = $request->input('SolSerVehicExter');
        $SolicitudServicio->Fk_SolSerTransportador = $request->input('Fk_SolSerTransportador');
        $SolicitudServicio->SolSerSlug = now().'solicitud'.$request->input('FK_SolSerCliente').'deservicio';
        $SolicitudServicio->SolSerDelete = 0;
        $SolicitudServicio->FK_SolSerPersona = $request->input('FK_SolSerPersona');
        $SolicitudServicio->FK_SolSerCliente = $request->input('FK_SolSerCliente');
        $SolicitudServicio->save();
        for ($x=0; $x < count($request['SGenerador']); $x++) {
            for ($y=0; $y < count($request['Respel'][$x]); $y++) {
                $slug = $request['SolResSlug'][$x][$y];
                $SolicitudResiduo = SolicitudResiduo::where('SolResSlug', $slug)->first();
                // return $SolicitudResiduo;
                $FK_SolResRg = DB::table('residuos_geners')
                    ->select('ID_SGenerRes')
                    ->where('FK_SGener', $request['SGenerador'][$x])
                    ->where('FK_Respel', $request['Respel'][$x][$y])
                    ->get();
                $SolicitudResiduo->SolResCateEnviado = $request['CateEnviado'][$x][$y];
                $SolicitudResiduo->FK_SolResTratamiento = $request['Tratamiento'][$x][$y];
                foreach ($FK_SolResRg as $FK_SolRg) {
                    $SolicitudResiduo->FK_SolResRg = $FK_SolRg->ID_SGenerRes;
                }
                if(isset($request['FotoCargue'][$x][$y])){
                    $SolicitudResiduo->SolResFotoCargue = 1;
                }
                if(isset($request['FotoDescargue'][$x][$y])) {
                    $SolicitudResiduo->SolResFotoDescargue = 1;
                }
                if(isset($request['FotoPesaje'][$x][$y])){
                    $SolicitudResiduo->SolResFotoPesaje = 1;
                }
                if(isset($request['FotoReempacado'][$x][$y])){
                    $SolicitudResiduo->SolResFotoReempacado = 1;
                }
                if(isset($request['FotoMezclado'][$x][$y])){
                    $SolicitudResiduo->SolResFotoMezclado = 1;
                }
                if(isset($request['FotoDestruccion'][$x][$y])){
                    $SolicitudResiduo->SolResFotoDestruccion = 1;
                }
                if(isset($request['VideoCargue'][$x][$y])){
                    $SolicitudResiduo->SolResVideoCargue = 1;
                }
                if(isset($request['VideoDescargue'][$x][$y])){
                    $SolicitudResiduo->SolResVideoDescargue = 1;
                }
                if(isset($request['VideoPesaje'][$x][$y])){
                    $SolicitudResiduo->SolResVideoPesaje = 1;
                }
                if(isset($request['VideoReempacado'][$x][$y])){
                    $SolicitudResiduo->SolResVideoReempacado = 1;
                }
                if(isset($request['VideoMezclado'][$x][$y])){
                    $SolicitudResiduo->SolResVideoMezclado = 1;
                }
                if(isset($request['VideoDestruccion'][$x][$y])){
                    $SolicitudResiduo->SolResVideoDestruccion = 1;
                }
                if(isset($request['Devolucion'][$x][$y])){
                    $SolicitudResiduo->SolResDevolucion = 1;
                }
                if(isset($request['Planillas'][$x][$y])){
                    $SolicitudResiduo->SolResPlanillas = 1;
                }
                if(isset($request['Alistamiento'][$x][$y])){
                    $SolicitudResiduo->SolResAlistamiento = 1;
                }
                if(isset($request['Capacitacion'][$x][$y])){
                    $SolicitudResiduo->SolResCapacitacion = 1;
                }
                if(isset($request['Bascula'][$x][$y])){
                    $SolicitudResiduo->SolResBascula = 1;
                }
                if(isset($request['Platform'][$x][$y])){
                    $SolicitudResiduo->SolResPlatform = 1;
                }
                if(isset($request['CertiEspecial'][$x][$y])){
                    $SolicitudResiduo->SolResCertiEspecial = 1;
                }
                $SolicitudResiduo->SolResTipoCate = $request['TipoCate'][$x][$y];
                $SolicitudResiduo->SolResAuditoria = $SolicitudServicio->SolSerAuditable;
                $SolicitudResiduo->SolResAuditoriaTipo = $request['SolResAuditoriaTipo'];
                $SolicitudResiduo->SolResUnidades = $request['Unidades'][$x][$y];
                $SolicitudResiduo->save();
            }
                // return $SolicitudResiduo.' '.$request['SolResSlug'][$x];
        }
        // return $SolicitudServicio;
        /*// return $request;
        $Servicios = SolicitudServicio::where('ID_SolSer', $id)->first();
        $Servicios->fill($request->all());
        $Servicios->SolSerAuditable =$request->input('SolSerAuditable');
        $Servicios->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes = ResiduosGener::where('FK_SolSer', $Servicios->ID_SolSer)->first();
        $SGenerRes->FK_SGener = $request->input('FK_SolSerGenerSede');
        $SGenerRes->FK_Respel = $request->input('FK_Respel');
        $SGenerRes->save();

        $log = new audit();
        $log->AuditTabla="residuos_geners";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$SGenerRes->ID_SGenerRes;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();*/
        
        // $log = new audit();
        // $log->AuditTabla="solicitud_servicios";
        // $log->AuditType="Modificado";
        // $log->AuditRegistro=$SolicitudServicio->ID_SolSer;
        // $log->AuditUser=Auth::user()->email;
        // $log->Auditlog=json_encode($request->all());
        // $log->save();

        return redirect()->route('solicitud-servicio.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Servicios = SolicitudServicio::where('SolSerSlug', $id)->first();
        if ($Servicios->SolSerDelete == 0) {
            $Servicios->SolSerDelete = 1;
        }
        else{
            $Servicios->SolSerDelete = 0;
        }
        $Servicios->save();

        $log = new audit();
        $log->AuditTabla="solicitud_serviciosrespels";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$Servicios->ID_SolSer;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$Servicios->SolSerDelete;
        $log->save();
        
        return redirect()->route('solicitud-servicio.index');
    }
}
