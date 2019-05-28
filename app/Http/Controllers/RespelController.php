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

        if(Auth::user()->UsRol === "Programador"){
            $Respels = DB::table('respels')
            ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
            ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('respels.*', 'clientes.CliName')
            ->get();

            return view('respels.index', compact('Respels'));
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
        return $request;


        /*se crea un nueva cotizacion solo si el cliente no tiene cotizaciones pendientes*/

            $Sede = DB::table('personals')
                ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                ->select('sedes.ID_Sede')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->get();
                // return $Sede;
            $Cotizacion = new Cotizacion();
            $Cotizacion->CotiNumero = 7;
            $Cotizacion->CotiFechaSolicitud = now();
            $Cotizacion->CotiDelete = 0;
            $Cotizacion->CotiStatus = "Pendiente";
            $Cotizacion->FK_CotiSede = $Sede;

        for ($x=0; $x < count($request['RespelName']); $x++) {
            /*validar si el formulario incluye archivos de tarjeta de emergencia u hoja de seguridad*/


            $respel = new Respel();

            if (isset($request['RespelHojaSeguridad'][$x])) {
                $file1 = $request['RespelHojaSeguridad'][$x];
                $hoja = time().$file1->getClientOriginalName();
                $file1->move(public_path().'/img/HojaSeguridad/',$hoja);
            }
            else{
                $hoja = 'RespelHojadefault.png';
            }

             /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelTarj'][$x])) {
                $file2 = $request['RespelTarj'][$x];
                $tarj = time().$file2->getClientOriginalName();
                $file2->move(public_path().'/img/TarjetaEmergencia/',$tarj);
            }else{
                $tarj = 'RespelTarjetadefault.png';
            }

             /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelFoto'][$x])) {
                $file3 = $request['RespelFoto'][$x];
                $foto= time().$file3->getClientOriginalName();
                $file3->move(public_path().'/img/fotoRespelCreate/',$tarj);
            }else{
                $foto = 'RespelFotoDefault.png';
            }
    
            /*verificar si se cargo un documento en este campo*/
            if (isset($request['SustanciaControladaDocumento'][$x])) {
                $file4 = $request['SustanciaControladaDocumento'][$x];
                $ctrlDoc = time().$file4->getClientOriginalName();
                $file4->move(public_path().'/img/SustanciaControlDoc/',$tarj);
            }else{
                $ctrlDoc = 'SustanciaControlDocDefault.png';
            }


            /*validar si el residuo corresponde a una sustancia controlada para definir los campos que corresponden*/
            if ($request['SustanciaControlada'][$x] == '0') {
                // return "si cuple";
                $respel->SustanciaControladaTipo = null;
                $respel->SustanciaControladaNombre = null;
            }else{
                $respel->SustanciaControladaTipo = $request['SustanciaControladaTipo'][$x];
                $respel->SustanciaControladaNombre = $request['SustanciaControladaNombre'][$x];
            }
            /*validar la peligrosidad del residuo para insertar o no la clasificacion*/
            if ($request['RespelIgrosidad'][$x] == 'No peligroso') {
                $respel->YRespelClasf4741 = 'N/A';
                $respel->ARespelClasf4741 = 'N/A';
            }else{
                $respel->YRespelClasf4741 = $request['YRespelClasf4741'][$x];
                $respel->ARespelClasf4741 = $request['ARespelClasf4741'][$x];
            }
            /*se verifica el rol de usuario para asignar un status al residuo*/
            if (Auth::user()->UsRol=='Cliente'||Auth::user()->UsRol=='Programador') {
                $statusinicial="Pendiente";
            }
            $respel->RespelName = $request['RespelName'][$x];
            $respel->RespelDescrip = $request['RespelDescrip'][$x];
            $respel->RespelIgrosidad = $request['RespelIgrosidad'][$x];
            $respel->RespelStatus = $request['RespelStatus'][$x];
            $respel->RespelEstado = $request['RespelEstado'][$x];
            $respel->SustanciaControlada = $request['SustanciaControlada'][$x];
            $respel->RespelStatus = $statusinicial;
            $respel->RespelHojaSeguridad = $hoja;
            $respel->RespelTarj = $tarj;
            $respel->RespelFoto = $foto;
            $respel->SustanciaControladaDocumento = $ctrlDoc;
            $respel->FK_RespelCoti = $Cotizacion->ID_Coti;
            $respel->RespelSlug = Hash::make(now().$request['RespelName'][$x]);
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

        return view('respels.show', compact('Respels'));
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

        return view('respels.edit', compact('Respels', 'Sedes', 'Requerimientos', 'tratamientos'));
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
        // return $request;
        $Respels = Respel::where('ID_Respel', $id)->first();

        if ($request->hasfile('RespelHojaSeguridad')) {
            if(file_exists(public_path().'/img/HojaSeguridad/'.$Respels->RespelHojaSeguridad)){
                unlink(public_path().'/img/HojaSeguridad/'.$Respels->RespelHojaSeguridad);
            }
            $file = $request->file('RespelHojaSeguridad');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/img/HojaSeguridad/',$name);
        }
        else{
            $name = $Respels->RespelHojaSeguridad;
        }

        if ($request->hasfile('RespelTarj')) {
            if(file_exists (public_path().'/img/TarjetaEmergencia/'.$Respels->RespelTarj)){
                unlink(public_path().'/img/TarjetaEmergencia/'.$Respels->RespelTarj);
            }
            $file = $request->file('RespelTarj');
            $tarj = time().$file->getClientOriginalName();
            $file->move(public_path().'/img/TarjetaEmergencia/',$tarj);
        }
        else{
            $tarj = $Respels->RespelTarj;
        }

        $Respels->RespelName = $request->input('RespelName');
        $Respels->RespelDescrip = $request->input('RespelDescrip');
        $Respels->YRespelClasf4741 = $request->input('YRespelClasf4741');
        $Respels->ARespelClasf4741 =$request->input('ARespelClasf4741');
        $Respels->RespelIgrosidad = $request->input('RespelIgrosidad');
        $Respels->RespelEstado = $request->input('RespelEstado');
        $Respels->RespelStatus = $request->input('RespelStatus');
        $Respels->RespelHojaSeguridad = $name;
        $Respels->RespelTarj = $tarj;
        $Respels->save();

        $log = new audit();
        $log->AuditTabla="respels";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Respels->ID_Respel;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        return redirect()->route('respels.show', [$Respels->RespelSlug]);
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
