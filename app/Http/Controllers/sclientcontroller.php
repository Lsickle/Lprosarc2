<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sclientcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = sede::all();
        return view('sclientes.index', compact('sedes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $Sede->cliente = cliente::with('clientes')->get(); 
        return view('sclientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Sede = new sede();
        if ($request->input('CliAuditable')=='on') {
            $Sede->CliAuditable='1';
        }
        else{
            $Sede->CliAuditable='0';
        };
        $Sede->CliNit = $request->input('CliNit');
        $Sede->CliName = $request->input('CliName');
        $Sede->CliShortname = $request->input('CliShortname');
        $Sede->CliCategoria = $request->input('CliCategoria');
        $Sede->CliType = $request->input('CliType');
        $Sede->CliSlug = 'Cli-'.$request->input('CliShortname');
        $Sede->save();
        return redirect()->route('clientes.index');

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
