<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactosStoreRequest;
use App\Http\Requests\ContactosUpdateRequest;
use App\Cliente;
use App\Sede;
use App\Departamento;
use App\Municipio;
use App\Vehiculo;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Clientes = Cliente::where('CliCategoria', '<>', 'Cliente')->get();
        return view('contactos.index', compact('Clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
            $Departamentos = Departamento::all();
            if (old('FK_SedeMun') !== null){
                $Municipios = Municipio::select()->where('FK_MunCity', old('departamento'))->get();
            }
            return view('contactos.create', compact('Departamentos', 'Municipios'));
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
    public function store(ContactosStoreRequest $request)
    {
        // return $request;
        $Cliente = new Cliente();
            $Cliente->CliNit = $request->input('CliNit');
            $Cliente->CliName = $request->input('CliName');
            $Cliente->CliShortname = $request->input('CliShortname');
            $Cliente->CliCategoria = $request->input('CliCategoria');
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

            if($request->input('CliCategoria') === 'Transportador'){
                $Vehiculo = new Vehiculo();
                $Vehiculo->VehicPlaca = $request->input('VehicPlaca');
                $Vehiculo->VehicTipo = $request->input('VehicTipo');
                $Vehiculo->VehicCapacidad = $request->input('VehicCapacidad');
                $Vehiculo->VehicInternExtern = 1;
                $Vehiculo->VehicDelete = 0;
                $Vehiculo->FK_VehiSede = $Sede->ID_Sede;
                $Vehiculo->save();
            }
            
            return redirect()->route('contactos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Cliente = Cliente::where('CliSlug', $id)->first();
        $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();
        if($Cliente->CliCategoria !== 'Proveedor'){
            $Vehiculos = Vehiculo::where('FK_VehiSede', $Sede->ID_Sede)->get();
            return view('contactos.show', compact('Cliente', 'Sede', 'Vehiculos'));
        }else{
            return view('contactos.showProveedor', compact('Cliente', 'Sede'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Cliente = Cliente::where('CliSlug', $id)->first();
        $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();
        return view('contactos.edit', compact('Cliente', 'Sede'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactosUpdateRequest $request, $id)
    {
        $Cliente = Cliente::where('CliSlug', $id)->first();
        $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();

        $Cliente->fill($request->all());
        $Cliente->save();

        $Sede->fill($request->all());
        $Sede->save();

        $Vehiculos = Vehiculo::where('FK_VehiSede', $Sede->ID_Sede)->get();
        
        if($Cliente->CliCategoria === 'Proveedor' && isset($Vehiculos)){

        }else{
            if($Cliente->CliCategoria === 'Transportador' && !isset($Vehiculos)){

            }
        }

        $log = new audit();
        $log->AuditTabla="clientes-contacto";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$cliente->ID_Cli;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        $id = $Cliente->CliSlug;

        return redirect()->route('contactos.show', compact('id'));
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
