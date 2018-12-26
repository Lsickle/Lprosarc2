<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use lprosarc\Cliente;
use App\Sede;
use App\generador;


class genercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $sedes = DB::table('sedes')
        //     ->join('clientes', 'sedes.Cliente', '=', 'clientes.ID_Cli')
        //     ->select('sedes.*', 'clientes.ID_Cli', 'clientes.CliShortname', 'clientes.CliAuditable')
        //     ->get();

        $Generadors = DB::table('Generadors')
            ->join('sedes', 'Generadors.GenerCli', '=', 'sedes.ID_Sede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.ID_Sede')
            ->select('Generadors.*', 'sedes.ID_Sede', 'sedes.SedeName', 'sedes.Cliente', 'clientes.CliShortname')
            ->get();
        // $Generadors = generador::all();
        return view('generadores.index', compact('Generadors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Sedes = Sede::all();
        return view('generadores.create', compact('Sedes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Gener = new generador();
        if ($request->input('GenerAuditable')=='on') {
            $Gener->GenerAuditable='1';
        }
        else{
            $Gener->GenerAuditable='0';
        };
        $Gener->GenerNit = $request->input('GenerNit');
        $Gener->GenerName = $request->input('GenerName');
        $Gener->GenerShortname = $request->input('GenerShortname');
        $Gener->GenerType = $request->input('GenerType');
        $Gener->GenerCli = $request->input('GenerCli');
        $Gener->GenerSlug = 'Gener-'.$request->input('GenerShortname');
        $Gener->save();
        return redirect()->route('Generadores.index');
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
