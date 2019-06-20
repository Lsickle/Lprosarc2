<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Http\Controllers\auditController;
use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Http\Controllers\userController;
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
                $clientes = Cliente::where('CliCategoria', 'Cliente')->get();
                return view('clientes.index', compact('clientes'));
                break;
            
            case trans('adminlte_lang::message.Cliente'): 
                return redirect()->route('home');
                break;

            case trans('adminlte_lang::message.Administrador'):
                $clientes = Cliente::where('CliDelete', 0)->where('CliCategoria', 'Cliente')->get();
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
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            if(Auth::user()->FK_UserPers === NULL){
                $Departamentos = Departamento::all();
                if (old('FK_SedeMun') !== null){
                    $Municipios = Municipio::select()->where('FK_MunCity', old('departamento'))->get();
                }
                return view('clientes.create2', compact('Departamentos', 'Municipios'));
            }else{
                return redirect()->route('home');
            }
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
    public function store(ClienteStoreRequest $request)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){

            $Cliente = new Cliente();
            $Cliente->CliNit = $request->input('CliNit');
            $Cliente->CliName = $request->input('CliName');
            $Cliente->CliShortname = $request->input('CliShortname');
            $Cliente->CliCategoria = 'Cliente';
            $Cliente->CliSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32).$request->input('CliShortname').substr(md5(rand()), 0,32);
            $Cliente->CliDelete = 0;
            $Cliente->save();

            $Sede = new Sede();
            $Sede->SedeName = $request->input('SedeName');
            $Sede->SedeAddress = $request->input('SedeAddress');
            $Sede->SedePhone1 = $request->input('SedePhone1');
            if($request->input('SedePhone1') === null && $request->input('SedePhone2') !== null){

                $Sede->SedeExt1 = $request->input('SedeExt2');
                $Sede->SedePhone1 = $request->input('SedePhone2');
            }else{
                if($request->input('SedePhone1') === null){
                    $Sede->SedeExt1 = null;
                }else{
                    $Sede->SedePhone1 = $request->input('SedePhone1');
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
            $Sede->SedeDelete = 0;
            $Sede->save();

            $Area = new Area();
            $Area->AreaName = $request->input("AreaName");
            $Area->FK_AreaSede = $Sede->ID_Sede;
            $Area->AreaDelete = 0;
            $Area->AreaSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
            $Area->save();
            
            $Cargo = new Cargo();
            $Cargo->CargName = $request->input("CargName");
            $Cargo->CargArea =  $Area->ID_Area;
            $Cargo->CargDelete =  0;
            $Cargo->CargSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
            $Cargo->save();
            
            $Personal = new Personal();
            $Personal->PersFirstName = $request->input("PersFirstName"); 
            $Personal->PersLastName = $request->input("PersLastName"); 
            $Personal->PersEmail = $request->input("PersEmail"); 
            $Personal->PersSecondName = $request->input("PersSecondName"); 
            $Personal->PersDocType = $request->input("PersDocType");
            $Personal->PersDocNumber = $request->input("PersDocNumber");
            $Personal->PersCellphone = $request->input("PersCellphone");
            $Personal->PersType = 1;
            $Personal->PersSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32).$request->input("PersFirstName").substr(md5(rand()), 0,32);
            $Personal->PersDelete = 0; 
            $Personal->FK_PersCargo = $Cargo->ID_Carg; 
            $Personal->save();

            $user = User::where('id', Auth::user()->id)->first();
            $user->FK_UserPers = $Personal->ID_Pers;
            $user->save();

            $id = Cliente::select('CliSlug')->where('ID_Cli', $Cliente->ID_Cli)->first();
                
            return redirect()->route('cliente', compact('id'));
        }
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
            $cliente = Cliente::where('CliSlug', $cliente->CliSlug)->first();
            return view('clientes.show', compact('cliente'));
        }else{
            abort(403);
        }
    }
    
    // show del menu donde dice mi Empresa
    public function viewClientShow($id)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
            $ID_Cli = userController::IDClienteSegunUsuario();
            // return $ID_Cli;
            $cliente = Cliente::where('ID_Cli', $ID_Cli)->first();
            // return $cliente;
            return view('clientes.show', compact('cliente'));
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
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
            return view('clientes.edit', compact('cliente'));
        }else{
            abort(403);
        }
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
        $validate = $request->validate([

        'CliNit' => ['required','min:13','max:13',Rule::unique('clientes')->where(function ($query) use ($request, $cliente){
        $Cliente = DB::table('clientes')
            ->select('clientes.CliNit')
            ->where('CliNit', $request->input('CliNit'))
            ->where('CliCategoria', 'Cliente')
            ->where('CliDelete', 0)
            ->where('ID_Cli', '<>', $cliente->ID_Cli)
            ->first();
            if(isset($Cliente->CliNit)){
                $query->where('clientes.CliNit','=', $Cliente->CliNit);
            }else{
                $query->where('clientes.CliNit','=', null);
            }
        })],
        'CliName'       => 'required|max:255|min:1',
        'CliShortname'  => 'required|max:255|min:1',
        ]);
            
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
        
        $id = $cliente->CliSlug;

        return redirect()->route('cliente', compact('id'));
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
