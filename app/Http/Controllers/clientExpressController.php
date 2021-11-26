<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\userController;
use App\Http\Controllers\auditController;
use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteExpressUpdateRequest;
use App\AuditRequest;
use App\Permisos;
use App\Cliente;
use App\Departamento;
use App\Municipio;
use App\Sede;
use App\Generador;
use App\GenerSede;
use App\audit;
use App\Area;
use App\Cargo;
use App\Personal;
use App\User;
use App\RequerimientosCliente;

class clientExpressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (true) {
            case(Auth::user()->email == 'asesorse2@prosarc.com.co'):
            case(Auth::user()->email == 'asesorse1@prosarc.com.co'):
            case(Auth::user()->email == 'coordinadorse@prosarc.com.co'):
            case(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)):
                $clientes = Cliente::with(['comercialAsignado'])
                ->where('CliCategoria', 'ClientePrepago')
                ->where('CliDelete', 0)
                ->get();
                // $clientes = DB::table('clientes')
                //     ->leftjoin('personals', 'clientes.CliComercial', '=', 'personals.ID_Pers')
                //     ->select('clientes.*', 'personals.PersFirstName','personals.PersLastName')
                //     ->where('CliDelete', 0)
                //     ->where('CliCategoria', 'ClientePrepago')
                //     ->get();

                 $personals = DB::table('personals')
                        ->rightjoin('users', 'personals.ID_Pers', '=', 'users.FK_UserPers')
                        ->select('personals.*')
                        ->where('personals.PersDelete', 0)
                        ->where('users.UsRol', 'Comercial')
                        ->orWhere('users.UsRol2', 'Comercial')
                        ->get();
                return view('clientExpress.indexExpress', compact('clientes', 'personals'));
                break;

            case (in_array(Auth::user()->UsRol, Permisos::TODOPROSARC)):
               $clientes = Cliente::with(['comercialAsignado'])
                ->where('CliCategoria', 'ClientePrepago')
                ->where('CliDelete', 0)
                ->get();
                $personals = DB::table('personals')
                        ->rightjoin('users', 'personals.ID_Pers', '=', 'users.FK_UserPers')
                        ->select('personals.*')
                        ->where('personals.PersDelete', 0)
                        ->where('users.UsRol', 'Comercial')
                        ->orWhere('users.UsRol2', 'Comercial')
                        ->get();
                return view('clientExpress.indexExpress', compact('clientes', 'personals'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $clientexpress)
    {
        $cliente = $clientexpress;
        switch (true) {
            case(Auth::user()->email == 'asesorse2@prosarc.com.co'):
            case(Auth::user()->email == 'asesorse1@prosarc.com.co'):
            case(Auth::user()->email == 'coordinadorse@prosarc.com.co'):
            case(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)):
                $Sedes = DB::table('sedes')
                ->join('municipios', 'municipios.ID_Mun', '=', 'sedes.FK_SedeMun')
                ->join('departamentos', 'departamentos.ID_Depart', '=', 'municipios.FK_MunCity')
                ->select('sedes.*', 'municipios.MunName', 'departamentos.DepartName')
                ->where('sedes.FK_SedeCli', $cliente->ID_Cli)
                ->where(function($query){
                    if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR)) {
                    }else{
                        $query->where('sedes.SedeDelete', '=', 0);
                    }
                })
                ->get();

            $SedeSlug = userController::IDSedeSegunUsuario();
            $Requerimientos = RequerimientosCliente::where('FK_RequeClient', $cliente->ID_Cli)->first();

            return view('clientExpress.showExpress', compact('cliente', 'Sedes', 'SedeSlug', 'Requerimientos'));
                break;

            default:
                abort(403);
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $clientexpress)
    {
        $cliente = $clientexpress;
        switch (true) {
            case (Auth::user()->email == 'asesorse2@prosarc.com.co'):
            case (Auth::user()->email == 'asesorse1@prosarc.com.co'):
            case (Auth::user()->email == 'coordinadorse@prosarc.com.co'):
            case (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)):
                $Departamentos = Departamento::all();
                $comerciales = DB::table('personals')
                ->rightjoin('users', 'personals.ID_Pers', '=', 'users.FK_UserPers')
                ->select('personals.*')
                ->where('personals.PersDelete', 0)
                ->where('users.UsRol', 'Comercial')
                ->orWhere('users.UsRol2', 'Comercial')
                ->get();

                if (old('FK_SedeMun') !== null){
                    $Municipios = Municipio::select()->where('FK_MunCity', old('departamento'))->get();
                }else {
                    $Municipios = Municipio::select()->where('FK_MunCity',  $cliente->sedes[0]->Municipios->FK_MunCity)->get();
                }

                // get personal of client
                $personal = $cliente->sedes()->first()->Areas()->first()->Cargos()->first()->Personal()->first();

                $user = User::where('FK_UserPers', $personal->ID_Pers)->first();

                return view('clientExpress.editExpress', compact('Departamentos', 'Municipios', 'comerciales', 'cliente', 'personal', 'user'));
                break;

            default:
                abort(403, 'Solo el personal autorizado puede editar la información del cliente');
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteExpressUpdateRequest $request, Cliente $clientexpress)
    {
        $cliente = $clientexpress;
        $cliente->CliNit = $request->input('CliNit');
        $cliente->CliName = $request->input('CliName');
        $cliente->CliComercial = $request->input('CliComercial');
        $cliente->CliShortname = $request->input('CliName');
        $cliente->save();

        $Sede = Sede::where('FK_SedeCli', $cliente->ID_Cli)->first();
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
        $Sede->FK_SedeMun = $request->input('FK_SedeMun');
        $Sede->save();

        $Area = Area::where('FK_AreaSede', $Sede->ID_Sede)->first();

        $Cargo = Cargo::where('CargArea', $Area->ID_Area)->first();

        $Personal = Personal::where('FK_PersCargo', $Cargo->ID_Carg)->first();
        $Personal->PersFirstName = $request->input("PersFirstName");
        $Personal->PersLastName = $request->input("PersLastName");
        $Personal->PersEmail = $request->input("PersEmail");
        $Personal->PersCellphone = $request->input("PersCellphone");
        $Personal->save();

        $user = User::where('FK_UserPers', $Personal->ID_Pers)->first();
        $user->name = $Personal->PersFirstName;
        $user->email = $Personal->PersEmail;
        $user->password = bcrypt($cliente->CliNit);
        $user->save();

        $Gener = Generador::where('FK_GenerCli', $Sede->ID_Sede)->first();
        $Gener->GenerNit = $cliente->CliNit;
        $Gener->GenerName = $cliente->CliName;
        $Gener->save();

        $SGener = GenerSede::where('FK_GSede', $Gener->ID_Gener)->first();
        $SGener->GSedeName = $Sede->SedeName;
        $SGener->GSedeAddress = $Sede->SedeAddress;
        $SGener->GSedePhone1 = $Sede->SedePhone1;
        $SGener->GSedeEmail = $Personal->PersEmail;
        $SGener->GSedeCelular = $Personal->PersCellphone;
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
        $SGener->GSedeDelete = $Sede->SedeDelete;
        $SGener->save();

         $log = new audit();
        $log->AuditTabla="Varias";
        $log->AuditType="Update Cliente Express";
        $log->AuditRegistro=$cliente->ID_Cli;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request);
        $log->save();

        return redirect()->route('clientexpress.show', [$cliente->CliSlug]);
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
