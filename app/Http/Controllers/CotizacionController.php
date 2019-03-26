<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('ordenCompra/cotizacion');

        if(Auth::user()->UsRol === "Programador"){
            $cotizaciones = DB::table('cotizacions')
                ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('cotizacions.*', 'sedes.*', 'clientes.*', 'municipios.*', 'departamentos.*')
                ->get();
        }
        else{
            // $cotizaciones = DB::table('cotizacions')
            //     ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
            //     ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            //     ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
            //     ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
            //     ->select('cotizacions.*', 'sedes.*', 'clientes.*', 'clientes.*','municipios.*', 'departamentos.*')
            //     ->get();
        }
        // return $cotizaciones;
        return view('cotizacion.index', compact('cotizaciones'));
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
