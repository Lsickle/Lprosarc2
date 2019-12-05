<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $certificados = Certificado::all();

        return view('certificados.index', compact('certificados')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // $SolicitudServicio = SolicitudServicio::where('SolSerSlug', $id)->first();
        // if (!$SolicitudServicio) {
        //     abort(404);
        // }
        // $certificado = new Certificado;
        // $certificado->CertNumero = '';
        // $certificado->CertiEspName = '';
        // $certificado->CertiEspValue = '';
        // $certificado->CertObservacion = '';
        // $certificado->CertSrc = '';
        // $certificado->CertAuthJo = '';
        // $certificado->CertAuthJl = '';
        // $certificado->CertAuthDp = '';
        // $certificado->CertAnexo = '';
        // $certificado->FK_CertSolser = $SolicitudServicio->ID_SolSer;
        // $certificado->save();

        // $certificado->CertNumero = $certificado->ID_SolSer;
        // $certificado->update();


        // return view('certificados.edit', compact('SolicitudServicio')); 

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
        $certificado = Certificado::where('CertSlug', $id)->first();
        return view('certificados.show', compact('certificado')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificado = Certificado::where('CertSlug', $id)->first();
        return view('certificados.edit', compact('certificado')); 
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

    public function firmar($id, $servicio)
    {
        $certificado = Certificado::where('CertSlug', $id)->first();
        switch (Auth::user()->UsRol) {
            case 'Hseq':
                $certificado->CertAuthHseq = 1;
                break;

            case 'JefeOperaciones':
                $certificado->CertAuthJo = 1;
                break;

            case 'JefeLogistica':
                $certificado->CertAuthJl = 1;
                break;

            case 'AdministradorPlanta':
                $certificado->CertAuthDp = 1;
                break;

            case 'Programador':
                $certificado->CertAuthHseq = 1;
                break;
            
            default:
                # code...
                break;
        }
        $certificado->save();
        return redirect()->route('solicitud-servicio.documentos', [$servicio]);
    }
}
