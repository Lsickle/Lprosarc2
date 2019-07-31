<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\SedeRequest;
use App\Http\Controllers\userController;
use App\Sede;
use App\cliente;
use App\audit;
use App\Departamento;
use App\Municipio;
use App\Permisos;

class sclientcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) {
            if (old('FK_SedeMun') !== null){
                $Municipios = Municipio::where('FK_MunCity', old('departamento'))->get();
            }
            $Departamentos = Departamento::all();            
            return view('sclientes.create', compact('Clientes', 'Departamentos', 'Municipios'));
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
    public function store(SedeRequest $request)
    {
        $Sede = new Sede();
        $Sede->SedeName = $request->input('SedeName');
        $Sede->SedeAddress = $request->input('SedeAddress');

        if($request->input('SedePhone1') === null && $request->input('SedePhone2') !== null){
            $Sede->SedePhone1 = $request->input('SedePhone2');
            $Sede->SedeExt1 = $request->input('SedeExt2');
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
        $Sede->SedeSlug = hash('sha256', rand().time().$Sede->SedeName);
        $Sede->FK_SedeMun = $request->input('FK_SedeMun');

        $ID_Cli = userController::IDClienteSegunUsuario();
        $Sede->FK_SedeCli = $ID_Cli;
        $Sede->SedeDelete = 0;
        $Sede->save();
        $id = cliente::select('CliSlug')->where('ID_Cli', $Sede->FK_SedeCli)->first();

        return redirect()->route('cliente-show', compact('id'));
    }

    /**
     * Display the specified resource.
     *
     * idate(format)
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) {
            $Sede = Sede::where('SedeSlug',$id)->first();
            if (!$Sede) {
                abort(404);
            }
            if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
                $Clientes = Cliente::select('ID_Cli','CliShortname')->get();
                $Cliente = Cliente::where('ID_Cli', $Sede->FK_SedeCli)->first();
            }
            $Municipio = Municipio::where('ID_Mun', $Sede->FK_SedeMun)->first();
            $Municipios = Municipio::where('FK_MunCity', $Municipio->FK_MunCity)->get();
            $Departamentos = Departamento::all();
            return view('sclientes.edit', compact('Sede', 'Clientes', 'Cliente', 'Departamentos', 'Municipios', 'Municipio'));
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SedeRequest $request, $id)
    {
        $Sede = Sede::where('SedeSlug',$id)->first();
        if (!$Sede) {
            abort(404);
        }
        $Cliente = cliente::select('CliSlug')->where('ID_Cli', $Sede->FK_SedeCli)->first();
        $Sede->fill($request->all());
        // $Sede->fill($request->except('FK_SedeCli'));
        // $ID_Cli = userController::IDClienteSegunUsuario();
        // $Sede->FK_SedeCli = $ID_Cli;
        $Sede->save();

        $log = new audit();
        $log->AuditTabla="sedes";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Sede->ID_Sede;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        
        return redirect()->route('clientes.show', [$Cliente->CliSlug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) {
            $Sede = Sede::where('SedeSlug', $id)->first();
            if (!$Sede) {
                abort(404);
            }
            $id = cliente::select('CliSlug')->where('ID_Cli', $Sede->FK_SedeCli)->first();
                if ($Sede->SedeDelete == 0) {
                    $Sede->SedeDelete = 1;
                    $Sede->save();
                    
                    // return redirect()->route('sclientes.index');
                }
                else{
                    $Sede->SedeDelete = 0;
                    $Sede->save();

                    // $id = $Sede->SedeSlug;
                    // return redirect()->route('sede-show', compact('id'));
                }
                return redirect()->route('cliente-show', compact('id'));

            $log = new audit();
            $log->AuditTabla="sedes";
            $log->AuditType="Eliminado";
            $log->AuditRegistro=$Sede->ID_Sede;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog = $Sede->SedeDelete;
            $log->save();
        }else{
            abort(403);
        }
    }
}
