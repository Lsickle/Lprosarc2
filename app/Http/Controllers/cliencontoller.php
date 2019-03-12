<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;
use App\audit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\auditController;

class clientcontoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->UsRol === "Programador"){
            $clientes = Cliente::all();
            return view('clientes.index', compact('clientes'));
        }
        $clientes = Cliente::where('CliDelete', 0)->get();

        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Cliente = new Cliente();
        $Cliente->CliNit = $request->input('CliNit');
        $Cliente->CliName = $request->input('CliName');
        $Cliente->CliShortname = $request->input('CliShortname');
        $Cliente->CliCategoria = $request->input('CliCategoria');
        $Cliente->CliType = $request->input('CliType');
        $Cliente->CliAuditable = $request->input('CliAuditable');
        $Cliente->CliSlug = 'Cli-'.$request->input('CliShortname');
        $Cliente->save();

        $log = new audit();
        $log->AuditTabla="clientes";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Cliente->ID_Cli;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('clientes.index');
        // return 'Saved';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
        return view('clientes.show', compact('cliente'));
        // return $cliente;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {   
        $cliente->fill($request->except('created_at'));
        $cliente->CliAuditable = $request->input('CliAuditable');
        $cliente->save();
        /*codigo para incluir la actualizacion en la tabla de auditoria*/
        $log = new audit();
        $log->AuditTabla="clientes";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$cliente->ID_Cli;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();
        // return $log->Auditlog;
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id, Cliente $cliente)
    public function destroy($id){
        $Cliente = Cliente::where('CliSlug', $id)->first();
            if ($Cliente->CliDelete == 0) {
                $Cliente->CliDelete = 1;
            }
            else{
                $Cliente->CliDelete = 0;
            }
        $Cliente->save();
        

        $log = new audit();
        $log->AuditTabla="clientes";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$Cliente->ID_Cli;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog = $Cliente->CliDelete;
        $log->save();

        return redirect()->route('clientes.index');

    }
}
