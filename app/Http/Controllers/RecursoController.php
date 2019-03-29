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
        $Recursos = DB::table('solicitud_residuos')
            ->join('respels', 'respels.ID_Respel', '=', 'solicitud_residuos.FK_SolResRespel')
            ->select('respels.RespelName', 'solicitud_residuos.FK_SolResSolSer', 'solicitud_residuos.SolResSlug')
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
        $Clientes = cliente::all();

        $SolRes = DB::table('solicitud_residuos')
        ->join('respels', 'respels.ID_Respel', '=', 'solicitud_residuos.FK_SolResRespel')
        ->select('respels.RespelName', 'solicitud_residuos.FK_SolResSolSer', 'solicitud_residuos.ID_SolRes')
        ->get();

        return view('recursos.create', compact('SolRes', 'Clientes', 'Recursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasfile('RecSrc')){
            foreach($request->RecSrc as $file){ 
            
            $Recurso = new Recurso();
            
            $name = time().$file->getClientOriginalName();
            $Extension = $file->extension();
            $file->move(public_path('/Recursos/').$request->input("RecName").time(),$name);
            $Src = 'Recursos/'.$request->input("RecName").time();
            
            $Recurso->RecName = $request->input("RecName");
            $Recurso->RecTipo = $request->input("RecTipo");
            $Recurso->RecCarte = $request->input("RecCarte");
            $Recurso->RecRmSrc = $name;
            $Recurso->SlugRec = 'Slug'.$name;
            $Recurso->RecSrc = $Src;
            $Recurso->RecFormat = '.'.$Extension;
            $Recurso->RecDelete = 0;
            $Recurso->FK_RecSolRes = $request->input("FK_RecSolRes");
            $Recurso->save();
            }
        }
        return redirect()->route('recurso.index');
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

        $Recursos = DB::table('recursos')
            ->join('solicitud_residuos', 'solicitud_residuos.ID_SolRes', '=', 'recursos.FK_RecSolRes')
            ->select('recursos.*', 'solicitud_residuos.SolResSlug')
            ->where('FK_RecSolRes', $SolRes->ID_SolRes)
            ->get();

        return view('recursos.show', compact('Recursos', 'SolRes'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SolResiduos = DB::table('solicitud_residuos')
        ->join('respels', 'respels.ID_Respel', '=', 'solicitud_residuos.FK_SolResRespel')
        ->select('respels.RespelName', 'solicitud_residuos.ID_SolRes', 'solicitud_residuos.FK_SolResSolSer')
        ->get();

        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
        $Recs = Recurso::where('FK_RecSolRes', $SolRes->ID_SolRes)->first();

        $Clientes = cliente::all();

        $Recursos = DB::table('recursos')
            ->join('solicitud_residuos', 'solicitud_residuos.ID_SolRes', '=', 'recursos.FK_RecSolRes')
            ->select('recursos.*', 'solicitud_residuos.SolResSlug', 'solicitud_residuos.FK_SolResSolSer', 'solicitud_residuos.ID_SolRes')
            ->where('FK_RecSolRes',  $SolRes->ID_SolRes)
            ->get();
        
        return view('recursos.edit', compact('SolResiduos', 'Clientes', 'SolRes', 'Recursos', 'Recs'));
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
        // edit
        if($request->input("number") == 0){
            $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
            $Recursos = Recurso::where('FK_RecSolRes', $SolRes->ID_SolRes)->first();
            
            // modificar el nombre de la carpeta
            rename(public_path($Recursos->RecSrc), 'Recursos/'.$request->input("RecName").time());

            $Recurso = Recurso::where('FK_RecSolRes',$SolRes->ID_SolRes)->update([
                    'RecName' => $request->input("RecName"),
                    'RecSrc' => 'Recursos/'.$request->input("RecName").time(), 
                    'FK_RecSolRes' => $request->input("FK_RecSolRes")
                ]);

            $log = new audit();
            $log->AuditTabla="recursos";
            $log->AuditType="Modificado";
            $log->AuditRegistro = $Recursos->FK_RecSolRes;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog=$request->all();
            $log->save();

        // return redirect()->route('recurso.index');
        }
        // modal en show
        if($request->input("number") == 1){
            $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
            $Recursos = Recurso::where('FK_RecSolRes', $SolRes->ID_SolRes)->first();

            if ($request->hasfile('RecSrc')) {
                foreach($request->RecSrc as $file){ 
                
                $Recurso = new Recurso();
                
                $Recurso->RecTipo = $request->input("RecTipo");
                $Recurso->RecCarte = $request->input("RecCarte");
                $Recurso->RecName = $Recursos->RecName;
                
                $name = time().$file->getClientOriginalName();
                $Extension = $file->extension();
                $file->move(public_path($Recursos->RecSrc),$name);

                $Recurso->RecRmSrc = $name;
                $Recurso->SlugRec = 'Slug'.$name;
                $Recurso->RecSrc = $Recursos->RecSrc;
                $Recurso->RecFormat = '.'.$Extension;
                $Recurso->FK_RecSolRes = $Recursos->FK_RecSolRes;
                $Recurso->RecDelete = $Recursos->RecDelete;
                $Recurso->save();
                }
            }
        // return redirect()->route('recurso.show');
        }
        return redirect()->route('recurso.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {   
        if($request->input("number") == 0){
            $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
            $Recs = Recurso::where('FK_RecSolRes', $SolRes->ID_SolRes)->first();
    
            $Recursos = DB::table('recursos')
                ->join('solicitud_residuos', 'solicitud_residuos.ID_SolRes', '=', 'recursos.FK_RecSolRes')
                ->select('recursos.*', 'solicitud_residuos.SolResSlug', 'solicitud_residuos.FK_SolResSolSer', 'solicitud_residuos.ID_SolRes')
                ->where('FK_RecSolRes',  $SolRes->ID_SolRes)
                ->get();

            foreach($Recursos as $Recurso){
                if ($Recurso->RecDelete == 0){
                    $Rec = Recurso::where('FK_RecSolRes',$SolRes->ID_SolRes)->update(['RecDelete' => 1]);
                }
                else{
                    $Rec = Recurso::where('FK_RecSolRes',$SolRes->ID_SolRes)->update(['RecDelete' => 0]);
                }
            }        
            $log = new audit();
            $log->AuditTabla = "recursos";
            $log->AuditType = "Eliminado";
            $log->AuditRegistro = $Recs->FK_RecSolRes;
            $log->AuditUser = Auth::user()->email;
            $log->Auditlog = $Rec;
            $log->save();
        }

        if($request->input("number") == 1){
            $Recursos = Recurso::where('ID_Rec', $id)->first();
            unlink(public_path($Recursos->RecSrc)."/".$Recursos->RecRmSrc);
            Recurso::destroy($id);
        }
        return redirect()->route('recurso.index');
    }
}
