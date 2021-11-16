<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\auditController;
use App\Http\Requests\ClienteExpressStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Http\Controllers\userController;
use App\AuditRequest;
use App\Departamento;
use App\Municipio;
use App\Cliente;
use App\Generador;
use App\audit;
use App\Sede;
use App\Area;
use App\Cargo;
use App\Personal;
use App\User;
use App\Permisos;
use App\RequerimientosCliente;
use App\GenerSede;
use App\Respel;
use App\Cotizacion;
use App\Tarifa;
use App\Rango;
use App\ResiduosGener;



class registroexpressController extends Controller
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
            $Municipios = Municipio::select()->where('FK_MunCity', 6)->get();
        }
        return view('clientes.registroexpress', compact('Departamentos', 'Municipios', 'comerciales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteExpressStoreRequest $request)
    {
        // return $request;
        $Cliente = new Cliente();
        $Cliente->CliNit = $request->input('CliNit');
        $Cliente->CliName = $request->input('CliName');
        $Cliente->CliCategoria = 'ClientePrepago';
        $Cliente->CliSlug = hash('sha256', rand().time().$Cliente->CliName);
        $Cliente->CliDelete = 0;
        $Cliente->CliComercial = $request->input('CliComercial');
        $Cliente->CliShortname = $request->input('CliName');
        $Cliente->CliStatus = 'Autorizado';
        $Cliente->TipoFacturacion = 'Contado';
        $Cliente->save();

        $Sede = new Sede();
        $Sede->SedeName = 'Sede Principal';
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
        $Sede->FK_SedeCli = $Cliente->ID_Cli;
        $Sede->FK_SedeMun = $request->input('FK_SedeMun');
        $Sede->SedeDelete = 0;
        $Sede->save();

        $requerimiento = new RequerimientosCliente();
        $requerimiento->RequeCliBascula = 0;
        $requerimiento->RequeCliCapacitacion = 0;
        $requerimiento->RequeCliMasPerson = 0;
        $requerimiento->RequeCliVehicExclusive = 0;
        $requerimiento->RequeCliPlatform = 0;
        $requerimiento->FK_RequeClient = $Cliente->ID_Cli;
        $requerimiento->save();

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
        $Personal->PersFactura = 1;
        $Personal->PersAdmin = 1;
        $Personal->FK_PersCargo = $Cargo->ID_Carg;
        $Personal->save();

        $user = new User();
        $user->name = $Personal->PersFirstName;
        $user->email = $Personal->PersEmail;
        $user->password = bcrypt($Cliente->CliNit);
        $user->UsSlug = hash('sha256', rand().time().$Personal->PersEmail);
        $user->UsRol = "Cliente";
        $user->UsRolDesc = "Usuario General";
        $user->UsRol2 = "Cliente";
        $user->UsRolDesc2 = "Usuario General";
        $user->UsAvatar = "robot400x400.gif";
        $user->FK_UserPers = $Personal->ID_Pers;
        $user->save();

        /* crear generador*/

        $Gener = new Generador();
        $Gener->GenerNit = $Cliente->CliNit;
        $Gener->GenerName = $Cliente->CliName;
        // $Gener->GenerShortname = $Cliente->CliShortname;
        $Gener->GenerSlug = hash('sha256', rand().time().$Gener->GenerName);
        $Gener->FK_GenerCli = $Sede->ID_Sede;
        $Gener->GenerDelete = $Cliente->CliDelete;
        $Gener->save();

        $SGener = new GenerSede();
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

        /* crear residuos del cliente */

        $PublicRespels = Respel::with('SubcategoryRespelpublic.CategoryRP')
        ->where('RespelPublic', 1)
        ->where('RespelStatus', 'Aprobado')
        ->get();

        $Cotizacion = new Cotizacion();
        $Cotizacion->CotiNumero = 7;
        $Cotizacion->CotiFechaSolicitud = now();
        $Cotizacion->CotiDelete = 0;
        $Cotizacion->CotiStatus = "Aprobada";
        $Cotizacion->FK_CotiSede = $Sede->ID_Sede;
        $Cotizacion->save();

        foreach ($PublicRespels as $PublicRespel) {
            $PublicRespel->load('requerimientos');

            $newRespel = $PublicRespel->replicate();
            $newRespel->RespelSlug = hash('sha256', rand().time().$PublicRespel->RespelName);
            $newRespel->RespelPublic = 0;
            $newRespel->RespelStatus = 'Aprobado';
            $newRespel->FK_RespelCoti = $Cotizacion->ID_Coti;
            $newRespel->RespelStatusDescription = 'Residuo copiado automaticamente en la base de datos de SisPRO para servicios express';
            $newRespel->save();

            foreach($PublicRespel->requerimientos as $requerimiento)
            {
                if ($requerimiento->forevaluation == 1) {
                    $requerimiento->load('pretratamientosSelected');
                    $newrequerimiento = $requerimiento->replicate();
                    $newrequerimiento->ReqSlug = hash('md5', rand().time().$newRespel->ID_Respel);
                    $newrequerimiento->FK_ReqRespel = $newRespel->ID_Respel;
                    $newrequerimiento->ofertado = 1;
                    $newrequerimiento->save();

                    foreach($requerimiento->pretratamientosSelected as $pretratamientoSelected)
                    {
                        $newrequerimiento->pretratamientosSelected()->attach($pretratamientoSelected->ID_PreTrat);
                    }
                    /*se copian las tarifas y requerimientos*/
                    $tarifaparacopiar = Tarifa::with(['rangos'])
                    ->where('FK_TarifaReq', $requerimiento->ID_Req)->first();
                    $nuevatarifa = $tarifaparacopiar->replicate();
                    $nuevatarifa->FK_TarifaReq=$newrequerimiento->ID_Req;
                    $nuevatarifa->save();

                    foreach ($tarifaparacopiar->rangos as $rango) {
                        $rangoparacopiar = Rango::find($rango->ID_Rango);
                        $nuevarango = $rangoparacopiar->replicate();
                        $nuevarango->FK_RangoTarifa = $nuevatarifa->ID_Tarifa;
                        $nuevarango->save();
                    }
                }
            }

            $log = new audit();
            $log->AuditTabla="respel";
            $log->AuditType="Copiado en Cliente Express";
            $log->AuditRegistro=$newRespel->ID_Respel;
            $log->AuditUser=$Personal->PersEmail;
            $log->Auditlog=json_encode($newRespel->RespelName);
            $log->save();
        }

        /* relacionar los residuos con la sede del generador */
        $residuosdelcliente = Respel::select('ID_Respel')->where('FK_RespelCoti', $Cotizacion->ID_Coti)->get();
        foreach($residuosdelcliente as $Respel1){
            $ResiduoSedeGener = new ResiduosGener();
            $ResiduoSedeGener->FK_SGener = $SGener->ID_GSede;
            $ResiduoSedeGener->FK_Respel = $Respel1->ID_Respel;
            $ResiduoSedeGener->DeleteSGenerRes = 0;
            $ResiduoSedeGener->SlugSGenerRes = hash('sha256', rand().time().$ResiduoSedeGener->FK_Respel);
            $ResiduoSedeGener->save();
        }
        // is authenticated
        if (Auth::check()) {
            return redirect()->route('cliente-show', [$Cliente->CliSlug]);
        }else{
            return redirect()->route('registroexpress');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
