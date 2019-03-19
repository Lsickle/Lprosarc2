<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SolicitudResiduo;
use App\audit;
use App\Respel;
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
        $Residuos = DB::table('solicitud_residuos')
            ->join('respels', 'respels.ID_Respel', '=', 'solicitud_residuos.SolResRespel')
            ->join('solicitud_servicios', 'solicitud_servicios.ID_SolSer', '=', 'solicitud_residuos.SolResSolSer')
            ->join('sedes', 'solicitud_servicios.Fk_SolSerTransportador', '=', 'sedes.ID_Sede')
            ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->select('clientes.CliShortname', 'clientes.CliSlug','respels.RespelName', 'solicitud_residuos.*')
            ->get();

        return view('solicitud-resid.index', compact('Residuos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $SolRes = DB::table('solicitud_residuos')
            ->join('respels', 'solicitud_residuos.SolResRespel', '=', 'respels.ID_Respel')
            ->join('solicitud_servicios', 'solicitud_residuos.SolResSolSer', '=', 'solicitud_servicios.ID_SolSer')

            ->leftjoin('gener_sedes', 'gener_sedes.ID_GSede', '=', 'solicitud_servicios.FK_SolSerGenerSede')
            ->leftjoin('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')

            ->join('sedes', 'sedes.ID_Sede', '=', 'solicitud_servicios.Fk_SolSerTransportador')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')

            ->select('respels.RespelName', 'respels.ID_Respel', 'generadors.GenerName', 'clientes.CliShortname', 'solicitud_servicios.ID_SolSer')
            ->get();

        return view('solicitud-resid.create', compact('SolRes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = $request->input('SolResKgEnviado');
        $Residuo->SolResKgRecibido = $request->input('SolResKgRecibido');
        $Residuo->SolResKgConciliado = $request->input('SolResKgConciliado');
        $Residuo->SolResKgTratado = $request->input('SolResKgTratado');
        $Residuo->SolResRespel = $request->input('SolResRespel');
        $Residuo->SolResSolSer = $request->input('SolResSolSer');
        $Residuo->save();

        return redirect()->route('solicitud-residuo.index'); 
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
        $SolRes = SolicitudResiduo::where('ID_SolRes', $id)->first();

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
        $SolRes = SolicitudResiduo::where('ID_SolRes', $id)->first();
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
        //
    }
}
