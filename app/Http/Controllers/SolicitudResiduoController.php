<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SolicitudResiduo;

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
            ->select('*')
            ->get();
        return view('solicitud.indexResiduo', compact('Residuos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('solicitud.createResiduo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Residuos = DB::table('solicitud_residuos')
            ->select('solicitud_residuos.*')
            ->get();

        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = $request->input('enviado');
        $Residuo->SolResKgRecibido = $request->input('resibido');
        $Residuo->SolResKgConciliado = $request->input('conciliado');
        $Residuo->SolResKgTratado = $request->input('tratado');
        $Residuo->SolResRespel = 1;
        $Residuo->SolResSolSer = 1;
        $Residuo->save();

        return view('solicitud.indexResiduo', compact('Residuos'));
        // return view('solicitud.indexResiduo');
        // return redirect()->route('solicitud.indexResiduo');        
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
