<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Certificado;
use App\SolicitudServicio;


class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Certificados = DB::table('certificados')
            ->select('certificados.*')
            ->get();
        return view('resivos.indexCertificado', compact('Certificados')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $SolicitudServicio = SolicitudServicio::where('SolSerSlug', $id)->first();
        if (!$SolicitudServicio) {
            abort(404);
        }
        $certificado = new Certificado;
        $certificado->CertNumero = '';
        $certificado->CertiEspName = '';
        $certificado->CertiEspValue = '';
        $certificado->CertObservacion = '';
        $certificado->CertSrc = '';
        $certificado->CertAuthJo = '';
        $certificado->CertAuthJl = '';
        $certificado->CertAuthDp = '';
        $certificado->CertAnexo = '';
        $certificado->FK_CertSolser = $SolicitudServicio->ID_SolSer;
        $certificado->save();

        $certificado->CertNumero = $certificado->ID_SolSer;
        $certificado->update();


        return view('certificados.edit', compact('SolicitudServicio')); 

        // return redirect()->route('solicitud-servicio.solservdocindex', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $SolicitudServicio = SolicitudServicio::where('SolSerSlug', $id)->first();
        if (!$SolicitudServicio) {
            abort(404);
        }
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
