<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\Http\Requests\RespelStoreRequest;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\RespelMail;
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
use App\Permisos;
use App\Tarifa;
use App\Categoryrespelpublic;
use App\Subcategoryrespelpublic;
use App\Respelpublic;
use Illuminate\Support\Arr;

class RespelPublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         /*se accede a la lista de residuos comunes unicamente para prosarc*/
        $PublicRespels = Respel::with('SubcategoryRespelpublic.CategoryRP')
        ->where('RespelPublic', 1)
        ->get();
        // return $PublicRespels[0]->SubcategoryRespelpublic->CategoryRP->CategoryRpName;
        // return $PublicRespels;
        return view('publicrespel.index', compact('PublicRespels')); 
        
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
            return view('respels.create', compact('Sede'));
        }elseif(in_array(Auth::user()->UsRol, Permisos::RESPELPUBLIC) || in_array(Auth::user()->UsRol2, Permisos::RESPELPUBLIC)){

            $categories = Categoryrespelpublic::all();

            $Sedes = DB::table('clientes')
                ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('sedes.ID_Sede', 'clientes.CliName')
                ->where('clientes.ID_Cli', '<>', 1) 
                ->get();
            return view('publicrespel.create', compact('Sedes', 'categories'));
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
        

        for ($x=0; $x < count($request['RespelName']); $x++) {
            /*validar si el formulario incluye archivos de tarjeta de emergencia u hoja de seguridad*/

            $prespel = new Respel();

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

            $prespel->RespelName = $request['RespelName'][$x];
            $prespel->RespelDescrip = $request['RespelDescrip'][$x];
            $prespel->RespelIgrosidad = $request['RespelIgrosidad'][$x];
            $prespel->YRespelClasf4741 = $request['YRespelClasf4741'][$x];
            $prespel->ARespelClasf4741 = $request['ARespelClasf4741'][$x];
            $prespel->RespelEstado = $request['RespelEstado'][$x];

            // se verifica si la sustancia esta marcada como controlada
            if (isset($request['SustanciaControlada'][$x])&&($request['SustanciaControlada'][$x]==1)) {
                $prespel->SustanciaControlada = $request['SustanciaControlada'][$x];
                $prespel->SustanciaControladaTipo = $request['SustanciaControladaTipo'][$x];
                $prespel->SustanciaControladaNombre = $request['SustanciaControladaNombre'][$x];
                $prespel->SustanciaControladaDocumento = $ctrlDoc;
            }else{
                $prespel->SustanciaControlada = 0;
            }
            $prespel->RespelStatus = "Pendiente";
            // $prespel->RespelStatus = $statusinicial;
            $prespel->RespelHojaSeguridad = $hoja;
            $prespel->RespelTarj = $tarj;
            $prespel->RespelFoto = $foto;
            $prespel->FK_SubCategoryRP = $request['FK_SubCategoryRP'];
            $prespel->RespelPublic = 1;
            $prespel->RespelSlug = hash('sha256', rand().time().$prespel->RespelName);
            $prespel->RespelDelete = 0;
            $prespel->RespelDeclaracion = $request['RespelDeclaracion'][$x];
            $prespel->save();

            $log = new audit();
            $log->AuditTabla="respelpublic";
            $log->AuditType="creado";
            $log->AuditRegistro=$prespel->ID_Respel;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog=json_encode($request['RespelName'][$x]);
            $log->save();
        }

        return redirect()->route('respelspublic.index');
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

        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE))
            if ($Respels->RespelStatus=='Aprobado'||$Respels->RespelStatus=='Vencido') {
                $editButton = 'No editable';
            }else{
                $editButton = 'Editable';
            }
        else{
            $editButton = 'Editable';
        }

        //consultar cuales son los tratamientos viabiizados por jefe de operaciones
        $requerimientos = Requerimiento::with(['pretratamientosSelected'])
        ->where('FK_ReqRespel', '=', $Respels->ID_Respel)
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
        
        return view('publicrespel.show', compact('Respels', 'requerimientos', 'editButton'));
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
        if(in_array(Auth::user()->UsRol, Permisos::RESPELPUBLIC) || in_array(Auth::user()->UsRol2, Permisos::RESPELPUBLIC)){

            $Respels = Respel::where('RespelSlug', $id)->first();
            // return $Respels;
            /*se valida que el residuo no este eliminado*/
            if ($Respels->RespelDelete == 1) {
                abort(404);
            }

            $categories = Categoryrespelpublic::all();

            $Subcategory = Subcategoryrespelpublic::where('ID_SubCategoryRP', $Respels->FK_SubCategoryRP)->first();
            // return $Subcategory;
            return view('publicrespel.edit', compact('Respels', 'categories', 'Subcategory'));
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
    public function update(Request $request, $id)
    {
        $prespel = Respel::where('ID_Respel', $id)->first();
        if (!$prespel) {
            abort(404);
        }
            if (isset($request['RespelHojaSeguridad'])) {
                if($prespel->RespelHojaSeguridad <> null && file_exists(public_path().'/img/HojaSeguridad/'.$prespel->RespelHojaSeguridad)){
                    // unlink(public_path().'/img/HojaSeguridad/'.$prespel->RespelHojaSeguridad);
                }
                $file1 = $request['RespelHojaSeguridad'];
                $hoja = hash('sha256', rand().time().$file1->getClientOriginalName()).'.pdf';
                $file1->move(public_path().'/img/HojaSeguridad/',$hoja);
            }
            else{
                $hoja = $prespel->RespelHojaSeguridad;
            }

             /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelTarj'])) {
                if($prespel->RespelTarj <> null && file_exists(public_path().'/img/TarjetaEmergencia/'.$prespel->RespelTarj)){
                    // unlink(public_path().'/img/TarjetaEmergencia/'.$prespel->RespelTarj);
                }
                $file2 = $request['RespelTarj'];
                $tarj = hash('sha256', rand().time().$file2->getClientOriginalName()).'.pdf';
                $file2->move(public_path().'/img/TarjetaEmergencia/',$tarj);
            }else{
                $tarj = $prespel->RespelTarj;
            }

             /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelFoto'])) {
                if($prespel->RespelFoto <> null && file_exists(public_path().'/img/fotoRespelCreate/'.$prespel->RespelFoto)){
                    // unlink(public_path().'/img/fotoRespelCreate/'.$prespel->RespelFoto);
                }
                $file3 = $request['RespelFoto'];
                $foto = hash('sha256', rand().time().$file3->getClientOriginalName()).'.png';
                $file3->move(public_path().'/img/fotoRespelCreate/',$foto);
            }else{
                $foto = $prespel->RespelFoto;
            }
            
            /*verificar si se cargo un documento en este campo*/
            if (isset($request['SustanciaControladaDocumento'])) {
                if($prespel->SustanciaControladaDocumento <> null && file_exists(public_path().'/img/SustanciaControlDoc/'.$prespel->SustanciaControladaDocumento)){
                    // unlink(public_path().'/img/SustanciaControlDoc/'.$prespel->SustanciaControladaDocumento);
                }
                $file4 = $request['SustanciaControladaDocumento'];
                $ctrlDoc = hash('sha256', rand().time().$file4->getClientOriginalName()).'.pdf';
                $file4->move(public_path().'/img/SustanciaControlDoc/',$ctrlDoc);
            }else{
                $ctrlDoc = $prespel->SustanciaControladaDocumento;
            }
            $prespel->RespelStatus = "Pendiente";
            // $prespel->RespelStatus = $request['RespelStatus'];
            $prespel->RespelName = $request['RespelName'];
            $prespel->RespelDescrip = $request['RespelDescrip'];
            $prespel->RespelIgrosidad = $request['RespelIgrosidad'];
            $prespel->YRespelClasf4741 = $request['YRespelClasf4741'];
            $prespel->ARespelClasf4741 = $request['ARespelClasf4741'];
            $prespel->RespelEstado = $request['RespelEstado'];
            $prespel->SustanciaControlada = $request['SustanciaControlada'];
            $prespel->SustanciaControladaTipo = $request['SustanciaControladaTipo'];
            $prespel->SustanciaControladaNombre = $request['SustanciaControladaNombre'];
            $prespel->RespelHojaSeguridad = $hoja;
            $prespel->RespelTarj = $tarj;
            $prespel->RespelFoto = $foto;
            $prespel->SustanciaControladaDocumento = $ctrlDoc;
            $prespel->RespelPublic = 1;
            $prespel->RespelDeclaracion = $request['RespelDeclaracion'];
            $prespel->FK_SubCategoryRP = $request['FK_SubCategoryRP'];
            $prespel->update();

            $log = new audit();
            $log->AuditTabla="respelpublic";
            $log->AuditType="Modificado";
            $log->AuditRegistro=$prespel->ID_Respel;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog=json_encode($request->all());
            $log->save();
            
            return redirect()->route('respelspublic.index');
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientToRp(Request $request, $id)
    {
        $PublicRespel = Respel::where('RespelSlug', $id)->first();

        $PublicRespel->load('requerimientos');
        // return $PublicRespel;
        $newRespel = $PublicRespel->replicate();
        $newRespel->RespelSlug = hash('sha256', rand().time().$PublicRespel->RespelName);
        $newRespel->RespelPublic = 1;
        $newRespel->FK_SubCategoryRP = 1;
        $newRespel->RespelStatus = 'Evaluado';
        $newRespel->FK_RespelCoti = 1;
        $newRespel->save();

        foreach($PublicRespel->requerimientos as $requerimiento)
        {
            if ($requerimiento->forevaluation == 1) {
                $requerimiento->load('pretratamientosSelected');
                $newrequerimiento = $requerimiento->replicate();
                $newrequerimiento->ReqSlug = hash('md5', rand().time().$newRespel->ID_Respel);
                $newrequerimiento->FK_ReqRespel = $newRespel->ID_Respel;
                $newrequerimiento->ofertado = 0;
                $newrequerimiento->save();

                foreach($requerimiento->pretratamientosSelected as $pretratamientoSelected)
                {
                    $newrequerimiento->pretratamientosSelected()->attach($pretratamientoSelected->ID_PreTrat);
                }
                /*se copian las tarifas y los rangos relacionados*/
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
        $log->AuditTabla="respelpublic";
        $log->AuditType="Copiado";
        $log->AuditRegistro=$newRespel->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($newRespel->RespelName);
        $log->save();
        // return $newRespel;

        return redirect()->route('respelspublic.edit', [$newRespel->RespelSlug]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rpToClient($id)
    {
        $PublicRespel = Respel::where('RespelSlug', $id)->first();

        $PublicRespel->load('requerimientos');

        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
            $UserSedeID = DB::table('personals')
                ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->value('sedes.ID_Sede');
        }else{
            $UserSedeID = 1;
        }

        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {

            $Cotizacion = new Cotizacion();
            $Cotizacion->CotiNumero = 7;
            $Cotizacion->CotiFechaSolicitud = now();
            $Cotizacion->CotiDelete = 0;
            $Cotizacion->CotiStatus = "Aprobada";
            $Cotizacion->FK_CotiSede = $UserSedeID;
            $Cotizacion->save();
        }else{
            $Cotizacion->ID_Coti = 1;
        }

        $newRespel = $PublicRespel->replicate();
        $newRespel->RespelSlug = hash('sha256', rand().time().$PublicRespel->RespelName);
        $newRespel->RespelPublic = 0;
        $newRespel->RespelStatus = 'Evaluado';
        $newRespel->FK_RespelCoti = $Cotizacion->ID_Coti;
        $newRespel->save();

        foreach($PublicRespel->requerimientos as $requerimiento)
        {
            if ($requerimiento->forevaluation == 1) {
                $requerimiento->load('pretratamientosSelected');
                $newrequerimiento = $requerimiento->replicate();
                $newrequerimiento->ReqSlug = hash('md5', rand().time().$newRespel->ID_Respel);
                $newrequerimiento->FK_ReqRespel = $newRespel->ID_Respel;
                $newrequerimiento->ofertado = 0;
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
        $log->AuditType="Copiado";
        $log->AuditRegistro=$newRespel->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($newRespel->RespelName);
        $log->save();
        // return $newRespel;

        return redirect()->route('respels.index');
    }
}
