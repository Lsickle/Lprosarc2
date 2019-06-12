<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RespelStoreRequest;
use App\audit;
use App\Respel;
use App\Sede;
use App\Cotizacion;
use App\Tratamiento;
use App\User;
use App\Requerimiento;
use App\ResiduosGener;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;
class RespelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        /*se define la sede del usuario actual*/
        $UserSedeID = DB::table('personals')
                ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->value('sedes.ID_Sede');

        if(Auth::user()->UsRol === "Programador"){
            $Respels = DB::table('respels')
            ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
            ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('respels.*', 'clientes.CliName')
            ->get();
        }
        elseif(Auth::user()->UsRol === "Cliente"){
            $Respels = DB::table('respels')
            ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
            ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('respels.*', 'clientes.CliName')
            ->where('respels.RespelDelete',0)
            ->where('sedes.ID_Sede', $UserSedeID)
            ->get();
        }
        else{
            $Respels = DB::table('respels')
            ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
            ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('respels.*', 'clientes.CliName')
            ->where('respels.RespelDelete',0)
            ->get();
        }
        return view('respels.index', compact('Respels')); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->UsRol=='Cliente'){
			$Sede = DB::table('personals')
				->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
				->join('areas', 'areas.ID_Area', 'cargos.CargArea')
				->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
				->select('sedes.ID_Sede')
				->where('personals.ID_Pers', Auth::user()->FK_UserPers)
				->get();
			return view('respels.create', compact('Sede'));
		}
		else{
			$Sedes = DB::table('clientes')
				->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('sedes.ID_Sede', 'clientes.CliName')
				->where('clientes.ID_Cli', '<>', 1) 
				->get();
			return view('respels.create', compact('Sedes'));
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
        // $validatedData = $request->validate([
        //     'RespelFoto.*' => 'sometimes|image|max:1024|mimes:jpeg,png',
        // ]);
        // return $request;


        /*se crea un nueva cotizacion solo si el cliente no tiene cotizaciones pendientes*/

            $UserSedeID = DB::table('personals')
                ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->value('sedes.ID_Sede');
            // return $UserSedeID;

            $Cotizacion = new Cotizacion();
            $Cotizacion->CotiNumero = 7;
            $Cotizacion->CotiFechaSolicitud = 
      time();      $Cotizacion->CotiDelete = 0;
            $Cotizacion->CotiStatus = "Pendiente";
            $Cotizacion->FK_CotiSede = $UserSedeID;
            $Cotizacion->save();


        for ($x=0; $x < count($request['RespelName']); $x++) {
            /*validar si el formulario incluye archivos de tarjeta de emergencia u hoja de seguridad*/


            $respel = new Respel();

            if (isset($request['RespelHojaSeguridad'][$x])) {
                $file1 = $request['RespelHojaSeguridad'][$x];
                $hoja = hash('sha256', rand().time().$file1->getClientOriginalName()).'.pdf';

                $file1->move(public_path().'\img\HojaSeguridad/',$hoja);
            }
            else{
                $hoja = 'RespelHojaDefault.pdf';
            }

             /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelTarj'][$x])) {
                $file2 = $request['RespelTarj'][$x];
                $tarj = hash('sha256', rand().time().$file2->getClientOriginalName()).'.pdf';
                $file2->move(public_path().'\img\TarjetaEmergencia/',$tarj);
            }else{
                $tarj = 'RespelTarjetaDefault.pdf';
            }

             /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelFoto'][$x])) {
                $file3 = $request['RespelFoto'][$x];
                $foto = hash('sha256', rand().time().$file3->getClientOriginalName()).'.png';
                $file3->move(public_path().'\img\fotoRespelCreate/',$foto);
            }else{
                $foto = 'RespelFotoDefault.png';
            }
    
            /*verificar si se cargo un documento en este campo*/
            if (isset($request['SustanciaControladaDocumento'][$x])) {
                $file4 = $request['SustanciaControladaDocumento'][$x];
                $ctrlDoc = hash('sha256', rand().time().$file4->getClientOriginalName()).'.pdf';
                $file4->move(public_path().'\img\SustanciaControlDoc/',$ctrlDoc);
            }else{
                $ctrlDoc = 'SustanciaControlDocDefault.pdf';
            }

            /*se verifica el rol de usuario para asignar un status al residuo*/
            if (Auth::user()->UsRol=='Cliente'||Auth::user()->UsRol=='Programador') {
                $statusinicial="Pendiente";
            }
            $respel->RespelName = $request['RespelName'][$x];
            $respel->RespelDescrip = $request['RespelDescrip'][$x];
            $respel->RespelIgrosidad = $request['RespelIgrosidad'][$x];
            $respel->YRespelClasf4741 = $request['YRespelClasf4741'][$x];
            $respel->ARespelClasf4741 = $request['ARespelClasf4741'][$x];
            $respel->RespelStatus = $request['RespelStatus'][$x];
            $respel->RespelEstado = $request['RespelEstado'][$x];
            $respel->SustanciaControlada = $request['SustanciaControlada'][$x];
            $respel->SustanciaControladaTipo = $request['SustanciaControladaTipo'][$x];
            $respel->SustanciaControladaNombre = $request['SustanciaControladaNombre'][$x];
            $respel->RespelStatus = $statusinicial;
            $respel->RespelHojaSeguridad = $hoja;
            $respel->RespelTarj = $tarj;
            $respel->RespelFoto = $foto;
            $respel->SustanciaControladaDocumento = $ctrlDoc;
            $respel->FK_RespelCoti = $Cotizacion->ID_Coti;
            $respel->RespelSlug = hash('sha256', rand().time().$request['RespelName'][$x]);
            $respel->RespelDelete = 0;
            $respel->RespelDeclaracion = $request['RespelDeclaracion'][$x];
            $respel->save();
        }
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

        $Respels = Respel::where('RespelSlug', $id)->first();

        /*se  verifica si el residuo tiene alguna registro hijo o dependiente*/
        $ResiduoConDependencia1 = ResiduosGener::where('FK_Respel', $Respels->ID_Respel)->first();
        $ResiduoConDependencia2 = Requerimiento::where('FK_ReqRespel', $Respels->ID_Respel)->first();
        // return $ResiduoConDependencia1;
        if (Auth::user()->UsRol=='Cliente')
            if ($Respels->RespelStatus=='Aprobado'||$Respels->RespelStatus=='Vencido') {
                $editButton = 'No editable';
            }else{
                $editButton = 'Editable';
            }
        else{
            $editButton = 'Editable';
        }

        $tratamientos = DB::table('tratamientos')
            ->join('sedes', 'sedes.ID_Sede', '=', 'tratamientos.FK_TratProv')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('sedes.*', 'clientes.*', 'tratamientos.*')
            ->get();

        $Sedes = DB::table('cotizacions')
            ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('sedes.*', 'clientes.*', 'cotizacions.*')
            ->get();

        return view('respels.show', compact('Respels', 'Sedes', 'Requerimientos', 'tratamientos', 'editButton'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Respels = Respel::where('RespelSlug', $id)->first();

        if ($Respels->RespelDelete == 1) {
            abort(404);
        }

        /*se  verifica si el residuo tiene alguna registro hijo o dependiente*/
        $ResiduoConDependencia1 = ResiduosGener::where('FK_Respel', $Respels->ID_Respel)->first();
        $ResiduoConDependencia2 = Requerimiento::where('FK_ReqRespel', $Respels->ID_Respel)->first();
        // return $ResiduoConDependencia1;

        if ($ResiduoConDependencia1||$ResiduoConDependencia2) {
            $deleteButton = 'No borrable';
        }else{
            $deleteButton = 'borrable';
        }   

        $tratamientos = DB::table('tratamientos')
            ->join('sedes', 'sedes.ID_Sede', '=', 'tratamientos.FK_TratProv')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('sedes.*', 'clientes.*', 'tratamientos.*')
            ->get();

        // se verifica el rol y el status del residuo para devolver a la vista correspondiente
            $statusRespel = $Respels->RespelStatus;

        if(Auth::user()->UsRol=='Cliente'){
            $Sede = DB::table('personals')
                ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                ->select('sedes.ID_Sede')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->get();
            switch ($statusRespel) {
                case 'Pendiente':
                    return view('respels.edit', compact('Respels', 'Sede', 'Requerimientos', 'tratamientos'));
                    break;

                case 'Incompleto':
                    return view('respels.edit', compact('Respels', 'Sede', 'Requerimientos', 'tratamientos'));
                    break;

                case 'Aprobado':
                    abort(403);
                    break;

                case 'Rechazado':
                    abort(403);
                    break;

                case 'Vencido':
                    abort(403);
                    break;
                
                default:
                    abort(403);
                    break;
            }
        }
        else{
            $Sedes = DB::table('clientes')
                ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('sedes.ID_Sede', 'sedes.SedeName')
                ->where('clientes.ID_Cli', '<>', 1) 
                ->get();
            return view('respels.edit', compact('Respels', 'Sedes', 'Requerimientos', 'tratamientos'));
            
        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RespelStoreRequest $request, $id)
    {
        // return $request;

        $respel = Respel::where('RespelSlug', $id)->first();

        if (isset($request['RespelHojaSeguridad'])) {
            $file1 = $request['RespelHojaSeguridad'];
            $hoja = hash('sha256', rand().time().$file1->getClientOriginalName()).'.pdf';

            $file1->move(public_path().'\img\HojaSeguridad/',$hoja);
        }
        else{
            $hoja = $respel->RespelHojaSeguridad;
        }

         /*verificar si se cargo un documento en este campo*/
        if (isset($request['RespelTarj'])) {
            $file2 = $request['RespelTarj'];
            $tarj = hash('sha256', rand().time().$file2->getClientOriginalName()).'.pdf';
            $file2->move(public_path().'\img\TarjetaEmergencia/',$tarj);
        }else{
            $tarj = $respel->RespelTarj;
        }

         /*verificar si se cargo un documento en este campo*/
        if (isset($request['RespelFoto'])) {
            $file3 = $request['RespelFoto'];
            $foto = hash('sha256', rand().time().$file3->getClientOriginalName()).'.png';
            $file3->move(public_path().'\img\fotoRespelCreate/',$foto);
        }else{
            $foto = $respel->RespelFoto;
        }
        
        /*verificar si se cargo un documento en este campo*/
        if (isset($request['SustanciaControladaDocumento'])) {
            $file4 = $request['SustanciaControladaDocumento'];
            $ctrlDoc = hash('sha256', rand().time().$file4->getClientOriginalName()).'.pdf';
            $file4->move(public_path().'\img\SustanciaControlDoc/',$ctrlDoc);
        }else{
            $ctrlDoc = $respel->SustanciaControladaDocumento;
        }
        if (Auth::user()->UsRol !== "Cliente") {
            $respel->RespelStatus = $request['RespelStatus'];
        }else{
            $respel->RespelStatus = "Pendiente";
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

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$respel->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

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
        if ($Respels->RespelDelete == 0) {
            $Respels->RespelDelete = 1;
        }
        else{
            $Respels->RespelDelete = 0;
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
}
