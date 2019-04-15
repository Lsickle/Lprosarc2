<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\auditController;
use App\Departamento;
use App\Municipio;
use App\Cliente;
use App\audit;
use App\sede;
use App\Area;
use App\Cargo;
use App\Personal;
use App\User;

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
        
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function Ajax(Request $request, $id){
    //     if($request->ajax()){ 
    //         // $expediente = Expediente::create($request->all());
    //         // return "im in AjaxController index";
    //         $Municipios = Municipio::where('FK_MunCity', $id)->get();
    //         return response()->json(['message' => 'Insertado correctamente']);

    //         // $Departamento = $_POST['departamento'];
    //     }
    // }
    public function ajax(Request $request){
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = Municipio::where($select, $value)->get();

        $output = '<option value="">Selec'.$dependent.'</option>';
        foreach($data as $Municipio){
            $output .='<option value="'.$Municipio->ID_Mun.'>"'.$Municipio->MunName.'</option>';
        }
        echo $output;
    } 
    public function create()
    {
        if(Auth::user()->UsRol === "Cliente"){
            
            $Departamentos = Departamento::all();
            // $Municipios = Municipio::all();
           
            return view('clientes.create2', compact('Departamentos', 'Municipios'));
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
        return $request;
        if($request->input("number") == "1"){
            $Cliente = new Cliente();
            $Cliente->CliNit = $request->input('CliNit');
            $Cliente->CliName = $request->input('CliName');
            $Cliente->CliShortname = $request->input('CliShortname');
            $Cliente->CliCategoria = 'Cliente';
            $Cliente->CliType = $request->input('CliType');
            $Cliente->CliSlug = substr(md5(rand()), 0, 999999).$request->input('CliShortname');
            $Cliente->CliDelete = 0;
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
            $Sede->SedeSlug = substr(md5(rand()), 0, 999999).$request->input('SedeName');
            $Sede->FK_SedeCli = $Cliente->ID_Cli;
            // $Sede->FK_SedeMun = $request->input('FK_SedeMun');
            $Sede->FK_SedeMun = 3;
            $Sede->SedeDelete = 0;
            $Sede->save();
            
            $Area = new Area();
            $Area->AreaName = $request->input("AreaName");
            $Area->FK_AreaSede = $Sede->ID_Sede;
            $Area->AreaDelete = 0;
            $Area->save();
            
            $Cargo = new Cargo();
            $Cargo->CargName = $request->input("CargName");
            $Cargo->CargArea =  $Area->ID_Area;
            $Cargo->CargDelete =  0;
            $Cargo->save();
            
            $Personal = new Personal();
            $Personal->PersFirstName = $request->input("PersFirstName"); 
            $Personal->PersLastName = $request->input("PersLastName"); 
            $Personal->PersEmail = $request->input("PersEmail"); 
            $Personal->PersSecondName = $request->input("PersSecondName"); 
            $Personal->PersType = 1;//falta definir que boolean es externo
            $Personal->PersSlug = substr(md5(rand()), 0, 5).$request->input("PersFirstName"); 
            $Personal->PersDelete = 0; 
            $Personal->FK_PersCargo = $Cargo->ID_Carg; 
            $Personal->save();

            $user = User::where('id', Auth::user()->id)->first();
            $user->FK_UserPers = $Personal->ID_Pers;
            $user->save();

            return redirect()->route('clientes.index');

        }else{

        $Cliente = new Cliente();
        $Cliente->CliNit = $request->input('CliNit');
        $Cliente->CliName = $request->input('CliName');
        $Cliente->CliShortname = $request->input('CliShortname');
        $Cliente->CliCategoria = $request->input('CliCategoria');
        $Cliente->CliType = $request->input('CliType');
        $Cliente->CliSlug = substr(md5(rand()), 0, 999999).$request->input('CliShortname');
        $Cliente->CliDelete = '0';
        $Cliente->save();

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
