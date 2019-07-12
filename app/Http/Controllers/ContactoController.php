<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Requests\ContactosStoreRequest;
use App\Http\Requests\ContactosUpdateRequest;
use App\Http\Controllers\userController;
use App\Cliente;
use App\Sede;
use App\Departamento;
use App\Municipio;
use App\Vehiculo;
use App\audit;
use App\Permisos;


class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
            abort(403);
        }else{
            $ID_Cli = userController::IDClienteSegunUsuario();
            $Clientes = Cliente::where('CliCategoria', '<>', 'Cliente')
                ->where(function($query){
                    if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR)){
                    }else{
                        $query->where('CliDelete', 0);
                    }
                })
                ->where('clientes.ID_Cli','<>', $ID_Cli)
                ->get();
            return view('contactos.index', compact('Clientes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(in_array(Auth::user()->UsRol, Permisos::Jefes) || in_array(Auth::user()->UsRol2, Permisos::Jefes)){
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
        $Cliente = new Cliente();
        $Cliente->CliNit = $request->input('CliNit');
        $Cliente->CliName = $request->input('CliName');
        $Cliente->CliShortname = $request->input('CliShortname');
        $Cliente->CliCategoria = $request->input('CliCategoria');
        $Cliente->CliSlug = hash('sha256', rand().time().$Cliente->CliShortname);
        $Cliente->CliDelete = 0;
        $Cliente->save();

        $Sede = new Sede();
        $Sede->SedeName = $request->input('SedeName');
        $Sede->SedeAddress = $request->input('SedeAddress');
        $Sede->SedePhone1 = $request->input('SedePhone1');
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
        $Sede->FK_SedeCli = $Cliente->ID_Cli;
        $Sede->FK_SedeMun = $request->input('FK_SedeMun');
        $Sede->SedeDelete = 0;
        $Sede->save();

        if($request->input('CliCategoria') === 'Transportador'){

            $Vehiculo = new Vehiculo();
            $Vehiculo->VehicPlaca = $request->input('VehicPlaca');
            $Vehiculo->VehicTipo = $request->input('VehicTipo');
            $Vehiculo->VehicCapacidad = $request->input('VehicCapacidad');
            $Vehiculo->VehicInternExtern = 0;
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
        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
            abort(403);
        }else{
            $Cliente = Cliente::where('CliSlug', $id)->first();
            $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();
            $Municipio = Municipio::where('ID_Mun', $Sede->FK_SedeMun)->first();
            $Departamento = Departamento::where('ID_Depart', $Municipio->FK_MunCity)->first();
            
            if($Cliente->CliCategoria === 'Transportador'){
                $Vehiculos = Vehiculo::where('FK_VehiSede', $Sede->ID_Sede)
                    ->where(function($query){
                        if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR)){
                        }else{
                            $query->where('VehicDelete', 0);
                        }
                    })
                    ->get();
                return view('contactos.show', compact('Cliente', 'Sede', 'Vehiculos', 'Municipio', 'Departamento'));
            }else{
                return view('contactos.showProveedor', compact('Cliente', 'Sede', 'Municipio', 'Departamento'));
            }
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
        if(in_array(Auth::user()->UsRol, Permisos::Jefes) || in_array(Auth::user()->UsRol2, Permisos::Jefes)){
            $Departamentos = Departamento::all();
            $Cliente = Cliente::where('CliSlug', $id)->first();
            $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();
    
            $Municipality = Municipio::where('ID_Mun', $Sede->FK_SedeMun)->first();
            $Departament = Departamento::where('ID_Depart', $Municipality->FK_MunCity)->first();
            $Municipios = Municipio::where('FK_MunCity', $Municipality->FK_MunCity)->get();
        }else{
            abort(403);
        }

        return view('contactos.edit', compact('Cliente', 'Sede', 'Municipios', 'Departamentos', 'Municipality', 'Departament'));
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
        $validate = $request->validate([
            'CliNit' => ['required','min:13','max:13',Rule::unique('clientes')->where(function ($query) use ($request, $id){

                $Cliente = DB::table('clientes')
                    ->select('clientes.CliNit')
                    ->where('CliNit', $request->input('CliNit'))
                    ->where('CliCategoria', $request->input('CliCategoria'))
                    ->where('CliDelete', 0)
                    ->where('CliSlug', '<>', $id)
                    ->first();

                if(isset($Cliente->CliNit)){
                    $query->where('clientes.CliNit','=', $Cliente->CliNit);
                }else{
                    $query->where('clientes.CliNit','=', null);
                }
            })],
        ]);

        $Cliente = Cliente::where('CliSlug', $id)->first();
        $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();

        $Sede->fill($request->all());
        $Sede->save();

        $Cliente->fill($request->all());
        $Cliente->save();

        $Vehiculos = Vehiculo::where('FK_VehiSede', $Sede->ID_Sede)->where('VehicDelete', 0)->get();
        
        if($request->input('CliCategoria') === 'Proveedor' && isset($Vehiculos[0])){
            foreach($Vehiculos as $Vehiculo){
                $Vehiculo->VehicDelete = 1;
                $Vehiculo->save();
            }
            
        }elseif($request->input('CliCategoria') === 'Transportador' && !isset($Vehiculos[0])){
            $Validate = $request->validate([
                'VehicPlaca' => 'required|unique:vehiculos,VehicPlaca|max:7|min:7',
                'VehicTipo' => 'required|max:64',
                'VehicCapacidad' => 'required|max:64',
            ]);

            $Vehiculo = new Vehiculo();
            $Vehiculo->VehicPlaca = $request->input('VehicPlaca');
            $Vehiculo->VehicTipo = $request->input('VehicTipo');
            $Vehiculo->VehicCapacidad = $request->input('VehicCapacidad');
            $Vehiculo->VehicInternExtern = 0;
            $Vehiculo->VehicDelete = 0;
            $Vehiculo->FK_VehiSede = $Sede->ID_Sede;
            $Vehiculo->save();
        }   

        $log = new audit();
        $log->AuditTabla="clientes-contacto";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Cliente->ID_Cli;
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
        $Cliente = Cliente::where('CliSlug', $id)->first();
        $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();
        $Vehiculos = Vehiculo::where('FK_VehiSede', $Sede->ID_Sede)->get();
        if ($Cliente->CliDelete == 0){
            foreach($Vehiculos as $Vehiculo){
                $Vehiculo->VehicDelete = 1;
                $Vehiculo->save();
            }
            $Cliente->CliDelete = 1;
            $Cliente->save();

            $Sede->SedeDelete = 1;
            $Sede->save();

            return redirect()->route('contactos.index');
        }else{
            foreach($Vehiculos as $Vehiculo){
                $Vehiculo->VehicDelete = 0;
                $Vehiculo->save();
            }
            $Cliente->CliDelete = 0;
            $Cliente->save();

            $Sede->SedeDelete = 0;
            $Sede->save();

            $id = $Cliente->CliSlug;
            return redirect()->route('contactos.show', compact('id'));
        }
    }
}
