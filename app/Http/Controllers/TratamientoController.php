<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Sede;
use App\Cliente;
use App\audit;
use App\Departamento;
use App\Municipio;
use App\Tratamiento;
use App\Pretratamiento;
use App\Clasificacion;
use App\Respel;
use App\Requerimiento;
use App\Permisos;

class TratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tratamientos = Tratamiento::with('clasificaciones')->get();
        // return $tratamientos;
        // $proveedor = Tratamiento::with(['respel.tratamiento.pretratamientos'])->get();
        // $depart = Departamento::with('municipios')->get();
        $tratamientos = Tratamiento::with(['pretratamientos', 'clasificaciones'])
        ->join('sedes', 'tratamientos.FK_TratProv', '=', 'sedes.ID_Sede')
        ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
        ->where('TratDelete', 0)
        ->get();
        // return $tratamientos;
        // return $depart;
        return view('tratamiento.index', compact('tratamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // $residuos = DB::table('respels')
        //         ->join('cotizacions', 'respels.FK_RespelCoti', '=', 'cotizacions.ID_Coti')
        //         ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
        //         ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
        //         ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
        //         ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
        //         ->select('respels.*', 'cotizacions.*', 'sedes.*', 'clientes.*', 'municipios.*', 'departamentos.*')
        //         ->get();
        if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones) || in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)){
            $sedes = DB::table('sedes')
                    ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                    ->where('CliCategoria', '=', 'proveedor')
                    ->where('ID_Sede', '=', 1)
                    ->select('sedes.*', 'clientes.*')
                    ->get();

            $clasificaciones = Clasificacion::All();

            $pretratamientos = Pretratamiento::All();
                    
            return view('tratamiento.create', compact('sedes', 'clasificaciones', 'pretratamientos'));
        }
         /*Validacion para usuarios no permitidos en esta vista*/
        else{
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // return $request; 
        $tratamiento = new Tratamiento();
        $tratamiento->TratName = $request->input('TratName');
        $tratamiento->FK_TratProv = $request->input('FK_TratProv');
        /*determinar el tipo de tratamiento segun el gestor*/
        if ($request->input('FK_TratProv') == 1) {
            $tratamiento->TratTipo = 0; //interno
        }else{
            $tratamiento->TratTipo = 1; //Externo
        }
        $tratamiento->TratDelete = 0;
        $tratamiento->save();

        /*iteracion sobre los pretratamientos insertados en el formulario*/
        if ($request['ID_PreTrat']!==null) {
            for ($x=0; $x < count($request['PreTratName']); $x++) {
                $pretratamiento = new Pretratamiento();
                $pretratamiento->PreTratName = $request['PreTratName'][$x];
                $pretratamiento->PreTratDescription = $request['PreTratDescription'][$x];
                $pretratamiento->PreTratDelete = 0;
                $pretratamiento->save();
                $tratamiento->pretratamientos()->attach($pretratamiento->ID_PreTrat);

                $log = new audit();
                $log->AuditTabla="pretratamiento";
                $log->AuditType="Creado";
                $log->AuditRegistro=$pretratamiento->ID_PreTrat ;
                $log->AuditUser=Auth::user()->email;
                $log->Auditlog=$request->all();
                $log->save();
            }
        }
        if ($request['FK_Pretrat']!==null) {
            for ($x=0; $x < count($request['FK_Pretrat']); $x++) {
                $tratamiento->pretratamientos()->attach($request['FK_Pretrat'][$x]);
            }
        }
        if ($request['FK_Clasf']!==null) {
            for ($x=0; $x < count($request['FK_Clasf']); $x++) {
                $tratamiento->clasificaciones()->attach($request['FK_Clasf'][$x]); 
            }
        }
        
        /*registro de auditoria*/
        $log = new audit();
        $log->AuditTabla="tratamientos";
        $log->AuditType="Creado";
        $log->AuditRegistro=$tratamiento->ID_Trat;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('tratamiento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        // $tratamiento = Tratamiento::where('ID_Trat', $id)->first();
        $tratamiento = Tratamiento::with(['pretratamientos', 'clasificaciones', 'tarifas_cliente'])
            ->where('ID_Trat', $id)
            ->where('TratDelete', 0)
            ->first();
        if (!$tratamiento) {
            abort(404);
        }
        $respels = DB::table('respels')
            ->join('cotizacions', 'respels.FK_RespelCoti', '=', 'cotizacions.ID_Coti')
            ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
            ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
            ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
            ->select('respels.*', 'cotizacions.*', 'sedes.*', 'clientes.*', 'municipios.*', 'departamentos.*')
            ->get();

        $Sede = Sede::where('ID_Sede', $tratamiento->FK_TratProv)
        ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
        ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
        ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
        ->first();

        return view('tratamiento.show', compact('tratamiento', 'Sede', 'respels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones) || in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)){

            $tratamiento = Tratamiento::with(['pretratamientos', 'clasificaciones'])
                ->where('ID_Trat', $id)
                ->where('TratDelete', 0)
                ->first();
            if (!$tratamiento) {
                abort(404);
            }
            $sedes = DB::table('sedes')
                    ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                    ->where('CliCategoria', '=', 'proveedor')
                    ->where('ID_Sede', '=', 1)
                    ->select('sedes.*', 'clientes.*')
                    ->get();
            $clasificacionesAll = Clasificacion::All();
            $pretratamientosAll = Pretratamiento::All(); 
     
            return view('tratamiento.edit', compact('tratamiento', 'sedes', 'clasificacionesAll', 'pretratamientosAll'));
        }
         /*Validacion para usuarios no permitidos en esta vista*/
        else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.,
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // return $request;

        $tratamiento = Tratamiento::find($id);


        if ($tratamiento->TratName !== 'Posconsumo luminarias') {
            $tratamiento->TratName = $request->input('TratName');
        }else{
            if ($request->input('TratName') !== 'Posconsumo luminarias') {
                abort(403, 'no esta permtida la edición del nombre para este tratamiento');
            }else{
                $tratamiento->TratName = $request->input('TratName');
            }
        }
        /*determinar el tipo de tratamiento segun el gestor*/
        if ($request->input('FK_TratProv') == 1) {
            $tratamiento->TratTipo = 0; //interno
        }else{
            $tratamiento->TratTipo = 1; //Externo
        }
        $tratamiento->FK_TratProv = $request->input('FK_TratProv');
        $tratamiento->save();

        /*se sincronizan los pretratamientos y clasificaciones existentes*/
        $tratamiento->pretratamientos()->sync($request['FK_PreTrat']);
        $tratamiento->clasificaciones()->sync($request['FK_Clasf']);

        /*iteracion sobre los pretratamientos nuevos insertados en el formulario*/
        if ($request['ID_PreTrat']!==null) {
            for ($x=0; $x < count($request['PreTratName']); $x++) {
                if (!$request['ID_PreTrat'][$x]) {
                    $pretratamiento = new Pretratamiento();
                    $pretratamiento->PreTratName = $request['PreTratName'][$x];
                    $pretratamiento->PreTratDescription = $request['PreTratDescription'][$x];
                    $pretratamiento->PreTratDelete = 0;
                    $pretratamiento->save();
                    /*auditoria*/
                    $log = new audit();
                    $log->AuditTabla="pretratamiento";
                    $log->AuditType="Creado";
                    $log->AuditUser=Auth::user()->email;
                    $log->Auditlog=$request->all();
                    $log->save();
                    /*se adjunta el pretratamiento nuevo al tratamiento*/
                    $tratamiento->pretratamientos()->attach($pretratamiento->ID_PreTrat);
                }
            }
        }
        

        /*codigo para incluir la actualizacion en la tabla de auditoria*/
        $log = new audit();
        $log->AuditTabla="tratamientos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$tratamiento->ID_Trat;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('tratamiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tratamiento = Tratamiento::find($id);

        /*se elimina la relacion entre tratamiento y pretratamientos/clasificaciones*/
        // $tratamiento->clasificaciones()->detach();

        // foreach ($tratamiento->pretratamientos as $pretratamiento) {
        //     $key = $pretratamiento->ID_PreTrat;
        //     // $pretratamiento = Pretratamiento::find($key);
        //     $pretratamientoRelated = Pretratamiento::withCount(['tratamientos'])
        //         ->where('ID_PreTrat', $key)
        //         ->first();
        //     /*si los pretratamietnos estan relacionados con mas de un tratamiento No se eliminan*/
        //     if ($pretratamientoRelated->tratamientos_count > 1) {
        //         $tratamiento->pretratamientos()->detach($key);
        //     }else{
        //         $tratamiento->pretratamientos()->detach($key);
        //         $pretratamientoRelated->delete();
        //     }
            
        // }

        
        $tratamiento = Tratamiento::where('ID_Trat', $id)->first();

        if ($tratamiento->TratName == 'Posconsumo luminarias') {
            abort(403, 'no esta permtido eliminar este tratamiento');
        }

        if ($tratamiento->TratDelete == 0) {
            $tratamiento->TratDelete = 1;
        }
        else{
            $tratamiento->TratDelete = 0;
        }

        $tratamiento->update();

        // se elimina el tratamiento de la base de datos
        // $tratamiento->delete();
        

        $log = new audit();
        $log->AuditTabla="tratamientos";
        $log->AuditType="Borrado";
        $log->AuditRegistro=$tratamiento->ID_Trat;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog = $tratamiento->TratDelete;
        $log->save();

        return redirect()->route('tratamiento.index');
    }
}
