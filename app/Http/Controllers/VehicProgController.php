<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ProgramacionVehiculo;
use App\audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Vehiculo;

class VehicProgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente')){
            $programacions = DB::table('progvehiculos')
                ->join('solicitud_servicios', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
                ->join('clientes', 'solicitud_servicios.FK_SolSerCliente', 'clientes.ID_Cli')
                ->join('vehiculos', 'progvehiculos.FK_ProgVehiculo', '=', 'vehiculos.ID_Vehic')
                ->join('personals as conductor', 'progvehiculos.FK_ProgConductor', '=', 'conductor.ID_Pers')
                ->join('personals as ayudante', 'progvehiculos.FK_ProgAyudante', '=', 'ayudante.ID_Pers')
                ->select('progvehiculos.*', 'vehiculos.VehicPlaca', 'solicitud_servicios.ID_SolSer', 'solicitud_servicios.SolSerSlug', 'conductor.PersFirstName as condname', 'conductor.PersLastName as condlastname', 'ayudante.PersFirstName as ayudname', 'ayudante.PersLastName as ayudlastname', 'clientes.CliShortname')
                ->where(function($query){
                    if(Auth::user()->UsRol == trans('adminlte_lang::message.Conductor')){
                        $query->where('conductor.ID_Pers', Auth::user()->FK_UserPers);
                        $query->where('progvehiculos.ProgVehDelete', 0);
                    }
                    else if(Auth::user()->UsRol <> trans('adminlte_lang::message.Programador')){
                        $query->where('progvehiculos.ProgVehDelete', 0);
                    }
                })
                ->get();
        }
         /*Validacion para usuarios no permitidos en esta vista*/
        else{
            abort(403);
        }
            // return $programacions;
        return view('ProgramacionVehicle.index', compact('programacions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programacions = DB::table('progvehiculos')
            ->join('solicitud_servicios', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
            ->join('vehiculos', 'progvehiculos.FK_ProgVehiculo', '=', 'vehiculos.ID_Vehic')
            ->select('progvehiculos.*', 'vehiculos.ID_Vehic', 'vehiculos.VehicPlaca', 'solicitud_servicios.ID_SolSer')
            ->where('ProgVehDelete', 0)
            ->get();
        $mantenimientos = DB::table('mantenvehics')
            ->join('vehiculos', 'mantenvehics.FK_VehMan', '=', 'vehiculos.ID_Vehic')
            ->select('mantenvehics.*','vehiculos.VehicPlaca')
            ->where('mantenvehics.HoraMavFin', '>', now())
            ->get();
        $conductors = DB::table('personals')
            ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
            ->select('ID_Pers', 'PersFirstName', 'PersLastName')
            ->where('CargName', 'Conductor')
            ->get();
        $ayudantes = DB::table('personals')
            ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
            ->select('ID_Pers', 'PersFirstName', 'PersLastName')
            ->where('CargName', 'Operario')
            ->get();
        $vehiculos = DB::table('vehiculos')
            ->select('*')
            ->get();
        $serviciosnoprogramados = DB::table('solicitud_servicios')
            ->select('ID_SolSer')
            ->where('SolSerDelete', 0)
            ->where(function($query) use ($programacions){
                foreach($programacions as $programacion) { 
                    $query->where('ID_SolSer', '<>', $programacion->FK_ProgServi);
                }
            })
            ->get();
        return $serviciosnoprogramados;
        return view('ProgramacionVehicle.create', compact('programacions', 'conductors', 'ayudantes', 'vehiculos', 'serviciosnoprogramados', 'mantenimientos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('textHoraSali') >= 12){
            $turno = "0";
        }
        else{
            $turno = "1";
        }
        $programacion = new ProgramacionVehiculo();
        $programacion->ProgVehFecha = $request->input('textFecha');
        $programacion->progVehKm = $request->input('textkm');
        $programacion->ProgVehTurno = $turno;
        $programacion->ProgVehtipo = "1";
        if($request->input('textHoraLlega')){
            $programacion->ProgVehEntrada = $request->input('textFecha').' '.$request->input('textHoraLlega');
        }
        else{
            $programacion->ProgVehEntrada = null;
        }
        $programacion->ProgVehSalida = $request->input('textFecha').' '.date('H:i:s', strtotime($request->input('textHoraSali')));
        $programacion->FK_ProgVehiculo = $request->input('textVehiculo');
        $programacion->FK_ProgMan = "1";
        $programacion->ProgVehColor = $request->input('ProgVehColor');
        $programacion->FK_ProgServi = $request->input('FK_ProgServi');
        $programacion->FK_ProgConductor = $request->input('textConductor');
        $programacion->FK_ProgAyudante = $request->input('textAyudante');
        $programacion->ProgVehDelete = 0;
        $programacion->save();
        return redirect()->route('prueba.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if($request->input('textHoraSali1') >= 12){
            $turno = "0";
        }
        else{
            $turno = "1";
        }
        $programacion = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
        $programacion->ProgVehFecha = $request->input('textFecha1');
        $programacion->progVehKm = $request->input('textkm1');
        $programacion->ProgVehTurno = $turno;
        $programacion->ProgVehtipo = "1";
        if($request->input('textHoraLlega1')){
            $programacion->ProgVehEntrada = $request->input('textFecha1').' '.$request->input('textHoraLlega1');
        }
        else{
            $programacion->ProgVehEntrada = null;
        }
        $programacion->ProgVehSalida = $request->input('textFecha1').' '.$request->input('textHoraSali1');
        $programacion->FK_ProgVehiculo = $request->input('textVehiculo1');
        $programacion->FK_ProgMan = "1";
        $programacion->FK_ProgConductor = $request->input('textConductor1');
        $programacion->FK_ProgAyudante = $request->input('textAyudante1');
        // return $programacion;
        $programacion->save();

        $log = new audit();
        $log->AuditTabla="progvehiculos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$programacion->ID_ProgVeh;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        return redirect()->route('prueba.index');
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
