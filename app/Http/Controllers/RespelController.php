<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\audit;
use App\Respel;
use App\Sede;
use App\User;
use App\Requerimiento;

class RespelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){ 

    if(Auth::user()->UsRol === "Programador"){

        $Respels = DB::table('respels')
        ->join('sedes', 'sedes.ID_Sede', '=', 'respels.FK_RespelSede')
        ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
        ->select('respels.*', 'clientes.CliName')
        ->get();

        return view('respels.index', compact('Respels'));
    }
    $Respels = DB::table('respels')
        ->join('sedes', 'sedes.ID_Sede', '=', 'respels.FK_RespelSede')
        ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
        ->select('respels.*', 'clientes.CliName')
        ->where('respels.RespelDelete',0)
        ->get();
    
        return view('respels.index', compact('Respels')); 
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $Usuario -= Auth::user()->id;
        $Sedes = DB::table('sedes')
            ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->select('sedes.*', 'clientes.*')
            // ->where('clientes.ID_Cli', 1) 
            ->get();

        return view('respels.create', compact('Sedes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if ($request->hasfile('RespelHojaSeguridad')) {
            $file = $request->file('RespelHojaSeguridad');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/img/', $name);
        }
        else{
            $name = '';
        }

        if ($request->hasfile('RespelTarj')) {
            $file = $request->file('RespelTarj');
            $tarj = time().$file->getClientOriginalName();
            $file->move(public_path().'/img/', $tarj);
        }
        else{
            $tarj = '';
        }
        // if(empty($request->hasfile('RespelHojaSeguridad')) and empty($request->hasfile('RespelHojaSeguridad'))){
        //     // echo "Inserte La tarjeta de seguridad o la hoja de seguridad";
        //     "<script>
        //         alert('Inserte La tarjeta de seguridad o la hoja de seguridad');
        //     </script>";
            
        //     return redirect()->route('respels.create');
        //     exit;
        // }

        $respel = new Respel();
        $respel->RespelName = $request->input('RespelName');
        $respel->RespelDescrip = $request->input('RespelDescrip');
        // $respel->RespelClasf4741 = $request->input('RespelClasf4741');
        $respel->YRespelClasf4741 = $request->input('YRespelClasf4741');
        $respel->ARespelClasf4741 = $request->input('ARespelClasf4741');
        $respel->RespelIgrosidad = $request->input('RespelIgrosidad');
        $respel->RespelStatus = $request->input('RespelStatus');
        $respel->RespelEstado = $request->input('RespelEstado');
        $respel->RespelHojaSeguridad = $name;
        $respel->RespelTarj = $tarj;
        $respel->FK_RespelSede = $request->input('FK_RespelSede');
        $respel->RespelSlug = "slug".$request->input('RespelName');
        $respel->RespelDelete = 0;
        $respel->save();

        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoCargue = NULL;
        $Requerimiento->ReqFotoDescargue = NULL;
        $Requerimiento->ReqFotoPesaje = NULL;
        $Requerimiento->ReqFotoReempacado = NULL;
        $Requerimiento->ReqFotoMezclado = NULL;
        $Requerimiento->ReqFotoDestruccion = NULL;

        $Requerimiento->ReqVideoCargue = NULL;
        $Requerimiento->ReqVideoDescargue = NULL;
        $Requerimiento->ReqVideoPesaje = NULL;
        $Requerimiento->ReqVideoReempacado = NULL;
        $Requerimiento->ReqVideoMezclado = NULL;
        $Requerimiento->ReqVideoDestruccion = NULL;

        $Requerimiento->ReqAuditoria = NULL;
        $Requerimiento->ReqAuditoriaTipo = NULL;
        $Requerimiento->ReqDevolucion = NULL;
        $Requerimiento->ReqDevolucionTipo = NULL;
        $Requerimiento->ReqDatosPersonal = NULL;
        $Requerimiento->ReqPlanillas = NULL;
        $Requerimiento->ReqAlistamiento = NULL;
        $Requerimiento->ReqCapacitacion = NULL;
        $Requerimiento->ReqBascula = NULL;
        $Requerimiento->ReqMasPerson = NULL;
        $Requerimiento->ReqPlatform = NULL;
        $Requerimiento->ReqCertiEspecial = NULL;
        $Requerimiento->ReqSlug = 'ReqSlug'.$request->input('RespelName');
        $Requerimiento->FK_ReqRespel = $respel->ID_Respel;
        $Requerimiento->save();

        return redirect()->route('respels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        $Respels = DB::table('respels')
        ->join('sedes', 'sedes.ID_Sede', '=', 'respels.FK_RespelSede')
        ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
        ->select('respels.*', 'clientes.*', 'sedes.*')
        ->where('respels.RespelSlug', '=', $id)
        ->get();
        // return $Respels;

        return view('respels.show', compact('Respels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Respels = Respel::where('RespelSlug', $id)->first();
        
        $Requerimientos = Requerimiento::where('FK_ReqRespel',$Respels->ID_Respel)->first();   
        
        $Sedes = Sede::all();

        return view('respels.edit', compact('Respels', 'Sedes', 'Requerimientos'));
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
        $Respels = Respel::where('ID_Respel', $id)->first();
        $Requerimientos = Requerimiento::where('FK_ReqRespel', $id)->first();
        $Respels->fill($request->except('RespelTarj', 'RespelHojaSeguridad'));
        
        if ($request->hasfile('RespelHojaSeguridad')) {
            $file = $request->file('RespelHojaSeguridad');
            $name = time().$file->getClientOriginalName();
            $Respels->RespelHojaSeguridad = $name;
            $file->move(public_path().'/img/', $name);
        }
        else{
            // $name = public_path().'/img/default.png';
            $name = "";
        }

        if ($request->hasfile('RespelTarj')) {
            $file = $request->file('RespelTarj');
            $tarj = time().$file->getClientOriginalName();
            $Respels->RespelTarj = $tarj;
            $file->move(public_path().'/img/', $tarj);
        }
        else{
            // $tarj = public_path().'/img/default.png';
            $tarj = "";
        }

        $Respels->save();

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Respels->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        return redirect()->route('respels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Respels = Respel::where('RespelSlug', $id)->first();
        if ($Respels->RespelDelete == 0) {
            $Respels->RespelDelete = 1;
        }
        else{
            $Respels->RespelDelete = 0;
        }
        $Respels->save();

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$Respels->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$Respels->RespelDelete;
        $log->save();

        return redirect()->route('respels.index');
    }
}
