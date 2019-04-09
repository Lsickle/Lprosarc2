<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;
use App\Municipio;
use App\Cliente;
use App\audit;
use App\sede;
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
            $clientes = Cliente::where('CliDelete', 0)->get();
            return view('clientes.index', compact('clientes'));
        }
        if(Auth::user()->UsRol === "Cliente"){
           return redirect()->route('sclientes.index');
        }
        // if(Auth::user()->UsRol === "Cliente"){
        //     $cliente = Cientes::where()
        // }
        
        
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->UsRol === "Cliente"){
            if(isset($_REQUEST['Departamento'])){

                $Municipios = Municipio::where('FK_MunCity', $_REQUEST['Departamento']);
            }else{
                echo "Null";
                $Municipios = Municipio::where('FK_MunCity', 0);
            }
            // $Municipios = Municipio::all();
            $Departamentos = Departamento::all();
           
            return view('clientes.create2', compact('Departamentos', 'Municipios', 'Departamento'));
        }else{
            return view('clientes.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        if($request->input("number") == "1"){

            $Cliente = new Cliente();
            $Cliente->CliNit = $request->input('CliNit');
            $Cliente->CliName = $request->input('CliName');
            $Cliente->CliShortname = $request->input('CliShortname');
            $Cliente->CliCategoria = 'Cliente';
            // $Cliente->CliType = NULL;
            $Cliente->CliSlug = 'Cli-'.$request->input('CliShortname');
            $Cliente->CliDelete = '0';
            $Cliente->save();

            $Sede = new Sede();
            $Sede->SedeName = $request->input('SedeName');
            $Sede->SedeAddress = $request->input('SedeAddress');
            $Sede->SedePhone1 = $request->input('SedePhone1');
            $Sede->SedeExt1 = $request->input('SedeExt1');
            $Sede->SedePhone2 = $request->input('SedePhone2');
            $Sede->SedeExt2 = $request->input('SedeExt2');
            $Sede->SedeEmail = $request->input('SedeEmail');
            $Sede->SedeCelular = $request->input('SedeCelular');
            $Sede->SedeSlug = 'Sede-'.$request->input('SedeName');
            $Sede->FK_SedeCli = $Cliente->ID_Cli;
            $Sede->FK_SedeMun = $request->input('FK_SedeMun');
            $Sede->SedeDelete = 0;
            $Sede->save();

            return redirect()->route('clientes.index');

        }else{

        $Cliente = new Cliente();
        $Cliente->CliNit = $request->input('CliNit');
        $Cliente->CliName = $request->input('CliName');
        $Cliente->CliShortname = $request->input('CliShortname');
        $Cliente->CliCategoria = $request->input('CliCategoria');
        $Cliente->CliType = $request->input('CliType');
        $Cliente->CliSlug = 'Cli-'.$request->input('CliShortname');
        $Cliente->CliDelete = '0';
        $Cliente->save();

        $log = new audit();
        $log->AuditTabla="clientes";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Cliente->ID_Cli;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('clientes.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        if(Auth::user()->UsRol === "Cliente"){
            $user = Auth::user()->UsRol;

            $cliente = cliente::where('CliSlug', $cliente)->first();
            return view('clientes.show', compact('cliente', 'user'));
        }
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
