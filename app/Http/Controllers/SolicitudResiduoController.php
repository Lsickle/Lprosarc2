<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SolicitudResiduo;
use App\audit;
use App\Respel;
use App\Recurso;
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

        return "No funciona";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//         return $Servicio;
        
//           se ejecuta en el controlador de solicitud de servicio
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
        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();

        $Respels = Respel::all();

        $SolSers = DB::table('solicitud_servicios')
            ->leftjoin('gener_sedes', 'gener_sedes.ID_GSede', '=', 'solicitud_servicios.FK_SolSerGenerSede')
            ->leftjoin('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')

            ->join('sedes', 'sedes.ID_Sede', '=', 'solicitud_servicios.Fk_SolSerTransportador')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            
            ->select('generadors.GenerName', 'clientes.CliShortname', 'solicitud_servicios.ID_SolSer')
            ->get();

        return view('solicitud-resid.edit', compact('SolRes', 'Respels', 'SolSers'));
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
        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
        $SolRes->fill($request->all());
        $SolRes->save();

        $log = new audit();
        $log->AuditTabla="solicitud_residuos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$SolRes->ID_SolRes;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        return redirect()->route('solicitud-residuo.index');
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
