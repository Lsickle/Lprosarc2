<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sede;
use App\generador;
use App\cliente;
use App\audit;
use App\Departamento;
use App\Municipio;

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
            ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
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
        $Clientes = cliente::all();
        $Departamentos = Departamento::all();
        // $Municipios = Municipio::where('FK_MunCity', '=', 'ID_Depart')->first();
        $Municipios = Municipio::all();

        // $Sede->cliente = cliente::with('clientes')->get(); 
        return view('sclientes.create', compact('Clientes', 'Departamentos', 'Municipios'));
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
        $Sede->SedeSlug = 'Sede-'.$request->input('SedeName');
        $Sede->FK_SedeCli = $request->input('clientename');
        $Sede->FK_SedeMun = $request->input('FK_SedeMun');        
        $Sede->save();

        $log = new audit();
        $log->AuditTabla="sedes";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Sede->ID_Sede;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

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

        $Departamentos = Departamento::all();

        // $Municipios = Municipio::where('FK_MunCity', '=', 'ID_Depart')->first();
        $Municipios = Municipio::all();

        return view('sclientes.edit', compact('Sede', 'Clientes', 'Departamentos', 'Municipios'));
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
        $Sede = Sede::where('SedeSlug',$id)->first();
        $Sede->fill($request->except('created_at'));
        $Sede->SedeExt2 = $request->input('SedeExt2');
        $Sede->FK_SedeCli = $request->input('clientename');
        $Sede->FK_SedeMun = $request->input('FK_SedeMun');
        $Sede->save();

        $log = new audit();
        $log->AuditTabla="sedes";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Sede->ID_Sede;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('sclientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        //$id->delete();
        // Sede::find($id)->delete();
        // cliente::find($id)->delete();
        
        $log = new audit();
        $log->AuditTabla="sedes";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$Sede->ID_Sede;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('sclientes.index');
    }
}
