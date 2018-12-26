<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Sede;
use App\Cliente;

class sclientcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $sedes = Sede::all();

        $sedes = DB::table('sedes')
            ->join('clientes', 'sedes.Cliente', '=', 'clientes.ID_Cli')
            ->select('sedes.*', 'clientes.ID_Cli', 'clientes.CliShortname', 'clientes.CliAuditable')
            ->get();

        return view('sclientes.index', compact('sedes'));


       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Clientes = Cliente::all();
        // $Sede->cliente = cliente::with('clientes')->get(); 
        return view('sclientes.create', compact('Clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Sede = new Sede();
        // if ($request->input('CliAuditable')=='on') {
        //     $Sede->CliAuditable='1';
        // }
        // else{
        //     $Sede->CliAuditable='0';
        // };
        $Sede->SedeName = $request->input('SedeName');
        $Sede->SedeAddress = $request->input('SedeAddress');
        $Sede->SedePhone1 = $request->input('SedePhone1');
        $Sede->SedeExt1 = $request->input('SedeExt1');
        $Sede->SedePhone2 = $request->input('SedePhone2');
        $Sede->SedeExt2 = $request->input('SedeExt2');
        $Sede->SedeEmail = $request->input('SedeEmail');
        $Sede->SedeCelular = $request->input('SedeCelular');
        $Sede->Cliente = $request->input('clientename');
        $Sede->SedeSlug = 'Sede-'.$request->input('SedeName');
        $Sede->save();
        return redirect()->route('sclientes.index');
        // return $testid;
        // return $request;

    }

    /**
     * Display the specified resource.
     *
     * idate(format)
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Sede = Sede::where('SedeSlug',$id)->first();

        return view('sclientes.show', compact('Sede'));
        // return $datosede;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Clientes = Cliente::select('ID_Cli','CliShortname')->get();
        
        $Sede = Sede::where('SedeSlug',$id)->first();

        return view('sclientes.edit', compact('Sede', 'Clientes'));
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
