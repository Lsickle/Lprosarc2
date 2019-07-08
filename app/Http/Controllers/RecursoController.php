<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RecursosStoreRequest;
use App\audit;
use App\Recurso;
use App\cliente;
use App\SolicitudResiduo;
use App\ProgramacionVehiculo;
use Illuminate\Support\Facades\Hash;


class RecursoController extends Controller
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
       //
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
    public function show(Request $request, $id)
    {
        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();

        $Respel = DB::table('solicitud_residuos')
            ->join('residuos_geners', 'residuos_geners.ID_SGenerRes', 'solicitud_residuos.FK_SolResRg')
            ->join('respels', 'respels.ID_Respel', 'residuos_geners.FK_Respel')
            ->select('respels.RespelName')
            ->where('residuos_geners.ID_SGenerRes', $SolRes->FK_SolResRg)
            ->first();

        $SolSer = DB::table('solicitud_residuos')
            ->join('solicitud_servicios', 'solicitud_servicios.ID_SolSer', 'solicitud_residuos.FK_SolResSolSer')
            ->select('solicitud_servicios.ID_SolSer', 'solicitud_servicios.SolSerStatus')
            ->where('solicitud_servicios.ID_SolSer', $SolRes->FK_SolResSolSer)
            ->first();

        $Programacion = ProgramacionVehiculo::where('FK_ProgServi', $SolSer->ID_SolSer)->first();

        $Fotos = DB::table('recursos')
            ->join('solicitud_residuos', 'solicitud_residuos.ID_SolRes', '=', 'recursos.FK_RecSolRes')
            ->join('solicitud_servicios', 'solicitud_servicios.ID_SolSer', '=', 'solicitud_residuos.FK_SolResSolSer')
            ->select('recursos.*', 'solicitud_residuos.SolResSlug')
            ->where('solicitud_residuos.FK_SolResSolSer', $SolSer->ID_SolSer)
            ->where('recursos.RecCarte', 'Foto')
            ->orderBy('recursos.RecTipo')
            ->get();

        $Videos = DB::table('recursos')
            ->join('solicitud_residuos', 'solicitud_residuos.ID_SolRes', '=', 'recursos.FK_RecSolRes')
            ->join('solicitud_servicios', 'solicitud_servicios.ID_SolSer', '=', 'solicitud_residuos.FK_SolResSolSer')
            ->select('recursos.*', 'solicitud_residuos.SolResSlug')
            ->where('solicitud_residuos.FK_SolResSolSer', $SolSer->ID_SolSer)
            ->where('RecCarte', 'Video')
            ->orderBy('RecTipo')
            ->get();
        return view('recursos.show', compact('Recursos', 'SolRes', 'Fotos', 'Videos', 'SolSer', 'Respel', 'Programacion'));

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecursosStoreRequest $request, $id)
    {
        $SolRes = DB::table('solicitud_residuos')
            ->join('residuos_geners', 'residuos_geners.ID_SGenerRes', 'solicitud_residuos.FK_SolResRg')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', 'residuos_geners.FK_SGener')
            ->join('generadors', 'generadors.ID_Gener', 'gener_sedes.FK_GSede')
            ->join('sedes', 'sedes.ID_Sede', 'generadors.FK_GenerCli')
            ->join('clientes', 'clientes.ID_Cli', 'sedes.FK_SedeCli')
            ->select('solicitud_residuos.ID_SolRes', 'solicitud_residuos.FK_SolResSolSer', 'clientes.CliName', 'generadors.GenerName')
            ->where('solicitud_residuos.SolResSlug', $id)
            ->first();
            
        if ($request->hasfile('RecSrc')){
            foreach($request->RecSrc as $file){
                
                
                
                $Recurso = new Recurso();
                $Recurso->RecTipo = $request->input("RecTipo");

                $name = $Recurso->RecTipo.' - '.time().$file->getClientOriginalName();
                $Src = $SolRes->CliName.' - '.$SolRes->FK_SolResSolSer;

                $Recurso->RecCarte = $request->input("RecCarte");
                $Recurso->RecRmSrc = $name;
                $Recurso->RecSrc = $Src;
                $Recurso->SlugRec = hash('sha256', rand().time().$Recurso->RecRmSrc);

                $Recurso->RecFormat = '.'.$file->extension();
                $Recurso->RecDelete = 0;
                $Recurso->FK_RecSolRes = $SolRes->ID_SolRes;
                $Recurso->save();
                $file->move(public_path('/img/Recursos/').$SolRes->CliName.' - '.$SolRes->FK_SolResSolSer,$name);

            }
        }else{
            abort(500);
        }

        return redirect()->route('recurso.show', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {   
        $Recursos = Recurso::where('SlugRec', $request->input('DeleteRec'))->first();
        $SolRes = SolicitudResiduo::select('SolResSlug')->where('ID_SolRes', $Recursos->FK_RecSolRes)->first();

        unlink(public_path("img/Recursos/$Recursos->RecSrc")."/$Recursos->RecRmSrc");
        Recurso::destroy($Recursos->ID_Rec);
        $id = $SolRes->SolResSlug;
        return redirect()->route('recurso.show', compact('id'));
    }
}
