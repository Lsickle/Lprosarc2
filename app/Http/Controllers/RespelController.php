<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Respel;
use App\Sede;
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
        $Respels = Respel::all();  

        return view('respels.index', compact('Respels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $Sedes = DB::table('sedes')
        //     ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
        //     ->select('sedes.*', 'clientes.*')
        //     // ->where('FK_SedeCli', '=', 'ID_Cli')
        //     ->get();
        $Sedes = Sede::all();  

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

        // return $request;

         if ($request->hasfile('RespelHojaSeguridad')) {
            $file = $request->file('RespelHojaSeguridad');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
        }
        else{
            $name = public_path().'/images/default.png';

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
        $respel->RespelTarj = 1;
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
        $Sedes = Sede::all();  
        $Respels = Respel::all();  

        return view('respels.edit', compact('Sedes', 'Respels'));
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

        // return $id;

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
        //
    }
}
