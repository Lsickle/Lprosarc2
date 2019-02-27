<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SolicitudServicio;


class SolicitudServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Servicios = DB::table('solicitud_servicios')
        ->select('solicitud_servicios.*')
        ->get();
        return view('solicitud.indexServicio', compact('Servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('solicitud.createServicio');                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Servicios = DB::table('solicitud_servicios')
        ->select('solicitud_servicios.*')
        ->get();

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = $request->input('Estado');
        $Servicio->SolSerTipo = $request->input('Tipo');

        if($request->input('auditable') == 'on'){
            $Servicio->SolSerAuditable = '1';
        }else{
            $Servicio->SolSerAuditable = '0';
        }

        $Servicio->SolSerFrecuencia = $request->input('Frecuencia');
        $Servicio->SolSerConducExter = $request->input('conductor');
        $Servicio->SolSerVehicExter = $request->input('placa');
        $Servicio->Fk_SolSerTransportador = 1;
        $Servicio->FK_SolSerGenerSede = 1;
        $aumento = 1;
        $Servicio->SolSerSlug = 0;
            if ($Servicio->SolSerSlug <> $aumento){
                while($aumento <> $Servicio->SolSerSlug){
                    $aumento1 = $aumento++;
                    $Servicio->SolSerSlug = $aumento1;};
            }else{
                    
                        $Servicio->SolSerSlug = $aumento;
                     
                    
            }
        $Servicio->save();

        return view('solicitud.indexServicio', compact('Servicios'));
        // return redirect()->route('solicitud.indexServicio');

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
