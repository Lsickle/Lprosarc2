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
    public function index()
    {
        // $Respels = DB::table('respels')
        //     ->join('requerimientos', 'respels.RespelReq', '=', 'requerimientos.ID_Req')
        //     ->join('declarations', 'respels.RespelDeclar', '=', 'declarations.ID_Declar')
        //     ->join('gener_sedes', 'respels.RespelGenerSede', '=', 'gener_sedes.ID_GSede')
        //     ->select('respels.*',
        //              'requerimientos.*',
        //              'declarations.*',
        //              'gener_sedes.*'
        //          )
        //     ->get();
        /*se cambio la consulta de forma temporal para probar el index*/

        $Respels = DB::table('respels')
            ->join('sedes', 'sedes.ID_Sede', '=', 'respels.FK_RespelSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('respels.*', 'clientes.CliName')
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
        // $Usuario = Auth::user()->id;

        $Sedes = DB::table('sedes')
            ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->select('sedes.*', 'clientes.*')
            ->where('clientes.ID_Cli', 1) 
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
            $name = public_path().'/img/default.png';
        }

        if ($request->hasfile('RespelTarj')) {
            $file = $request->file('RespelTarj');
            $tarj = time().$file->getClientOriginalName();
            $file->move(public_path().'/img/', $tarj);
        }
        else{
            $tarj = public_path().'/img/default.png';
        }
       
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
        $respel->save();

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Creado";
        $log->AuditRegistro=$respel->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        return redirect()->route('requerimientos.create')->with('FK', $respel->ID_Respel)->with('status', $respel->RespelName);

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
        $Respels = Respel::where('RespelSlug', $id)->first();
        
        // return $Respels->ID_Respel;
        $Requerimientos = Requerimiento::where('FK_ReqRespel',$Respels->ID_Respel)->first();   
        // return $Requerimientos;
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
            $name = public_path().'/img/default.png';
        }

        if ($request->hasfile('RespelTarj')) {
            $file = $request->file('RespelTarj');
            $tarj = time().$file->getClientOriginalName();
            $Respels->RespelTarj = $tarj;
            $file->move(public_path().'/img/', $tarj);
        }
        else{
            $tarj = public_path().'/img/default.png';
        }
        $Respels->save();

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Respels->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        // return redirect()->route('requerimientos.edit', compact('Requerimientos'));
        return redirect()->route('respels.index', compact('Requerimientos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id->delete();
        return $id;

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$Respels->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        return redirect()->route('respels.index');
    }
}
