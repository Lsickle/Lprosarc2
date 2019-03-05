<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use lprosarc\Cliente;
use App\Sede;
use App\generador;
use App\audit;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\auditController;


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
            ->join('sedes', 'Generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('Generadors.*', 'sedes.ID_Sede', 'sedes.SedeName', 'sedes.FK_SedeCli', 'clientes.CliShortname')
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
        $Gener->FK_GenerCli = $request->input('GenerCli');
        $Gener->GenerSlug = 'Gener-'.$request->input('GenerShortname');
        $Gener->save();

        $log = new audit();
        $log->AuditTabla="generadors";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Gener->ID_Gener;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
    
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
        $generadors = generador::where('GenerSlug',$id)->first();
        return view('generadores.show', compact('generadors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Sedes = Sede::select('ID_Sede','SedeName')->get();
        
        $generadors = generador::where('GenerSlug',$id)->first();

        return view('generadores.edit', compact('Sedes', 'generadors'));
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
        $generador = generador::where('GenerSlug',$id)->first();
        // return $request;
        $generador->fill($request->except('created_at'));
        if ($request->input('GenerAuditable') == 'on') {
            $generador->GenerAuditable = '1';
        }
        else{
            $generador->GenerAuditable = '0';
        };
        $generador->GenerSlug = 'Gener-'.$request->input('GenerShortname');
        $generador->FK_GenerCli = $request->input('FK_GenerCli');
        $generador->save();
        /*codigo para incluir la actualizacion en la tabla de auditoria*/
        $log = new audit();
        $log->AuditTabla="generadors";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$generador->ID_Gener;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        // return $log->Auditlog;
        return redirect()->route('Generadores.index');
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
