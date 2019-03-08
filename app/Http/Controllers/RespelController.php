<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Respel;
use App\GenerSede;
use Illuminate\Support\Facades\Auth;
use App\audit;

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
            ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'respels.FK_RespelGenerSede')
            ->join('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            ->select('respels.*', 'generadors.GenerName')
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
        $GSedes = DB::table('gener_sedes')
            ->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
            ->select('gener_sedes.*', 'generadors.*')
            // ->where('gener_sedes.FK_GSede', '=', 'generadors.ID_Gener') 
            ->get();
        return view('respels.create', compact('GSedes'));
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
            $file->move(public_path().'/images/', $name);
        }
        else{
            $name = public_path().'/images/default.png';
        }

        if ($request->hasfile('RespelTarj')) {
            $file = $request->file('RespelTarj');
            $tarj = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $tarj);
        }
        else{
            $tarj = public_path().'/images/default.png';
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
        $respel->FK_RespelGenerSede = $request->input('FK_RespelGenerSede');
        $respel->RespelSlug = "slug".$request->input('RespelName');
        $respel->save();

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Creado";
        $log->AuditRegistro=$respel->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        // return $respel;
        return redirect()->route('requerimientos.create')->with('status', $request->input('RespelName'))->with('FK',  $respel->RespelSlug);

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
        $Respels = Respel::all();  
        $GSedes = GenerSede::all();

        return view('respels.edit', compact('Respels', 'GSedes'));
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
        $Respels->fill($request->all());
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
