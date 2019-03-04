<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Respel;

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
        return view('respels.create');
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
            $file->move(public_path().'/images/',$name);
        }
        else{
            $name = public_path().'/images/default.png';

        }
       
        $respel = new Respel();
        $respel->RespelName = $request->input('RespelName');
        $respel->RespelDescrip = $request->input('RespelDescrip');
        $respel->RespelClasf4741 = $request->input('RespelClasf4741');
        // $respel->RespelClasf4741 = $request->input('YRespelClasf4741');
        // $respel->RespelClasf4741 = $request->input('ARespelClasf4741');
        $respel->RespelIgrosidad = $request->input('RespelIgrosidad');
        $respel->RespelEstado = $request->input('RespelEstado');
        $respel->RespelHojaSeguridad = $name;
        $respel->RespelTarj = $request->input('RespelTarj');
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
        //
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
