<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;
use App\Http\Requests\RespelStoreRequest;
use App\Http\Requests\RespelUpdateRequest;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\RespelMail;
use App\Mail\incompleteRespel;
use App\Mail\ResiduoNuevo;
use App\Mail\RespelCorregido;
use App\audit;
use App\Respel;
use App\Sede;
use App\Cotizacion;
use App\Tratamiento;
use App\Pretratamiento;
use App\Clasificacion;
use App\User;
use App\Requerimiento;
use App\Rango;
use App\ResiduosGener;
use App\SolicitudResiduo;
use App\Permisos;
use App\Tarifa;
use App\Personal;
use App\Categoryrespelpublic;

use App\Role;
use App\Cliente;

use Illuminate\Support\Arr;

class RespelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // $UserSedeID = DB::table('personals')
        //                 ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
        //                 ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
        //                 ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
        //                 ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
        //                 ->value('sedes.ID_Sede');
        //                 return $UserSedeID;
        $Respels = DB::table('respels')
            ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
            ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->join('personals', 'personals.ID_Pers', '=', 'clientes.CliComercial')
            ->select('respels.*', 'clientes.CliName', 'clientes.CliComercial', 'clientes.CliCategoria', 'personals.PersEmail', 'personals.PersFirstName', 'personals.PersLastName', 'personals.PersCellphone')
            ->where(function($query){
                switch (Auth::user()->UsRol) {
                    case 'Cliente':
                        /*se define la sede del usuario actual*/
                        $UserSedeID = DB::table('personals')
                        ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                        ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                        ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                        ->join('clientes', 'clientes.ID_Cli', 'sedes.FK_SedeCli')
                        ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                        ->value('clientes.ID_Cli');
                        // return $UserSedeID;
                        $query->where('respels.RespelDelete',0);
                        $query->where('respels.RespelPublic',0);
                        $query->where('clientes.ID_Cli', $UserSedeID);
                        break;

                    case 'Comercial':
                        /*se define la sede del usuario actual*/
                        $ComercialAsignado = DB::table('personals')
                        ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                        ->value('personals.ID_Pers');

                        $query->where('respels.RespelDelete',0);
                        $query->where('respels.RespelPublic',0);
                        $query->where('clientes.CliComercial', $ComercialAsignado);
                        break;
                    
                    default:
                        $query->where('respels.RespelDelete',0);
                        $query->where('respels.RespelPublic',0);
                        break;
                }
            })
            ->where('clientes.CliCategoria', 'Cliente')
            ->get();

            foreach ($Respels as $key => $value) {
                $requerimiento = Requerimiento::where('FK_ReqRespel', $Respels[$key]->ID_Respel)
                ->where('forevaluation', 1)
                ->where('ofertado', 1)
                ->first();

                if (isset($requerimiento->FK_ReqTrata) && $requerimiento->ofertado == 1) {
                    $tratamiento = Tratamiento::where('ID_Trat', $requerimiento->FK_ReqTrata)->first('TratName');
                    if (isset($tratamiento->TratName)) {
                        $Respels[$key]->TratName = $tratamiento->TratName;
                    }else{
                        $Respels[$key]->TratName = '';
                    }
                }else{
                    $Respels[$key]->TratName = '';
                }
                
            }
            // return $Respels->pluck('TratName');
 
        return view('respels.index', compact('Respels')); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
            $Sede = DB::table('personals')
                ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                ->select('sedes.ID_Sede')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->get();
            $tratamientos = Tratamiento::where('FK_TratProv', 1)->get();

            return view('respels.create', compact('Sede', 'tratamientos'));
        }elseif(in_array(Auth::user()->UsRol, Permisos::RESPELPUBLIC) || in_array(Auth::user()->UsRol2, Permisos::RESPELPUBLIC)){
            $Sedes = DB::table('clientes')
                ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('sedes.ID_Sede', 'clientes.CliName')
                ->where('clientes.ID_Cli', '<>', 1) 
                ->get();
            $tratamientos = Tratamiento::where('FK_TratProv', 1)->get();
            $categories = Categoryrespelpublic::all();
            return view('respels.create', compact('Sedes', 'categories', 'tratamientos'));
        }else{
            abort(403);
        }
    }

    /**
     * store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RespelStoreRequest $request)
    {   

        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
            $UserSedeID = DB::table('personals')
                ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->value('sedes.ID_Sede');
        }else{
            $UserSedeID = $request->input('Sede');
        }
        // return $request;
        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
            /*se crea un nueva cotizacion solo si el cliente no tiene cotizaciones pendientes*/
            $Cotizacion = new Cotizacion();
            $Cotizacion->CotiNumero = 7;
            $Cotizacion->CotiFechaSolicitud = now();
            $Cotizacion->CotiDelete = 0;
            $Cotizacion->CotiStatus = "Aprobada";
            $Cotizacion->FK_CotiSede = $UserSedeID;
            $Cotizacion->save();
        }
        

        for ($x=0; $x < count($request['RespelName']); $x++) {
            /*validar si el formulario incluye archivos de tarjeta de emergencia u hoja de seguridad*/
            $respel = new Respel();

            if (isset($request['RespelHojaSeguridad'][$x])) {
                $file1 = $request['RespelHojaSeguridad'][$x];
                $hoja = hash('sha256', rand().time().$file1->getClientOriginalName()).'.pdf';

                $file1->move(public_path().'/img/HojaSeguridad/',$hoja);
            }
            else{
                $hoja = 'RespelHojaDefault.pdf';
            }

             /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelTarj'][$x])) {
                $file2 = $request['RespelTarj'][$x];
                $tarj = hash('sha256', rand().time().$file2->getClientOriginalName()).'.pdf';
                $file2->move(public_path().'/img/TarjetaEmergencia/',$tarj);
            }else{
                $tarj = 'RespelTarjetaDefault.pdf';
            }

             /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelFoto'][$x])) {
                $file3 = $request['RespelFoto'][$x];
                $foto = hash('sha256', rand().time().$file3->getClientOriginalName()).'.png';
                $file3->move(public_path().'/img/fotoRespelCreate/',$foto);
            }else{
                $foto = 'RespelFotoDefault.png';
            }
    
            /*verificar si se cargo un documento en este campo*/
            if (isset($request['SustanciaControladaDocumento'][$x])) {
                $file4 = $request['SustanciaControladaDocumento'][$x];
                $ctrlDoc = hash('sha256', rand().time().$file4->getClientOriginalName()).'.pdf';
                $file4->move(public_path().'/img/SustanciaControlDoc/',$ctrlDoc);
            }else{
                $ctrlDoc = 'SustanciaControlDocDefault.pdf';
            }

            /*se verifica el rol de usuario para asignar un status al residuo*/
            // FALTA antes: Programador y cliente

            // if (in_array(Auth::user()->UsRol, Permisos::CLIENTEYADMINS)) {
            //     $statusinicial="Pendiente";
            // }
            $respel->RespelName = $request['RespelName'][$x];
            $respel->RespelDescrip = $request['RespelDescrip'][$x];
            $respel->RespelIgrosidad = $request['RespelIgrosidad'][$x];
            $respel->YRespelClasf4741 = $request['YRespelClasf4741'][$x];
            $respel->ARespelClasf4741 = $request['ARespelClasf4741'][$x];
            $respel->RespelEstado = $request['RespelEstado'][$x];

            // se verifica si la sustancia esta marcada como controlada
            if (isset($request['SustanciaControlada'][$x])&&($request['SustanciaControlada'][$x]==1)) {
                $respel->SustanciaControlada = $request['SustanciaControlada'][$x];
                $respel->SustanciaControladaTipo = $request['SustanciaControladaTipo'][$x];
                $respel->SustanciaControladaNombre = $request['SustanciaControladaNombre'][$x];
                $respel->SustanciaControladaDocumento = $ctrlDoc;
            }else{
                $respel->SustanciaControlada = 0;
            }
            $respel->RespelStatus = "Pendiente";
            // $respel->RespelStatus = $statusinicial;
            $respel->RespelHojaSeguridad = $hoja;
            $respel->RespelTarj = $tarj;
            $respel->RespelFoto = $foto;
            $respel->FK_RespelCoti = $Cotizacion->ID_Coti;
            if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
                $respel->FK_RespelCoti = $Cotizacion->ID_Coti;
                $respel->RespelPublic = 0;
            }else{
                $respel->FK_RespelCoti = 1;
                $respel->RespelPublic = 1;
                $respel->FK_SubCategoryRP = $request['FK_SubCategoryRP'];
            }
            $respel->RespelSlug = hash('sha256', rand().time().$respel->RespelName);
            $respel->RespelDelete = 0;
            $respel->RespelDeclaracion = $request['RespelDeclaracion'][$x];
            $respel->save();

            $requerimiento = new Requerimiento();
            $requerimiento->ofertado=1;
            $requerimiento->FK_ReqRespel=$respel->ID_Respel;
            $requerimiento->forevaluation=1;
            $requerimiento->FK_ReqTrata=$request['RespelTratamiento'][$x];
            $requerimiento->ReqSlug= hash('md5', rand().time().$respel->ID_Respel);
            $requerimiento->save();

            $tratamiento = Tratamiento::where('ID_Trat', $request['RespelTratamiento'][$x])->first();

            $tarifa = new Tarifa();
            $tarifa->TarifaFrecuencia='Servicio';
            $tarifa->TarifaVencimiento='2025-11-15';
            if ($tratamiento->TratName == 'Posconsumo luminarias') {
                $tarifa->Tarifatipo='Unid';
            }else{
                $tarifa->Tarifatipo='Kg';
            }
            $tarifa->TarifaDelete=0;
            $tarifa->FK_TarifaReq=$requerimiento->ID_Req;
            $tarifa->save();

            $rango = new Rango();
            $rango->TarifaPrecio=1500;
            $rango->TarifaDesde=1;
            $rango->FK_RangoTarifa=$tarifa->ID_Tarifa;
            $rango->save();

            if($respel->RespelStatus === "Pendiente"){
                /*se verifican los datos de las sede y y cliente segun el usuarios que registra el residuo*/
                $respel['cliente'] = DB::table('personals')
                    ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                    ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                    ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                    ->join('clientes', 'clientes.ID_Cli', 'sedes.FK_SedeCli')
                    ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                    ->select(['sedes.SedeName', 'clientes.CliName', 'clientes.CliComercial'])
                    ->first();

                // se verifica si el cliente tiene comercial asignado
                // se establece la lista de destinatarios
                if ($respel['cliente']->CliComercial <> null) {
                    $comercial = Personal::where('ID_Pers', $respel['cliente']->CliComercial)->first();
                    $destinatarios = ['gerenteplanta@prosarc.com.co', 'dirtecnica@prosarc.com.co', $comercial->PersEmail];
                }else{
                    $comercial = "";
                    $destinatarios = ['gerenteplanta@prosarc.com.co', 'dirtecnica@prosarc.com.co'];
                }

                $respel['comercial'] = $comercial;
                $respel['personalcliente'] = Personal::where('ID_Pers', Auth::user()->FK_UserPers)->first();
                

                // se envia un correo por cada residuo registrado
                Mail::to($destinatarios)->send(new ResiduoNuevo($respel));
                // return new ResiduoNuevo($respel);
            }
        }

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Nuevo respel";
        $log->AuditRegistro=$respel->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();
        return redirect()->route('respels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Respels = Respel::where('RespelSlug', $id)->first();

        if ($Respels->RespelDelete == 1) {
            abort(404);
        }

        /*se  verifica si el residuo tiene alguna registro hijo o dependiente*/
        $ResiduoConDependencia1 = ResiduosGener::where('FK_Respel', $Respels->ID_Respel)->first();
        $ResiduoConDependencia2 = Requerimiento::where('FK_ReqRespel', $Respels->ID_Respel)->first();

        if ($Respels->RespelStatus=='Rechazado'||$Respels->RespelStatus=='Incompleto'||$Respels->RespelStatus=='Pendiente') {
            $deleteButton = 'borrable';
        }else{
            $deleteButton = 'No borrable';
        }

        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE))
            if ($Respels->RespelStatus=='Rechazado'||$Respels->RespelStatus=='Incompleto'||$Respels->RespelStatus=='Falta TDE'||$Respels->RespelStatus=='Pendiente'||$Respels->RespelStatus=='TDE actualizada') {
                $editButton = 'Editable';
            }else{
                $editButton = 'No editable';
            }
        else{
            $editButton = 'Editable';
        }

        //consultar cuales son los tratamientos viabiizados por jefe de operaciones
        $requerimientos = Requerimiento::with(['pretratamientosSelected'])
        ->where('FK_ReqRespel', '=', $Respels->ID_Respel)
        ->where('forevaluation', '=', 1)
        ->get();

        

        // se incorporan las tarifas al array                
        foreach ($requerimientos as $requerimiento) {
            $tarifas = Tarifa::with(['rangos'])
            ->where('FK_TarifaReq', '=', $requerimiento->ID_Req)
            ->get();
            $requerimiento['tarifas'] = $tarifas;
            $requerimiento['tratamientos'] = Tratamiento::with(['pretratamientos'])
            ->where('ID_Trat', '=', $requerimiento['FK_ReqTrata'] )
            ->get();
        }

        return view('respels.show', compact('Respels', 'requerimientos', 'editButton', 'deleteButton'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*se verifican el rol del usuario para dar acceso a la edicion de respel o evaluacion de respel*/
        if(in_array(Auth::user()->UsRol, Permisos::GrupoEdicionRespel) || in_array(Auth::user()->UsRol2, Permisos::GrupoEvaluacionRespel)){

            $Respels = Respel::where('RespelSlug', $id)->first();

            //Tabla tratamientos con su respectivo gestor
            $tratamientos = DB::table('tratamientos')
                ->join('sedes', 'sedes.ID_Sede', '=', 'tratamientos.FK_TratProv')
                ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                ->select('sedes.*', 'clientes.*', 'tratamientos.*')
                ->where('TratDelete', 0)
                ->get();


            if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
                /*se valida que el residuo no este eliminado*/
                if ($Respels->RespelDelete == 1) {
                    abort(404);
                }
                // se verifica el rol y el status del residuo para saber si se puede editar
                $statusRespel = $Respels->RespelStatus;

                /*se  verifica si el residuo tiene alguna registro hijo o dependiente*/
                $ResiduoConDependencia1 = ResiduosGener::where('FK_Respel', $Respels->ID_Respel)->first();
                $ResiduoConDependencia2 = Requerimiento::where('FK_ReqRespel', $Respels->ID_Respel)->first();

                if ($ResiduoConDependencia1||$ResiduoConDependencia2) {
                    $deleteButton = 'No borrable';
                }else{
                    $deleteButton = 'borrable';
                } 

                $Sede = DB::table('personals')
                    ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                    ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                    ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                    ->select('sedes.ID_Sede')
                    ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                    ->get();

                /*el Cliente solo puede editar pendientes e incompletos*/
                switch ($statusRespel) {
                    case 'Aprobado':
                        return view('respels.edit', compact('Respels', 'Sede', 'Requerimientos', 'tratamientos'));
                        break;
                    case 'Pendiente':
                        return view('respels.edit', compact('Respels', 'Sede', 'Requerimientos', 'tratamientos'));
                        break;
                    case 'Incompleto':
                        return view('respels.edit', compact('Respels', 'Sede', 'Requerimientos', 'tratamientos'));
                        break;
                    case 'Falta TDE':
                        return view('respels.editTDE', compact('Respels', 'Sede', 'Requerimientos', 'tratamientos'));
                        break;
                    case 'TDE actualizada':
                        return view('respels.editTDE', compact('Respels', 'Sede', 'Requerimientos', 'tratamientos'));
                        break;
                    default:
                        abort(403);
                        break;
                }
            }else{
                $tratamientosViables = Clasificacion::with(['tratamientosConGestor'])
                ->where('ClasfCode', '=', $Respels['ARespelClasf4741'])
                ->orWhere('ClasfCode', '=', $Respels['YRespelClasf4741'])
                ->get();

                // return $tratamientosViables;
                //consultar cuales son los tratamientos viabiizados por jefe de operaciones
                $requerimientos = Requerimiento::with(['pretratamientosSelected'])
                ->where('FK_ReqRespel', '=', $Respels->ID_Respel)
                ->where('forevaluation', '=', 1)
                ->get();
                // se incorporan las tarifas al array                
                foreach ($requerimientos as $requerimiento) {
                    // adjuntar tarifas relacionadas
                    $requerimiento['tarifas'] = Tarifa::with(['rangos'])
                    ->where('FK_TarifaReq', '=', $requerimiento->ID_Req)
                    ->get();
                    
                    // adjuntar tratamientos relacionadas
                    $requerimiento['tratamientos'] = Tratamiento::with(['pretratamientos'])
                    ->where('ID_Trat', '=', $requerimiento['FK_ReqTrata'] )
                    ->get();

                    // validar si el requerimiento se encuentra en uso
                    $usado = SolicitudResiduo::where('FK_SolResRequerimiento', '=', $requerimiento->ID_Req)
                    ->get('FK_SolResRequerimiento');
                    // return $usado;
                    
                    // if (count($usado)>0) {
                    //     return $usado;
                    // }
                    if (count($usado)>0) {
                        $requerimiento['en_uso'] = 1;
                    }else{
                        $requerimiento['en_uso'] = 0;
                    }
                }

                // return $requerimientos;
                $Sedes = DB::table('clientes')
                    ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                    ->select('sedes.ID_Sede', 'sedes.SedeName')
                    ->where('clientes.ID_Cli', '<>', 1)
                    ->get();
                // return $requerimientos;
                return view('respels.edit', compact('Respels', 'Sedes', 'requerimientos', 'tratamientos', 'tratamientosViables'));
            }
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
    public function update(RespelUpdateRequest $request, $id)
    {
        // return $request;
        $respel = Respel::where('RespelSlug', $id)->first();

        if (!$respel) {
            abort(404);
        }

        $originalAttributes = $respel->getOriginal();
        // $originalUsername = $originalAttributes['username']; 

        if (isset($request['RespelHojaSeguridad'])) {
            if($respel->RespelHojaSeguridad <> null && file_exists(public_path().'/img/HojaSeguridad/'.$respel->RespelHojaSeguridad)){
                unlink(public_path().'/img/HojaSeguridad/'.$respel->RespelHojaSeguridad);
            }
            $file1 = $request['RespelHojaSeguridad'];
            $hoja = hash('sha256', rand().time().$file1->getClientOriginalName()).'.pdf';
            $file1->move(public_path().'/img/HojaSeguridad/',$hoja);
        }
        else{
            $hoja = $respel->RespelHojaSeguridad;
        }

            /*verificar si se cargo un documento en este campo*/
        if (isset($request['RespelTarj'])) {
            if($respel->RespelTarj <> null && file_exists(public_path().'/img/TarjetaEmergencia/'.$respel->RespelTarj)){
                unlink(public_path().'/img/TarjetaEmergencia/'.$respel->RespelTarj);
            }
            $file2 = $request['RespelTarj'];
            $tarj = hash('sha256', rand().time().$file2->getClientOriginalName()).'.pdf';
            $file2->move(public_path().'/img/TarjetaEmergencia/',$tarj);
        }else{
            $tarj = $respel->RespelTarj;
        }

            /*verificar si se cargo un documento en este campo*/
        if (isset($request['RespelFoto'])) {
            if($respel->RespelFoto <> null && file_exists(public_path().'/img/fotoRespelCreate/'.$respel->RespelFoto)){
                unlink(public_path().'/img/fotoRespelCreate/'.$respel->RespelFoto);
            }
            $file3 = $request['RespelFoto'];
            $foto = hash('sha256', rand().time().$file3->getClientOriginalName()).'.png';
            $file3->move(public_path().'/img/fotoRespelCreate/',$foto);
        }else{
            $foto = $respel->RespelFoto;
        }
        
        /*verificar si se cargo un documento en este campo*/
        if (isset($request['SustanciaControladaDocumento'])) {
            if($respel->SustanciaControladaDocumento <> null && file_exists(public_path().'/img/SustanciaControlDoc/'.$respel->SustanciaControladaDocumento)){
                unlink(public_path().'/img/SustanciaControlDoc/'.$respel->SustanciaControladaDocumento);
            }
            $file4 = $request['SustanciaControladaDocumento'];
            $ctrlDoc = hash('sha256', rand().time().$file4->getClientOriginalName()).'.pdf';
            $file4->move(public_path().'/img/SustanciaControlDoc/',$ctrlDoc);
        }else{
            $ctrlDoc = $respel->SustanciaControladaDocumento;
        }

        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
            $respel->RespelStatus = "Pendiente";
        }else{
            $respel->RespelStatus = $request['RespelStatus'];
        }

        $respel->RespelName = $request['RespelName'];
        $respel->RespelDescrip = $request['RespelDescrip'];
        $respel->RespelIgrosidad = $request['RespelIgrosidad'];
        $respel->YRespelClasf4741 = $request['YRespelClasf4741'];
        $respel->ARespelClasf4741 = $request['ARespelClasf4741'];
        $respel->RespelEstado = $request['RespelEstado'];
        $respel->SustanciaControlada = $request['SustanciaControlada'];
        $respel->SustanciaControladaTipo = $request['SustanciaControladaTipo'];
        $respel->SustanciaControladaNombre = $request['SustanciaControladaNombre'];
        $respel->RespelHojaSeguridad = $hoja;
        $respel->RespelTarj = $tarj;
        $respel->RespelFoto = $foto;
        $respel->SustanciaControladaDocumento = $ctrlDoc;
        $respel->RespelDeclaracion = $request['RespelDeclaracion'];
        $respel->update();

        if (isset($request['RespelTratamiento'])) {
            $requerimiento = Requerimiento::where('FK_ReqRespel', $respel->ID_Respel)
            ->where('ofertado', 1)
            ->where('forevaluation', 1)
            ->first();
            $requerimiento->FK_ReqTrata=$request['RespelTratamiento'];
            $requerimiento->update();
        }

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$respel->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) && $originalAttributes['RespelStatus'] === 'Incompleto' && $respel->RespelStatus === 'Pendiente') {
            /*se verifican los datos de las sede y y cliente segun el usuarios que registra el residuo*/
            $respel['cliente'] = DB::table('personals')
                ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                ->join('clientes', 'clientes.ID_Cli', 'sedes.FK_SedeCli')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->select(['sedes.SedeName', 'clientes.CliName', 'clientes.CliComercial'])
                ->first();

            // se establece la lista de destinatarios
            if ($respel['cliente']->CliComercial <> null) {
                $comercial = Personal::where('ID_Pers', $respel['cliente']->CliComercial)->first();
                $destinatarios = ['dirtecnica@prosarc.com.co', $comercial->PersEmail];
            }else{
                $comercial = "";
                $destinatarios = ['dirtecnica@prosarc.com.co'];
            }
            
            $respel['comercial'] = $comercial;
            $respel['personalcliente'] = Personal::where('ID_Pers', Auth::user()->FK_UserPers)->first();

            // se envia un correo por cada residuo registrado
            Mail::to($destinatarios)->send(new RespelCorregido($respel));
        }
        
        return redirect()->route('respels.show', [$respel->RespelSlug]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Respels = Respel::where('RespelSlug', $id)->first();
        if (!$Respels) {
            abort(404);
        }
        switch (Auth::user()->UsRol) {
            case 'Programador':
                if ($Respels->RespelDelete == 0) {
                    $Respels->RespelDelete = 1;
                }
                else{
                    $Respels->RespelDelete = 0;
                }
                break;
            default:
                if ($Respels->RespelDelete == 0) {
                    $Respels->RespelDelete = 1;
                }
                else{
                    abort(403);
                }
                break;
        }
        $Respels->save();

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$Respels->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$Respels->RespelDelete;
        $log->save();

        return redirect()->route('respels.index');
    }
      /**
     * actualiza el status del residuo .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatusRespel(Request $request, $id)
    {      
        // return $request;
        $respel = Respel::where('RespelSlug', $id)->first();
        $opciones = $request->Opcion;

        if (in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL)) {
            /*se eliminan los requerimientos relacionados*/
            $requerimientosparaBorrar = Requerimiento::where('FK_ReqRespel', $respel->ID_Respel)
            ->where('forevaluation', 1)
            ->get();
            foreach ($requerimientosparaBorrar as $key => $value) {
                $value->pretratamientosSelected()->detach();
                $deletedRequerimientos = Requerimiento::where('ID_Req', $value['ID_Req'])->delete();
            }

            if ($opciones) {
                foreach ($opciones as $key => $value) {
                    if (isset($opciones[$key])) {
                        if (isset($opciones[$key]['ReqSlug'])&&($opciones[$key]['ReqSlug'])!="") {
                            // se actualiza el requerimiento segun corresponda
                            $requerimientoparaActualizar = Requerimiento::where('ReqSlug', $opciones[$key]['ReqSlug'])->first();
                            if (isset($opciones[$key]['Tratamiento'])) {
                               
                                if (isset($opciones[$key]['ReqFotoDescargue'])) {
                                    $requerimientoparaActualizar->ReqFotoDescargue=$opciones[$key]['ReqFotoDescargue'];
                                }
                                if (isset($opciones[$key]['ReqFotoDestruccion'])) {
                                    $requerimientoparaActualizar->ReqFotoDestruccion=$opciones[$key]['ReqFotoDestruccion'];
                                }
                                if (isset($opciones[$key]['ReqVideoDescargue'])) {
                                    $requerimientoparaActualizar->ReqVideoDescargue=$opciones[$key]['ReqVideoDescargue'];
                                }
                                if (isset($opciones[$key]['ReqVideoDestruccion'])) {
                                     $requerimientoparaActualizar->ReqVideoDestruccion=$opciones[$key]['ReqVideoDestruccion'];   
                                }
                                if (isset($opciones[$key]['ReqDevolucion'])) {
                                    $requerimientoparaActualizar->ReqDevolucion=$opciones[$key]['ReqDevolucion'];
                                }
                                if (isset($opciones[$key]['ReqAuditoria'])) {
                                    $requerimientoparaActualizar->ReqAuditoria=$opciones[$key]['ReqAuditoria'];
                                }
                                // requerimietnos automaticos?
                                if (isset($opciones[$key]['auto_ReqFotoDescargue'])) {
                                    $requerimientoparaActualizar->auto_ReqFotoDescargue=$opciones[$key]['auto_ReqFotoDescargue'];
                                }
                                if (isset($opciones[$key]['auto_ReqFotoDestruccion'])) {
                                    $requerimientoparaActualizar->auto_ReqFotoDestruccion=$opciones[$key]['auto_ReqFotoDestruccion'];
                                }
                                if (isset($opciones[$key]['auto_ReqVideoDescargue'])) {
                                    $requerimientoparaActualizar->auto_ReqVideoDescargue=$opciones[$key]['auto_ReqVideoDescargue'];
                                }
                                if (isset($opciones[$key]['auto_ReqVideoDestruccion'])) {
                                     $requerimientoparaActualizar->auto_ReqVideoDestruccion=$opciones[$key]['auto_ReqVideoDestruccion'];   
                                }
                                if (isset($opciones[$key]['auto_ReqDevolucion'])) {
                                    $requerimientoparaActualizar->auto_ReqDevolucion=$opciones[$key]['auto_ReqDevolucion'];
                                }
                                if (isset($opciones[$key]['auto_ReqAuditoria'])) {
                                    $requerimientoparaActualizar->auto_ReqAuditoria=$opciones[$key]['auto_ReqAuditoria'];
                                }

                                /*se adjunta los elementos relacionados al requerimiento*/
                                if (isset($request->TratOfertado) && $key == $request->TratOfertado) {
                                    $requerimientoparaActualizar->ofertado=1;
                                }else{
                                    $requerimientoparaActualizar->ofertado=0;
                                }
                                $requerimientoparaActualizar->FK_ReqRespel=$respel->ID_Respel;
                                $requerimientoparaActualizar->forevaluation=1;
                                $requerimientoparaActualizar->FK_ReqTrata=$opciones[$key]['Tratamiento'];
                                // $requerimientoparaActualizar->ReqSlug= hash('md5', rand().time().$respel->ID_Respel);
                                $requerimientoparaActualizar->save();

                                if (isset($opciones[$key]['Pretratamientos'])) {
                                    $requerimientoparaActualizar->pretratamientosSelected()->sync($opciones[$key]['Pretratamientos']);
                                }
                                /*se verifica que las tarifas no esten disabled en la vista*/
                                if (isset($opciones[$key]['TarifaFrecuencia'])) {
                                    // $tarifa = new Tarifa();
                                    $tarifa = Tarifa::where('FK_TarifaReq', $requerimientoparaActualizar->ID_Req)->first();
                                    $tarifa->TarifaFrecuencia=$opciones[$key]['TarifaFrecuencia'];
                                    $tarifa->TarifaVencimiento=$opciones[$key]['TarifaVencimiento'];   
                                    $tarifa->Tarifatipo=$opciones[$key]['Tarifatipo'];
                                    $tarifa->TarifaDelete=0;
                                    $tarifa->FK_TarifaReq=$requerimientoparaActualizar->ID_Req;
                                    $tarifa->save();

                                    foreach ($opciones[$key]['TarifaDesde'] as $key2 => $value2) {
                                       if ($opciones[$key]['TarifaPrecio'][$key2] != null) {
                                            if (isset($opciones[$key]['ID_Rango'][$key2])) {
                                                // $rango = new Rango();
                                               $rango = Rango::where('ID_Rango', $opciones[$key]['ID_Rango'][$key2])->first();
                                               $rango->TarifaPrecio=$opciones[$key]['TarifaPrecio'][$key2];
                                               $rango->TarifaDesde=$opciones[$key]['TarifaDesde'][$key2];
                                               $rango->FK_RangoTarifa=$tarifa->ID_Tarifa;
                                               $rango->save(); 
                                            }else{
                                               $rango = new Rango();
                                               $rango->TarifaPrecio=$opciones[$key]['TarifaPrecio'][$key2];
                                               $rango->TarifaDesde=$opciones[$key]['TarifaDesde'][$key2];
                                               $rango->FK_RangoTarifa=$tarifa->ID_Tarifa;
                                               $rango->save(); 
                                            }
                                       }else{
                                            if (isset($opciones[$key]['ID_Rango'][$key2])) {
                                                // $rango = new Rango();
                                               $rango = Rango::where('ID_Rango', $opciones[$key]['ID_Rango'][$key2])->first();
                                               // $rango->TarifaPrecio=0;
                                               // $rango->TarifaDesde=0;
                                               // $rango->FK_RangoTarifa=$tarifa->ID_Tarifa;
                                               $rango->delete(); 
                                            }
                                       }            
                                    }
                                }
                            }
                        }else{
                            // se crea un requerimiento por cada opcion
                            if (isset($opciones[$key]['Tratamiento'])) {
                               
                                $requerimiento = new Requerimiento();
                                if (isset($opciones[$key]['ReqFotoDescargue'])) {
                                    $requerimiento->ReqFotoDescargue=$opciones[$key]['ReqFotoDescargue'];
                                }
                                if (isset($opciones[$key]['ReqFotoDestruccion'])) {
                                    $requerimiento->ReqFotoDestruccion=$opciones[$key]['ReqFotoDestruccion'];
                                }
                                if (isset($opciones[$key]['ReqVideoDescargue'])) {
                                    $requerimiento->ReqVideoDescargue=$opciones[$key]['ReqVideoDescargue'];
                                }
                                if (isset($opciones[$key]['ReqVideoDestruccion'])) {
                                     $requerimiento->ReqVideoDestruccion=$opciones[$key]['ReqVideoDestruccion'];   
                                }
                                if (isset($opciones[$key]['ReqDevolucion'])) {
                                    $requerimiento->ReqDevolucion=$opciones[$key]['ReqDevolucion'];
                                }
                                if (isset($opciones[$key]['ReqAuditoria'])) {
                                    $requerimiento->ReqAuditoria=$opciones[$key]['ReqAuditoria'];
                                }

                                if (isset($opciones[$key]['auto_ReqFotoDescargue'])) {
                                    $requerimiento->auto_ReqFotoDescargue=$opciones[$key]['auto_ReqFotoDescargue'];
                                }
                                if (isset($opciones[$key]['auto_ReqFotoDestruccion'])) {
                                    $requerimiento->auto_ReqFotoDestruccion=$opciones[$key]['auto_ReqFotoDestruccion'];
                                }
                                if (isset($opciones[$key]['auto_ReqVideoDescargue'])) {
                                    $requerimiento->auto_ReqVideoDescargue=$opciones[$key]['auto_ReqVideoDescargue'];
                                }
                                if (isset($opciones[$key]['auto_ReqVideoDestruccion'])) {
                                     $requerimiento->auto_ReqVideoDestruccion=$opciones[$key]['auto_ReqVideoDestruccion'];   
                                }
                                if (isset($opciones[$key]['auto_ReqDevolucion'])) {
                                    $requerimiento->auto_ReqDevolucion=$opciones[$key]['auto_ReqDevolucion'];
                                }
                                if (isset($opciones[$key]['auto_ReqAuditoria'])) {
                                    $requerimiento->auto_ReqAuditoria=$opciones[$key]['auto_ReqAuditoria'];
                                }

                                /*se adjunta los elementos relacionados al requerimiento*/
                                if (isset($request->TratOfertado) && $key == $request->TratOfertado) {
                                    $requerimiento->ofertado=1;
                                }else{
                                    $requerimiento->ofertado=0;
                                }
                                $requerimiento->FK_ReqRespel=$respel->ID_Respel;
                                $requerimiento->forevaluation=1;
                                $requerimiento->FK_ReqTrata=$opciones[$key]['Tratamiento'];
                                $requerimiento->ReqSlug= hash('md5', rand().time().$respel->ID_Respel);
                                $requerimiento->save();

                                if (isset($opciones[$key]['Pretratamientos'])) {
                                    $requerimiento->pretratamientosSelected()->attach($opciones[$key]['Pretratamientos']);
                                }
                                /*se verifica que las tarifas no esten disabled en la vista*/
                                if (isset($opciones[$key]['TarifaFrecuencia'])) {
                                    $tarifa = new Tarifa();
                                    $tarifa->TarifaFrecuencia=$opciones[$key]['TarifaFrecuencia'];
                                    $tarifa->TarifaVencimiento=$opciones[$key]['TarifaVencimiento'];   
                                    $tarifa->Tarifatipo=$opciones[$key]['Tarifatipo'];
                                    $tarifa->TarifaDelete=0;
                                    $tarifa->FK_TarifaReq=$requerimiento->ID_Req;
                                    $tarifa->save();

                                    foreach ($opciones[$key]['TarifaDesde'] as $key2 => $value2) {
                                       if ($opciones[$key]['TarifaPrecio'][$key2] != null) {
                                           $rango = new Rango();
                                           $rango->TarifaPrecio=$opciones[$key]['TarifaPrecio'][$key2];
                                           $rango->TarifaDesde=$opciones[$key]['TarifaDesde'][$key2];
                                           $rango->FK_RangoTarifa=$tarifa->ID_Tarifa;
                                           $rango->save(); 
                                       }               
                                    }
                                }
                            }
                        }
                        
                    }
                }
            }
            $respel->RespelStatus = $request['RespelStatus'];
            $respel->RespelStatusDescription = $request['RespelStatusDescription'];
            $respel->updated_at = now();
            $respel->save();
        }else{
            abort(401, 'No Autorizado');
        }
        

        /*auditoria de la actualizacion*/
        $log = new audit();
        $log->AuditTabla="respels requerimiento y tarifas";
        $log->AuditType="Evaluacion Updated";
        $log->AuditRegistro=$respel->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        if($respel->RespelPublic === 0){
            switch ($respel->RespelStatus) {
                case 'Aprobado':
                    return redirect()->route('email-respel', [$respel->RespelSlug]);
                    break;

                case 'Incompleto':
                    $comercial = Personal::where('ID_Pers', $respel->Cotizacion->Sede->clientes->CliComercial)->pluck('PersEmail');
                    $personalCliente = Personal::whereHas('cargo.area.sede', function ($query) use ($respel) {
                        $query->where('ID_Sede', $respel->Cotizacion->Sede->ID_Sede);
                    })->pluck('PersEmail');
		            Mail::to($comercial)->cc($personalCliente)->send(new incompleteRespel($respel));
                    break;

                default:
                    # code...
                    break;
            }
        }
        
        // return redirect()->route('respels.edit', [$respel->RespelSlug]);
        if ($respel->RespelPublic === 1) {
            return redirect()->route('respelspublic.index');
        }else{
            return redirect()->route('respels.index');
        }
    }

      /**
     * actualiza el status del residuo .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createPublicRespel(Request $request, $id)
    {      
        // return $request->Opcion[0]['TarifaFrecuencia'];
        $respel = Respel::where('RespelSlug', $id)->first();
        $opciones = $request->Opcion;
        // return $request;
        // return $tarifasparaBorrar;
        if (in_array(Auth::user()->UsRol, Permisos::SUPERVISOR)) {
            return redirect()->route('respels.show', [$respel->RespelSlug]);
        }
        if (in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL)) {
            /*se eliminan los requerimientos relacionados*/
            $requerimientosparaBorrar = Requerimiento::where('FK_ReqRespel', $respel->ID_Respel)->get();
            foreach ($requerimientosparaBorrar as $key => $value) {
                $value->pretratamientosSelected()->detach();
                $deletedRequerimientos = Requerimiento::where('ID_Req', $value['ID_Req'])->delete();
            }
        }

        if (in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL)) {
            if ($opciones) {
                foreach ($opciones as $key => $value) {
                    if ($opciones[$key]) {
                        // se crea un requerimiento por cada opcion
                        if (isset($opciones[$key]['Tratamiento'])) {
                           
                            $requerimiento = new Requerimiento();
                            if (isset($opciones[$key]['ReqFotoDescargue'])) {
                                $requerimiento->ReqFotoDescargue=$opciones[$key]['ReqFotoDescargue'];
                            }
                            if (isset($opciones[$key]['ReqFotoDestruccion'])) {
                                $requerimiento->ReqFotoDestruccion=$opciones[$key]['ReqFotoDestruccion'];
                            }
                            if (isset($opciones[$key]['ReqVideoDescargue'])) {
                                $requerimiento->ReqVideoDescargue=$opciones[$key]['ReqVideoDescargue'];
                            }
                            if (isset($opciones[$key]['ReqVideoDestruccion'])) {
                                 $requerimiento->ReqVideoDestruccion=$opciones[$key]['ReqVideoDestruccion'];   
                            }
                            if (isset($opciones[$key]['ReqDevolucion'])) {
                                $requerimiento->ReqDevolucion=$opciones[$key]['ReqDevolucion'];
                            }
                            if (isset($opciones[$key]['ReqAuditoria'])) {
                                $requerimiento->ReqAuditoria=$opciones[$key]['ReqAuditoria'];
                            }
                            /*se adjunta los elementos relacionados al requerimiento*/
                            if (isset($request->TratOfertado) && $key == $request->TratOfertado) {
                                $requerimiento->ofertado=1;
                            }else{
                                $requerimiento->ofertado=0;
                            }
                            $requerimiento->FK_ReqRespel=$respel->ID_Respel;
                            $requerimiento->FK_ReqTrata=$opciones[$key]['Tratamiento'];
                            $requerimiento->ReqSlug= hash('md5', rand().time().$respel->ID_Respel);
                            $requerimiento->save();

                            if (isset($opciones[$key]['Pretratamientos'])) {
                                $requerimiento->pretratamientosSelected()->attach($opciones[$key]['Pretratamientos']);
                            }
                            /*se verifica que las tarifas no esten disabled en la vista*/
                            if (isset($opciones[$key]['TarifaFrecuencia'])) {
                                $tarifa = new Tarifa();
                                $tarifa->TarifaFrecuencia=$opciones[$key]['TarifaFrecuencia'];
                                $tarifa->TarifaVencimiento=$opciones[$key]['TarifaVencimiento'];   
                                $tarifa->Tarifatipo=$opciones[$key]['Tarifatipo'];
                                $tarifa->TarifaDelete=0;
                                $tarifa->FK_TarifaReq=$requerimiento->ID_Req;
                                $tarifa->save();

                                foreach ($opciones[$key]['TarifaDesde'] as $key2 => $value2) {
                                   if ($opciones[$key]['TarifaPrecio'][$key2] != null) {
                                       $rango = new Rango();
                                       $rango->TarifaPrecio=$opciones[$key]['TarifaPrecio'][$key2];
                                       $rango->TarifaDesde=$opciones[$key]['TarifaDesde'][$key2];
                                       $rango->FK_RangoTarifa=$tarifa->ID_Tarifa;
                                       $rango->save(); 
                                   }               
                                }
                            }
                        }
                    }
                }
            }  
        }
        $respel->RespelStatus = $request['RespelStatus'];
        $respel->RespelStatusDescription = $request['RespelStatusDescription'];
        $respel->save();

        /*auditoria de la actualizacion*/
        $log = new audit();
        $log->AuditTabla="respels requerimiento y tarifas";
        $log->AuditType="Evaluacion Updated";
        $log->AuditRegistro=$respel->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        if($respel->RespelStatus === "Aprobado"){
            // new  RespelMail($slug);
            return redirect()->route('email-respel', [$respel->RespelSlug]);
        }
        return redirect()->route('respels.edit', [$respel->RespelSlug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTDE(Request $request, $id)
    {
        $respel = Respel::where('RespelSlug', $id)->first();
        if (!$respel) {
            abort(404);
        }
        // return $request;
        /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelTarj'])) {
                if($respel->RespelTarj <> null && file_exists(public_path().'/img/TarjetaEmergencia/'.$respel->RespelTarj)){
                    // unlink(public_path().'/img/TarjetaEmergencia/'.$respel->RespelTarj);
                }
                $file2 = $request['RespelTarj'];
                $tarj = hash('sha256', rand().time().$file2->getClientOriginalName()).'.pdf';
                $file2->move(public_path().'/img/TarjetaEmergencia/',$tarj);
                $newTDE = "TDE actualizada";
            }else{
                $tarj = $respel->RespelTarj;
                $newTDE = $respel->RespelStatus;
            }   
        $respel->RespelTarj = $tarj;
        $respel->RespelStatus = $newTDE;
        $respel->save();

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$respel->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog="actualizada la tarjeta de emergencia";
        $log->save();

        return redirect()->route('respels.index');
    }

    public function vencidos()
    {
        if (in_array(Auth::user()->UsRol, Permisos::TODOPROSARC)) {
            $user = Auth::user()->UsRol; 
            $requerimientos = Requerimiento::with(['respel.cotizacion.sede.clientes', 'tarifa.rangos'])
            ->where('ofertado', '1')->get();
            /*$requerimientos['personal'] = Personal::all();*/
            $personals = Personal::all();
            /*return $personal;*/
            return view ('respels.vencidos', compact('requerimientos', 'user', 'personals'));

        }else{
            abort(403); 
        }
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexExpress(){
        // $UserSedeID = DB::table('personals')
        //                 ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
        //                 ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
        //                 ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
        //                 ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
        //                 ->value('sedes.ID_Sede');
        //                 return $UserSedeID;
        $Respels = DB::table('respels')
            ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
            ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->join('personals', 'personals.ID_Pers', '=', 'clientes.CliComercial')
            ->select('respels.*', 'clientes.CliName', 'clientes.CliComercial', 'clientes.CliCategoria', 'personals.PersEmail', 'personals.PersFirstName', 'personals.PersLastName', 'personals.PersCellphone')
            ->where(function($query){
                switch (Auth::user()->UsRol) {
                    case 'Cliente':
                        /*se define la sede del usuario actual*/
                        $UserSedeID = DB::table('personals')
                        ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                        ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                        ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                        ->join('clientes', 'clientes.ID_Cli', 'sedes.FK_SedeCli')
                        ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                        ->value('clientes.ID_Cli');
                        // return $UserSedeID;
                        $query->where('respels.RespelDelete',0);
                        $query->where('respels.RespelPublic',0);
                        $query->where('clientes.ID_Cli', $UserSedeID);
                        break;

                    case 'Comercial':
                        /*se define la sede del usuario actual*/
                        $ComercialAsignado = DB::table('personals')
                        ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                        ->value('personals.ID_Pers');

                        $query->where('respels.RespelDelete',0);
                        $query->where('respels.RespelPublic',0);
                        $query->where('clientes.CliComercial', $ComercialAsignado);
                        break;
                    
                    default:
                        $query->where('respels.RespelDelete',0);
                        $query->where('respels.RespelPublic',0);
                        break;
                }
            })
            ->where('clientes.CliCategoria', 'ClientePrepago')
            ->get();

            foreach ($Respels as $key => $value) {
                $requerimiento = Requerimiento::where('FK_ReqRespel', $Respels[$key]->ID_Respel)
                ->where('forevaluation', 1)
                ->where('ofertado', 1)
                ->first();

                if (isset($requerimiento->FK_ReqTrata) && $requerimiento->ofertado == 1) {
                    $tratamiento = Tratamiento::where('ID_Trat', $requerimiento->FK_ReqTrata)->first('TratName');
                    if (isset($tratamiento->TratName)) {
                        $Respels[$key]->TratName = $tratamiento->TratName;
                    }else{
                        $Respels[$key]->TratName = '';
                    }
                }else{
                    $Respels[$key]->TratName = '';
                }
                
            }
            // return $Respels->pluck('TratName');
 
        return view('respels.indexExpress', compact('Respels')); 
    }
}
