<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Validator;
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
            return view('clientes.index', compact('clientes'));
        }
        if(Auth::user()->UsRol === "Cliente"){
            return redirect()->route('home');
        }
        if(Auth::user()->UsRol === "Administrador"){
            $clientes = Cliente::where('CliDelete', 0)->get();
            return view('clientes.index', compact('clientes'));
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->UsRol === "Cliente"){
            if(Auth::user()->FK_UserPers === NULL){
                $Departamentos = Departamento::all();
                return view('clientes.create2', compact('Departamentos'));
            }else{
                return redirect()->route('home');
            }
        }
        if(Auth::user()->UsRol === "Administrador"){
            $Departamentos = Departamento::all();
                return view('clientes.create2', compact('Departamentos'));
        }else{
            abort(403);
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
        if($request->input("number") == "1"){
            $validate = $request->validate([
                'CliNit'        => 'required|max:13|min:13|unique:clientes,CliNit',
                'CliName'       => 'required|max:255|unique:clientes,CliName',
                'CliShortname'  => 'required|max:255|unique:clientes,CliName',
                'CliCategoria'  => 'max:32|alpha|nullable',

                'SedeName'      => 'required|max:128|min:1',
                'SedeAddress'   => 'alpha_num|required|max:255',
                'SedePhone1'    => 'max:11|min:11|nullable',
                'SedeExt1'      => 'min:3|max:5|nullable',
                'SedePhone2'    => 'max:11|min:11|nullable',
                'SedeExt2'      => 'min:3|max:5|nullable',
                'SedeEmail'     => 'required|email|max:128',
                'SedeCelular'   => 'min:12|max:12',

                'AreaName'      => 'required|max:128|alpha',

                'CargName'      => 'required|max:128|alpha',

                'PersFirstName' => 'required|alpha|max:64',
                'PersLastName'  => 'required|alpha|max:64',
                'PersEmail'     => 'required|email|max:255|unique:personals,PersEmail',
                'PersSecondName'=> 'alpha|max:64|nullable',
                'PersDocNumber' => 'required|max:64|unique:personals,PersDocNumber',
                'PersDocType'   => 'required|max:3|min:2',
            ]);

            $Cliente = new Cliente();
            $Cliente->CliNit = $request->input('CliNit');
            $Cliente->CliName = $request->input('CliName');
            $Cliente->CliShortname = $request->input('CliShortname');
            if(Auth::user()->UsRol === "Cliente"){
                $Cliente->CliCategoria = 'Cliente';
            }else{
                $Cliente->CliCategoria = $request->input('CliCategoria');
            }
            $Cliente->CliSlug = substr(md5(rand()), 0, 99999).$request->input('CliShortname');
            $Cliente->CliDelete = 0;
            $Cliente->save();

            $Sede = new Sede();
            $Sede->SedeName = $request->input('SedeName');
            $Sede->SedeAddress = $request->input('SedeAddress');
            $Sede->SedePhone1 = $request->input('SedePhone1');
            if($request->input('SedePhone1') === null && $request->input('SedePhone2') !== null || $request->input('SedeExt1') === null && $request->input('SedeExt2') !== null){

                $Sede->SedeExt1 = $request->input('SedeExt2');
                $Sede->SedePhone1 = $request->input('SedePhone2');
            }else{
                if($request->input('SedePhone1') === null){
                    $Sede->SedeExt1 = null;
                }else{
                    $Sede->SedePhone2 = $request->input('SedePhone1');
                    $Sede->SedeExt1 = $request->input('SedeExt1');
                }
                if($request->input('SedePhone2') === null){
                    $Sede->SedeExt2 = null;
                }else{
                    $Sede->SedePhone2 = $request->input('SedePhone2');
                    $Sede->SedeExt2 = $request->input('SedeExt2');
                }
            }
            $Sede->SedeEmail = $request->input('SedeEmail');
            $Sede->SedeCelular = $request->input('SedeCelular');
            $Sede->SedeSlug = substr(md5(rand()), 0, 99999).$request->input('SedeName');
            $Sede->FK_SedeCli = $Cliente->ID_Cli;
            $Sede->FK_SedeMun = $request->input('FK_SedeMun');
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
            $Personal->PersDocType = $request->input("PersDocType");
            $Personal->PersDocNumber = $request->input("PersDocNumber");
            $Personal->PersType = 1;//falta definir que boolean es externo
            $Personal->PersSlug = substr(md5(rand()), 0, 99999).$request->input("PersFirstName"); 
            $Personal->PersDelete = 0; 
            $Personal->FK_PersCargo = $Cargo->ID_Carg; 
            $Personal->save();

            if(Auth::user()->UsRol === "Cliente"){
                $user = User::where('id', Auth::user()->id)->first();
                $user->FK_UserPers = $Personal->ID_Pers;
                $user->save();
            }
            
            return redirect()->route('clientes.index');
        }else{
        $Cliente = new Cliente();
        $Cliente->CliNit = $request->input('CliNit');
        $Cliente->CliName = $request->input('CliName');
        $Cliente->CliShortname = $request->input('CliShortname');
        $Cliente->CliCategoria = $request->input('CliCategoria');
        $Cliente->CliType = $request->input('CliType');
        $Cliente->CliSlug = substr(md5(rand()), 0, 99999).$request->input('CliShortname');
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
        if(Auth::user()->UsRol === "Administrador" || Auth::user()->UsRol === "Programador"){
            $cliente = cliente::where('CliSlug', $cliente->CliSlug)->first();
            return view('clientes.show', compact('cliente'));
        }else{
            abort(403);
        }
    }
    public function viewClient($id)
    {
        if(Auth::user()->UsRol === "Cliente"){
            
            $user = User::select('FK_UserPers')->where('UsSlug', $id)->first(); 
            $personal = Personal::select('FK_PersCargo')->where('ID_Pers', $user->FK_UserPers)->first();
            $cargo = Cargo::select('CargArea')->where('ID_Carg', $personal->FK_PersCargo)->first();
            $area = Area::select('FK_AreaSede')->where('ID_Area', $cargo->CargArea)->first();
            $sede = sede::select('FK_SedeCli')->where('ID_Sede', $area->FK_AreaSede)->first();
            $cliente = cliente::where('ID_Cli', $sede->FK_SedeCli)->first();

            return view('clientes.show', compact('cliente', 'personal', 'cargo', 'area', 'sede', 'user'));
        }else{
            abort(403);
        }
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
        $cliente = cliente::where('CliSlug', $cliente->CliSlug)->first();
        $cliente->fill($request->all());
        $cliente->save();
        /*codigo para incluir la actualizacion en la tabla de auditoria*/
        $log = new audit();
        $log->AuditTabla="clientes";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$cliente->ID_Cli;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();
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
        if(Auth::user()->UsRol === "Administrador" || Auth::user()->UsRol === "Programador"){
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
        }else{
            abort(403);
        }
    }
}
