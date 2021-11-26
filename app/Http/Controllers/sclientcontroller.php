<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\SedeRequest;
use App\Http\Controllers\userController;
use App\AuditRequest;
use App\Cliente;
use App\Sede;
use App\Area;
use App\Cargo;
use App\Personal;
use App\Generador;
use App\GenerSede;
use App\audit;
use App\Departamento;
use App\Municipio;
use App\Permisos;

class sclientcontroller extends Controller
{
    public function __construct()
    {
        $this->table = 'sedes';
    }
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
        $id = Cliente::select('CliSlug')->where('ID_Cli', $Sede->FK_SedeCli)->first();

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
            $Municipio = Municipio::where('ID_Mun', $Sede->FK_SedeMun)->first();
            $Municipios = Municipio::where('FK_MunCity', $Municipio->FK_MunCity)->get();
            $Departamentos = Departamento::all();
            return view('sclientes.edit', compact('Sede', 'Departamentos', 'Municipios', 'Municipio'));
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
        $Cliente = Cliente::select('CliSlug')->where('ID_Cli', $Sede->FK_SedeCli)->first();
        $Sede->fill($request->all());
        $Sede->save();

        AuditRequest::auditUpdate($this->table, $Sede->ID_Sede, $request->all());

        return redirect()->route('clientes.show', [$Cliente->CliSlug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) {
            $Sede = Sede::where('SedeSlug', $slug)->first();
            if (!$Sede) {
                abort(404);
            }
            $Cliente = Cliente::select('CliSlug')->where('ID_Cli', $Sede->FK_SedeCli)->first();
            if ($Sede->SedeDelete == 0) {
                $Sede->SedeDelete = 1;
                $Sede->save();

                AuditRequest::auditDelete($this->table, $Sede->ID_Sede, $Sede->SedeDelete);
            }
            else{
                $Sede->SedeDelete = 0;
                $Sede->save();

                AuditRequest::auditRestored($this->table, $Sede->ID_Sede, $Sede->SedeDelete);
            }

            return redirect()->route('clientes.show', [$Cliente->CliSlug]);
        }else{
            abort(403);
        }
    }
        /**
     * Show the form for creating a new resource.
     * @param  int  $cliente
     * @return \Illuminate\Http\Response
     */
    public function createSedeExpress(Cliente $cliente)
    {
        switch (true) {
            case Auth::user()->email == 'asesorse1@prosarc.com.co':
            case Auth::user()->email == 'asesorse2@prosarc.com.co':
            case Auth::user()->email == 'coordinadorse@prosarc.com.co':
            case in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR):

                $Municipios = Municipio::all();
                $Departamentos = Departamento::all();
                $personal = $cliente->sedes()->first()->Areas()->first()->Cargos()->first()->Personal()->first();

                return view('sclientes.createExpress', compact('cliente', 'Departamentos', 'Municipios', 'personal'));
                break;

            default:
                abort(403);
                break;
        }
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSedeExpress(Request $request, Cliente $cliente)
    {
        // return $request;
        $Sede = new Sede();
        $Sede->SedeName =$request->input('SedeName');
        $Sede->SedeAddress = $request->input('SedeAddress');
        $Sede->SedePhone1 = $request->input('SedePhone1');
        $Sede->SedeEmail = $request->input("PersEmail");
        $Sede->SedeCelular = $request->input("PersCellphone");
        if ($request->input('FK_SedeMun') == 169) {
            $Sede->SedeMapLocalidad = $request->input("SedeMapLocalidad");
        }else {
            $Sede->SedeMapLocalidad = 'No Definida';
        }
        $Sede->SedeMapAddressSearch = $request->input("SedeMapAddressSearch");
        $Sede->SedeMapAddressResult = $request->input("SedeMapAddressResult");
        $Sede->SedeMapLat = $request->input("SedeMapLat");
        $Sede->SedeMapLong = $request->input("SedeMapLong");
        $Sede->SedeSlug = hash('sha256', rand().time().$Sede->SedeName);
        $Sede->FK_SedeCli = $cliente->ID_Cli;
        $Sede->FK_SedeMun = $request->input('FK_SedeMun');
        $Sede->SedeDelete = 0;
        $Sede->save();

        $Area = new Area();
        $Area->AreaName = 'Administración';
        $Area->FK_AreaSede = $Sede->ID_Sede;
        $Area->AreaDelete = 0;
        $Area->AreaSlug = hash('sha256', rand().time().$Area->AreaName);
        $Area->save();

        $Cargo = new Cargo();
        $Cargo->CargName = 'Encargado';
        $Cargo->CargArea =  $Area->ID_Area;
        $Cargo->CargDelete =  0;
        $Cargo->CargSlug = hash('sha256', rand().time().$Cargo->CargName);
        $Cargo->save();

        $Personal = new Personal();
        $Personal->PersFirstName = $request->input("PersFirstName");
        $Personal->PersLastName = $request->input("PersLastName");
        $Personal->PersEmail = $request->input("PersEmail");
        $Personal->PersCellphone = $request->input("PersCellphone");
        $Personal->PersType = 1;
        $Personal->PersSlug = hash('sha256', rand().time().$Personal->PersFirstName);
        $Personal->PersDelete = 0;
        $Personal->PersFactura = 0;
        $Personal->PersAdmin = 0;
        $Personal->FK_PersCargo = $Cargo->ID_Carg;
        $Personal->save();

        $Gener = Generador::where('FK_GenerCli', $cliente->sedes()->first()->ID_Sede)->first();

        $SGener = new GenerSede();
        $SGener->GSedeName = $Sede->SedeName;
        $SGener->GSedeAddress = $Sede->SedeAddress;
        $SGener->GSedePhone1 = $Sede->SedePhone1;
        $SGener->GSedeEmail = $Sede->SedeEmail;
        $SGener->GSedeCelular = $Sede->SedeCelular;
        if ($request->input('FK_SedeMun') == 169) {
            $SGener->GSedeMapLocalidad = $request->input("SedeMapLocalidad");
        }else {
            $SGener->GSedeMapLocalidad = 'No Definida';
        }
        $SGener->GSedeMapAddressSearch = $request->input("SedeMapAddressSearch");
        $SGener->GSedeMapAddressResult = $request->input("SedeMapAddressResult");
        $SGener->GSedeMapLat = $request->input("SedeMapLat");
        $SGener->GSedeMapLong = $request->input("SedeMapLong");
        $SGener->GSedeSlug = hash('sha256', rand().time().$SGener->GSedeName);
        $SGener->FK_GSede = $Gener->ID_Gener;
        $SGener->FK_GSedeMun = $Sede->FK_SedeMun;
        $SGener->GSedeDelete = 0;
        $SGener->save();

        return redirect()->route('clientexpress.show', compact('cliente'));
    }
}
