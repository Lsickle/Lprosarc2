<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ProgramacionVehiculo;
use App\audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class pruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = DB::table('progvehiculos')
            ->join('solicitud_servicios', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
            ->join('vehiculos', 'progvehiculos.FK_ProgVehiculo', '=', 'vehiculos.ID_Vehic')
            ->select('progvehiculos.*', 'vehiculos.ID_Vehic', 'vehiculos.VehicPlaca', 'solicitud_servicios.ID_SolSer')
            ->where('ProgVehDelete', 0)
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
        $servicios = DB::table('solicitud_servicios')
            ->select('*')
            ->get();
        $array[] = null;
        foreach ($eventos as $evento) {
            foreach ($servicios as $servicio) {
                if($evento->FK_ProgServi == $servicio->ID_SolSer){
                    $array[] = $servicio->ID_SolSer;
                }
            }
        }/**/
        $serviciosnoprogramados = DB::table('solicitud_servicios')
            ->select('ID_SolSer')
            ->where('SolSerDelete', 0)
            ->where(function($query) use ($array){
                for ($i=0; $i < count($array); $i++) { 
                    $query->where('ID_SolSer', '<>', $array[$i]);
                }
            })
            ->get();
        return view('PruebaFullCalendar.index', compact('eventos', 'conductors', 'ayudantes', 'vehiculos', 'serviciosnoprogramados'));
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
        if($request->input('textHoraSali') >= 12){
            $turno = "0";
        }
        else{
            $turno = "1";
        }
        $reguistro = new ProgramacionVehiculo();
        $reguistro->ProgVehFecha = $request->input('textFecha');
        $reguistro->progVehKm = $request->input('textkm');
        $reguistro->ProgVehTurno = $turno;
        $reguistro->ProgVehtipo = "1";
        if($request->input('textHoraLlega')){
            $reguistro->ProgVehEntrada = $request->input('textFecha').' '.$request->input('textHoraLlega');
        }
        else{
            $reguistro->ProgVehEntrada = null;
        }
        $reguistro->ProgVehSalida = $request->input('textFecha').' '.date('H:i:s', strtotime($request->input('textHoraSali')));
        $reguistro->FK_ProgVehiculo = $request->input('textVehiculo');
        $reguistro->FK_ProgMan = "1";
        $reguistro->ProgVehColor = $request->input('ProgVehColor');
        $reguistro->FK_ProgServi = $request->input('FK_ProgServi');
        $reguistro->FK_ProgConductor = $request->input('textConductor');
        $reguistro->FK_ProgAyudante = $request->input('textAyudante');
        $reguistro->ProgVehDelete = 0;
        $reguistro->save();
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
        $reguistro = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
        $reguistro->ProgVehFecha = $request->input('textFecha1');
        $reguistro->progVehKm = $request->input('textkm1');
        $reguistro->ProgVehTurno = $turno;
        $reguistro->ProgVehtipo = "1";
        if($request->input('textHoraLlega1')){
            $reguistro->ProgVehEntrada = $request->input('textFecha1').' '.$request->input('textHoraLlega1');
        }
        else{
            $reguistro->ProgVehEntrada = null;
        }
        $reguistro->ProgVehSalida = $request->input('textFecha1').' '.$request->input('textHoraSali1');
        $reguistro->FK_ProgVehiculo = $request->input('textVehiculo1');
        $reguistro->FK_ProgMan = "1";
        $reguistro->FK_ProgConductor = $request->input('textConductor1');
        $reguistro->FK_ProgAyudante = $request->input('textAyudante1');
        // return $reguistro;
        $reguistro->save();

        $log = new audit();
        $log->AuditTabla="progvehiculos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$reguistro->ID_ProgVeh;
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
        // return $id;
        $reguistro = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
            if ($reguistro->ProgVehDelete == 0) {
                $reguistro->ProgVehDelete = 1;
            }
            else{
                $reguistro->ProgVehDelete = 0;
            }
        $reguistro->save();

        $log = new audit();
        $log->AuditTabla = "progvehiculos";
        $log->AuditType = "Eliminado";
        $log->AuditRegistro = $reguistro->ID_ProgVeh;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $reguistro->ProgVehDelete;
        $log->save();

        return redirect()->route('prueba.index');
    }
}
