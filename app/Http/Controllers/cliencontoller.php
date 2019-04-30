<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\auditController;
use App\Http\Requests\clienteStoreRequest;
use App\Departamento;
use App\Municipio;
use App\Cliente;
use App\audit;
use App\Sede;
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
        switch (Auth::user()->UsRol) {

            case trans('adminlte_lang::message.Programador'):
                $clientes = Cliente::all();
                return view('clientes.index', compact('clientes'));
                break;
            
            case trans('adminlte_lang::message.Cliente'): 
                return redirect()->route('home');
                break;

            case trans('adminlte_lang::message.Administrador'):
                $clientes = Cliente::where('CliDelete', 0)->get();
                return view('clientes.index', compact('clientes'));
                break;

            default:
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
        switch (Auth::user()->UsRol) {
            case trans('adminlte_lang::message.Cliente'):
                if(Auth::user()->FK_UserPers === NULL){
                    $Departamentos = Departamento::all();
                    if (old('FK_SedeMun') !== null){
                        $Municipios = Municipio::select()->where('FK_MunCity', old('departamento'))->get();
                    }
                    return view('clientes.create2', compact('Departamentos', 'Municipios'));
                    break;
                }else{
                    return redirect()->route('home');
                    break;
                }
            case trans('adminlte_lang::message.Administrador'):
                $Departamentos = Departamento::all();
                if (old('FK_SedeMun') !== null){
                        $Municipios = Municipio::where('FK_MunCity', old('departamento'))->get();
                }
                return view('clientes.create2', compact('Departamentos', 'Municipios'));
                break;
            default:
                abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(clienteStoreRequest $request)
    {
            $Cliente = new Cliente();
            $Cliente->CliNit = $request->input('CliNit');
            $Cliente->CliName = $request->input('CliName');
            $Cliente->CliShortname = $request->input('CliShortname');
            if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
                $Cliente->CliCategoria = 'Cliente';
            }else{
                $Cliente->CliCategoria = $request->input('CliCategoria');
            }
            $Cliente->CliSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32).$request->input('CliShortname').substr(md5(rand()), 0,32);
            $Cliente->CliDelete = 0;
            $Cliente->save();

            $Sede = new Sede();
            $Sede->SedeName = $request->input('SedeName')."(Principal)";
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
            $Sede->SedeSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32).$request->input('SedeName').substr(md5(rand()), 0,32);
            $Sede->FK_SedeCli = $Cliente->ID_Cli;
            $Sede->FK_SedeMun = $request->input('FK_SedeMun');
            $Sede->FK_SedeMun = 3;
            $Sede->SedeDelete = 0;
            $Sede->save();

            if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
                
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
            $Personal->PersType = 1;
            $Personal->PersSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32).$request->input("PersFirstName").substr(md5(rand()), 0,32);
            $Personal->PersDelete = 0; 
            $Personal->FK_PersCargo = $Cargo->ID_Carg; 
            $Personal->save();

            
                $user = User::where('ID_Cli', Auth::user()->ID_Cli)->first();
                $user->FK_UserPers = $Personal->ID_Pers;
                $user->save();
            }
            return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $ID_Cli
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
            $cliente = cliente::where('CliSlug', $cliente->CliSlug)->first();
            return view('clientes.show', compact('cliente'));
        }else{
            abort(403);
        }
    }
    public function viewClientShow($id)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            
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
     * @param  int  $ID_Cli
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
     * @param  int  $ID_Cli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {   
        $cliente = cliente::where('CliSlug', $cliente->CliSlug)->first();
        $validate = $request->validate([
            'CliName'       => 'required|max:255|unique:clientes,CliName,'.$cliente->ID_Cli.',ID_Cli',
            'CliNit'        => 'required|max:13|min:13|unique:clientes,CliNit,'.$cliente->ID_Cli.',ID_Cli',
            'CliShortname'  => 'required|max:255|unique:clientes,CliShortname,'.$cliente->ID_Cli.',ID_Cli',
            'CliCategoria'  => 'max:32|alpha|nullable',
        ]);
        
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
     * @param  int  $ID_Cli
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_Cli){
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
            $Cliente = Cliente::where('CliSlug', $ID_Cli)->first();
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
