<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;
use App\audit;
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
        $clientes = Cliente::all();
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
        //  if ($request->hasfile('avatar')) {
        //     $file = $request->file('avatar');
        //     $name = time().$file->getClientOriginalName();
        //     $file->move(public_path().'/images/',$name);
        // }
        // else{
        //     $name = public_path().'/images/default.jpg';

        // }
        // if (empty($request->input('description'))){
        //     $desc='descripcion generada automaticamente';
        // }else{
        //     $desc=$request->input('description');
        // }
        // if (empty($request->input('slug'))){
        //     $slug=$request->input('name');
        // }else{
        //     $slug=$request->input('slug');
        // }
        $Cliente = new Cliente();
        if ($request->input('CliAuditable')=='on') {
            $Cliente->CliAuditable='1';
        }
        else{
            $Cliente->CliAuditable='0';
        };
        $Cliente->CliNit = $request->input('CliNit');
        $Cliente->CliName = $request->input('CliName');
        $Cliente->CliShortname = $request->input('CliShortname');
        $Cliente->CliCategoria = $request->input('CliCategoria');
        $Cliente->CliType = $request->input('CliType');
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
        if ($request->CliAuditable=='on') {
            $cliente->CliAuditable='1';
        }
        else{
            $cliente->CliAuditable='0';
        };
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
    public function destroy($id)
    {
        $id->delete();
        // $cliente->delete();
        // return $cliente;
        return $id;

        $log = new audit();
        $log->AuditTabla="clientes";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$cliente->ID_Cli;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        return redirect()->route('clientes.index');

    }
}
