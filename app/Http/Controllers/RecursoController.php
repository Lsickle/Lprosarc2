<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;  
use App\audit;
use App\Recurso;
use App\cliente;
use App\SolicitudResiduo;

class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Recursos = DB::table('solicitud_servicios')
            ->join('solicitud_residuos', 'solicitud_residuos.FK_SolResSolSer', 'solicitud_servicios.ID_SolSer')
            ->join('recursos', 'recursos.FK_RecSolRes', 'solicitud_residuos.ID_SolRes')
            ->get();

        return view('recursos.index', compact('Recursos'));
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
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.JefeLogistica') || Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno')){

        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();

        $Respel = DB::table('solicitud_residuos')
            ->join('residuos_geners', 'residuos_geners.ID_SGenerRes', 'solicitud_residuos.FK_SolResRg')
            ->join('respels', 'respels.ID_Respel', 'residuos_geners.FK_Respel')
            ->select('respels.RespelName')
            ->where('residuos_geners.ID_SGenerRes', $SolRes->FK_SolResRg)
            ->first();
        
        $SolSer = DB::table('solicitud_residuos')
            ->join('solicitud_servicios', 'solicitud_servicios.ID_SolSer', 'solicitud_residuos.FK_SolResSolSer')
            // ->join('progvehiculos', 'progvehiculos.FK_ProgServi', 'solicitud_servicios.ID_SolSer')
            ->select('solicitud_servicios.ID_SolSer', 'solicitud_servicios.SolSerStatus')
            ->where('solicitud_servicios.ID_SolSer', $SolRes->FK_SolResSolSer)
            ->first();

        $Fotos = DB::table('recursos')
            ->join('solicitud_residuos', 'solicitud_residuos.ID_SolRes', '=', 'recursos.FK_RecSolRes')
            ->select('recursos.*', 'solicitud_residuos.SolResSlug')
            ->where('FK_RecSolRes', $SolRes->ID_SolRes)
            ->where('RecCarte', 'Foto')
            ->orderBy('RecTipo')
            ->get();

        $Videos = DB::table('recursos')
            ->join('solicitud_residuos', 'solicitud_residuos.ID_SolRes', '=', 'recursos.FK_RecSolRes')
            ->select('recursos.*', 'solicitud_residuos.SolResSlug')
            ->where('FK_RecSolRes', $SolRes->ID_SolRes)
            ->where('RecCarte', 'Video')
            ->orderBy('RecTipo')
            ->get();

        return view('recursos.show', compact('Recursos', 'SolRes', 'Fotos', 'Videos', 'SolSer', 'Respel'));
        }else{
            abort(403);
        }

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
    public function update(Request $request, $id)
    {
        $SolRes = DB::table('solicitud_residuos')
            ->join('residuos_geners', 'residuos_geners.ID_SGenerRes', 'solicitud_residuos.FK_SolResRg')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', 'residuos_geners.FK_SGener')
            ->join('generadors', 'generadors.ID_Gener', 'gener_sedes.FK_GSede')
            ->join('sedes', 'sedes.ID_Sede', 'generadors.FK_GenerCli')
            ->join('clientes', 'clientes.ID_Cli', 'sedes.FK_SedeCli')
            ->select('solicitud_residuos.ID_SolRes', 'clientes.CliName', 'generadors.GenerName')
            ->where('solicitud_residuos.SolResSlug', $id)
            ->first();
            
        if ($request->hasfile('RecSrc')){
            foreach($request->RecSrc as $file){ 
                
                $name = time().$file->getClientOriginalName();
                $Extension = $file->extension();
                $file->move(public_path('/img/Recursos/').$SolRes->CliName.$SolRes->ID_SolRes,$name);
                $Src = $SolRes->CliName.$SolRes->ID_SolRes;
                
                // $Recurso->RecName = $request->input("RecName");
                $Recurso = new Recurso();
                $Recurso->RecTipo = $request->input("RecTipo");
                $Recurso->RecCarte = $request->input("RecCarte");
                $Recurso->RecRmSrc = $name;
                $Recurso->RecSrc = $Src;
                $Recurso->SlugRec = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc S.A ESP.".substr(md5(rand()), 0,32);

                $Recurso->RecFormat = '.'.$Extension;
                $Recurso->RecDelete = 0;
                $Recurso->FK_RecSolRes = $SolRes->ID_SolRes;
                $Recurso->save();
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
