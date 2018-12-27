<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\generador;
use App\GenerSede;

class sgenercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Gsedes = DB::table('gener_sedes')
            ->join('generadors', 'gener_sedes.Generador', '=', 'generadors.ID_Gener')
            ->select('gener_sedes.*', 'generadors.ID_Gener', 'generadors.GenerShortname', 'generadors.GenerAuditable')
            ->get();

        return view('sgeneradores.index', compact('Gsedes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $generadors = generador::all();
         return view('sgeneradores.create', compact('generadors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $GenerSede = new GenerSede();
        // if ($request->input('CliAuditable')=='on') {
        //     $GenerSede->CliAuditable='1';
        // }
        // else{
        //     $GenerSede->CliAuditable='0';
        // };
        $GenerSede->GSedeName = $request->input('GSedeName');
        $GenerSede->GSedeAddress = $request->input('GSedeAddress');
        $GenerSede->GSedePhone1 = $request->input('GSedePhone1');
        $GenerSede->GSedeExt1 = $request->input('GSedeExt1');
        $GenerSede->GSedePhone2 = $request->input('GSedePhone2');
        $GenerSede->GSedeExt2 = $request->input('GSedeExt2');
        $GenerSede->GSedeEmail = $request->input('GSedeEmail');
        $GenerSede->GSedeCelular = $request->input('GSedeCelular');
        $GenerSede->Generador = $request->input('generadorname');
        $GenerSede->GSedeSlug = 'GSede-'.$request->input('GSedeName');
        $GenerSede->save();
        return redirect()->route('sgeneradores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $GSede = GenerSede::where('GSedeSlug',$id)->first();

        return view('sgeneradores.show', compact('GSede'));
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
        $generadores = generador::select('ID_Gener','GenerShortname')->get();
        
        $GSede = GenerSede::where('GSedeSlug',$id)->first();

        return view('sgeneradores.edit', compact('GSede', 'generadores'));
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
        $GSede = GenerSede::where('GSedeSlug',$id)->first();
        $GSede->fill($request->except('created_at'));
        $GSede->Generador = $request->input('genername');
        $GSede->save();
        return redirect()->route('sgeneradores.index');
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
