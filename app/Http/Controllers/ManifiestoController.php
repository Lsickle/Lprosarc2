<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Manifiesto;
use Illuminate\Support\Facades\DB;


class ManifiestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manifiestos = Manifiesto::all();

        return view('manifiestos.index', compact('manifiestos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manifiesto = Manifiesto::where('ManifSlug', $id)->first();
        return view('manifiestos.show', compact('manifiesto')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manifiesto = Manifiesto::where('ManifSlug', $id)->first();
        return view('manifiestos.edit', compact('manifiesto')); 
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
        $manifiesto = Manifiesto::where('ManifSlug', $id)->first();
        switch (Auth::user()->UsRol) {
            case 'Hseq':
                $manifiesto->ManifAuthHseq = 1;
                break;

            case 'JefeOperaciones':
                $manifiesto->ManifAuthJo = 1;
                break;

            case 'JefeLogistica':
                $manifiesto->ManifAuthJl = 1;
                break;

            case 'AdministradorPlanta':
                $manifiesto->ManifAuthDp = 1;
                break;

            case 'Programador':
                $manifiesto->ManifAuthHseq = 1;
                break;
            
            default:
                # code...
                break;
        }
        $manifiesto->save();
        return redirect()->route('solicitud-servicio.documentos', [$servicio]);
    }
}
