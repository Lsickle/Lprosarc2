<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SolicitudServicio;
use App\audit;
use App\Sede;
use App\GenerSede;
use App\Respel;
use App\ResiduosGener;



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
            ->leftjoin('gener_sedes', 'gener_sedes.ID_GSede', '=', 'solicitud_servicios.FK_SolSerGenerSede')
            ->leftjoin('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
         
            ->join('residuos_geners', 'residuos_geners.FK_SolSer', '=', 'solicitud_servicios.ID_SolSer')
            ->leftjoin('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')

            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('solicitud_servicios.*', 'clientes.CliShortname', 'generadors.GenerName', 'respels.RespelName')
            ->get();

        return view('solicitud-serv.index', compact('Servicios'));
        }
        $Servicios = DB::table('solicitud_servicios')
            ->join('sedes', 'sedes.ID_Sede', '=', 'solicitud_servicios.Fk_SolSerTransportador')
            ->leftjoin('gener_sedes', 'gener_sedes.ID_GSede', '=', 'solicitud_servicios.FK_SolSerGenerSede')
            ->leftjoin('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            ->join('residuos_geners', 'residuos_geners.FK_SGener', '=', 'gener_sedes.ID_GSede')
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

        $GSedes = GenerSede::all();
        // $GSedes = DB::table('gener_sedes')
        // ->join('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
        // ->join('sedes', 'sedes.ID_Sede', '=', 'generadors.FK_GenerCli')
        // ->select('gener_sedes.GSedeName', 'gener_sedes.ID_GSede')
        // ->get();
        
        $Respels = Respel::all();
        // $Respels = DB::table('respels')
        //     ->join('sedes', 'sedes.ID_Sede', '=', 'respels.FK_RespelSede')
        //     ->select('respels.*')
        //     ->get();

        return view('solicitud-serv.create', compact('GSedes', 'Sedes', 'Respels'));                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Sedes = Sede::where('ID_Sede', $request->input('Fk_SolSerTransportador'))->first();

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = $request->input('SolSerStatus');
        $Servicio->SolSerTipo = $request->input('SolSerTipo');

        if($request->input('SolSerAuditable') == 'on'){
            $Servicio->SolSerAuditable = '1';
        }else{
            $Servicio->SolSerAuditable = '0';
        }

        $Servicio->SolSerFrecuencia = $request->input('SolSerFrecuencia');
        $Servicio->SolSerConducExter = $request->input('SolSerConducExter');
        $Servicio->SolSerVehicExter = $request->input('SolSerVehicExter');
        $Servicio->Fk_SolSerTransportador = $request->input('Fk_SolSerTransportador');
        $Servicio->FK_SolSerGenerSede = $request->input('FK_SolSerGenerSede');
        $Servicio->SolSerDelete = 0;
        $Servicio->SolSerSlug = 'Slug'.date('YmdHis');
        
        $Servicio->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = $request->input('FK_SolSerGenerSede');
        $SGenerRes->FK_Respel = $request->input('FK_Respel');
        $SGenerRes->FK_SolSer = $Servicio->ID_SolSer;
        $SGenerRes->save();

        $log = new audit();
        $log->AuditTabla="solicitud_servicios";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Servicio->ID_SolSer;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

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
        $Servicios = SolicitudServicio::where('SolSerSlug', $id)->first();

        $SGenerRes = ResiduosGener::where('FK_SolSer', $Servicios->ID_SolSer)->first();
        $Sedes = Sede::all();
        $GSedes = GenerSede::all();
        $Respels = Respel::all();


        return view('solicitud-serv.edit', compact('Servicios', 'GSedes', 'Sedes', 'Respels', 'SGenerRes'));
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
        $log->save();
        
        $log = new audit();
        $log->AuditTabla="solicitud_servicios";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Servicios->ID_SolSer;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

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
