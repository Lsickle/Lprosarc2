<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SedeStoreRequest;
use App\Http\Controllers\userController;
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
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol ===  trans('adminlte_lang::message.Cliente')){
            $sedes = DB::table('sedes')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('sedes.*', 'clientes.ID_Cli', 'clientes.CliShortname','municipios.MunName', 'departamentos.DepartName')
                ->where(function($query){
                    $id = userController::IDClienteSegunUsuario();
                    if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
                        $query->where('sedes.SedeDelete',  '=', 0);
                    }
                    if(Auth::user()->UsRol ===  trans('adminlte_lang::message.Cliente')){
                        $query->where('FK_SedeCli', '=', $id);
                        $query->where('sedes.SedeDelete',  '=', 0);
                    }
                })
                ->get();
                return view('sclientes.index', compact('sedes'));
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
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol ===  trans('adminlte_lang::message.Cliente')) {
            if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
                $Clientes = cliente::all();
            }
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
    public function store(SedeStoreRequest $request)
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
        $Sede->SedeSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32).$request->input('SedeName').substr(md5(rand()), 0,32);
        $Sede->FK_SedeMun = $request->input('FK_SedeMun');
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            $id = userController::IDClienteSegunUsuario();
            $Sede->FK_SedeCli = $id;
        }else{
            $Sede->FK_SedeCli = $request->input('FK_SedeCli');
        }
        $Sede->SedeDelete = 0;
        $Sede->save();

        $log = new audit();
        $log->AuditTabla="sedes";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Sede->ID_Sede;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('sclientes.index');
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
        $Cliente = Cliente::where('ID_Cli', $Sede->FK_SedeCli)->first();
        $Municipio = Municipio::where('ID_Mun', $Sede->FK_SedeMun)->first();
        $Departamento = Departamento::where('ID_Depart', $Municipio->FK_MunCity)->first();

        return view('sclientes.show', compact('Sede', 'Cliente','Municipio', 'Departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol ===  trans('adminlte_lang::message.Cliente')) {
            $Sede = Sede::where('SedeSlug',$id)->first();
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
    public function update(SedeStoreRequest $request, $id)
    {
        $Sede = Sede::where('SedeSlug',$id)->first();
        $Sede->fill($request->except('FK_SedeCli'));
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            $ID_Cli = userController::IDClienteSegunUsuario();
            $Sede->FK_SedeCli = $ID_Cli;
        }else{
            $Sede->FK_SedeCli = $request->input('FK_SedeCli');
        }
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
        $Sede = Sede::where('SedeSlug', $id)->first();
            if ($Sede->SedeDelete == 0) {
                $Sede->SedeDelete = 1;
            }
            else{
                $Sede->SedeDelete = 0;
            }
        $Sede->save();

        $log = new audit();
        $log->AuditTabla="sedes";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$Sede->ID_Sede;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog = $Sede->SedeDelete;
        $log->save();

        return redirect()->route('sclientes.index');
    }
}
