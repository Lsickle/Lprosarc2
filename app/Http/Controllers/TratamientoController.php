<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Sede;
use App\cliente;
use App\audit;
use App\Departamento;
use App\Municipio;
use App\Tratamiento;
use App\Respel;

class TratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->UsRol === "Programador"){
            $tratamientos = DB::table('tratamientos')
                ->join('sedes', 'tratamientos.FK_TratProv', '=', 'sedes.ID_Sede')
                ->join('respels', 'tratamientos.FK_TratRespel', '=', 'respels.ID_Respel')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('respels.RespelName', 'tratamientos.*', 'sedes.SedeAddress', 'clientes.CliShortname','municipios.MunName', 'departamentos.DepartName')
                ->get();
        } else{
            $tratamientos = DB::table('tratamientos')
                ->join('sedes', 'tratamientos.FK_TratProv', '=', 'sedes.ID_Sede')
                ->join('respels', 'tratamientos.FK_TratRespel', '=', 'respels.ID_Respel')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('respels.RespelName', 'tratamientos.*', 'sedes.SedeAddress', 'clientes.CliShortname','municipios.MunName', 'departamentos.DepartName')
                ->where('tratamientos.TratDelete', 0)
                ->get();

        }
        return view('tratamiento.index', compact('tratamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $residuos = DB::table('respels')
                ->join('cotizacions', 'respels.FK_RespelCoti', '=', 'cotizacions.ID_Coti')
                ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('respels.*', 'cotizacions.*', 'sedes.*', 'clientes.*', 'municipios.*', 'departamentos.*')
                ->get();

        $sedes = Sede::All();
        return view('tratamiento.create', compact('residuos', 'sedes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $tratamiento = new Tratamiento();
        $tratamiento->TratName = $request->input('TratName');
        $tratamiento->TratTipo = $request->input('TratTipo');
        $tratamiento->TratPretratamiento = $request->input('TratPretratamiento');
        $tratamiento->FK_TratProv = $request->input('FK_TratProv');
        $tratamiento->FK_TratRespel = $request->input('FK_TratRespel');
        $tratamiento->TratDelete = 0;
        $tratamiento->save();

        // return $tratamiento;

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
        $tratamiento = Tratamiento::where('ID_Trat', $id)->first();
        
        $residuos = DB::table('respels')
                ->join('cotizacions', 'respels.FK_RespelCoti', '=', 'cotizacions.ID_Coti')
                ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('respels.*', 'cotizacions.*', 'sedes.*', 'clientes.*', 'municipios.*', 'departamentos.*')
                ->get();

        $sede = Sede::where('ID_Sede', $tratamiento->FK_TratProv)->first();
        return view('tratamiento.show', compact('tratamiento', 'sede', 'residuos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tratamiento = Tratamiento::where('ID_Trat', $id)->first();
        
        $sedes = Sede::All();  
        // return $sedes;
        
        $residuos = DB::table('respels')
                ->join('cotizacions', 'respels.FK_RespelCoti', '=', 'cotizacions.ID_Coti')
                ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('respels.*', 'cotizacions.*', 'sedes.*', 'clientes.*', 'municipios.*', 'departamentos.*')
                ->get();
        return view('tratamiento.edit', compact('tratamiento', 'sedes', 'residuos'));
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

        $tratamiento = Tratamiento::where('ID_Trat', $id)->first();
        $tratamiento->TratName = $request->input('TratName');
        $tratamiento->TratTipo = $request->input('TratTipo');
        $tratamiento->TratPretratamiento = $request->input('TratPretratamiento');
        $tratamiento->FK_TratProv = $request->input('FK_TratProv');
        $tratamiento->FK_TratRespel = $request->input('FK_TratRespel');
        $tratamiento->update();

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
        $tratamiento = Tratamiento::where('ID_Trat', $id)->first();
            if ($tratamiento->TratDelete == 0) {
                $tratamiento->TratDelete = 1;
            }
            else{
                $tratamiento->TratDelete = 0;
            }
        $tratamiento->update();
        

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
