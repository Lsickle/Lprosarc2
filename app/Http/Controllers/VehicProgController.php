<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ProgramacionVehiculo;
use Illuminate\Validation\Rule;
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
            ->where('progvehiculos.ProgVehDelete', 0)
            ->orWhere(function($query){
                $query->where('progvehiculos.ProgVehEntrada', '<>', null);
                $query->where('progvehiculos.ProgVehDelete', 1);
            })
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
            ->select('ID_Vehic','VehicPlaca')
            ->get();
        $serviciosnoprogramados = DB::table('solicitud_servicios')
            ->select('ID_SolSer', 'SolSerSlug')
            ->where('SolSerDelete', 0)
            ->where(function($query) use ($programacions){
                foreach($programacions as $programacion) { 
                    $query->where('ID_SolSer', '<>', $programacion->FK_ProgServi);
                }
            })
            ->get();
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
        // return $request;
        $validation = Validator::make($request->all(), [
            'ProgVehFecha'        => 'required',
            'ProgVehSalida'       => 'required',
            'FK_ProgVehiculo'     => 'required',
            'FK_ProgConductor'    => 'required',
            'FK_ProgAyudante'     => 'required',
        ]);
        if ($validation->fails()) {
            return back()->withErrors($validation, 'create')->withInput();
        }
        if(date('H', strtotime($request->input('ProgVehSalida'))) >= 12){
            $turno = "0";
        }
        else{
            $turno = "1";
        }
        $programacion = new ProgramacionVehiculo();
        $programacion->ProgVehFecha = $request->input('ProgVehFecha');
        $programacion->ProgVehTurno = $turno;
        $programacion->ProgVehtipo = "1";
        $programacion->ProgVehSalida = $request->input('ProgVehFecha').' '.date('H:i:s', strtotime($request->input('ProgVehSalida')));
        $programacion->FK_ProgVehiculo = $request->input('FK_ProgVehiculo');
        $programacion->FK_ProgMan = "1";
        $programacion->ProgVehColor = $request->input('ProgVehColor');
        $programacion->FK_ProgServi = $request->input('FK_ProgServi');
        $programacion->FK_ProgConductor = $request->input('FK_ProgConductor');
        $programacion->FK_ProgAyudante = $request->input('FK_ProgAyudante');
        $programacion->ProgVehDelete = 0;
        // return $programacion;
        $programacion->save();
        return redirect()->route('vehicle-programacion.create');
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
        $programacion = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
        $programaciones = DB::table('progvehiculos')
            ->select('ID_ProgVeh', 'FK_ProgServi', 'ProgVehEntrada')
            ->where('ID_ProgVeh', '<>', $programacion->ID_ProgVeh)
            ->where('progvehiculos.ProgVehEntrada', '<>', null)
            ->get();
        $vehiculos = DB::table('vehiculos')
            ->select('ID_Vehic','VehicPlaca')
            ->get();
        $servicios = DB::table('solicitud_servicios')
            ->select('ID_SolSer')
            ->where(function($query) use ($programaciones){
                foreach($programaciones as $existentes){
                    $query->where('ID_SolSer', '<>', $existentes->FK_ProgServi);
                }
            })
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
        return view('ProgramacionVehicle.edit', compact('programacion', 'vehiculos', 'servicios', 'conductors', 'ayudantes'));
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
        $validation = Validator::make($request->all(), [
            'ProgVehFecha'        => 'required',
            'ProgVehSalida'       => 'required',
            'FK_ProgVehiculo'     => 'required',
            'ProgVehEntrada'      => Rule::requiredIf($request->ProgVehEntrada),
            'FK_ProgConductor'    => 'required',
            'FK_ProgAyudante'     => 'required',
            'progVehKm'           => Rule::requiredIf($request->ProgVehEntrada)
        ]);
        if ($validation->fails()) {
            return back()->withErrors($validation, 'edit')->withInput();
        }
        $salida = date('H:i:s', strtotime($request->input('ProgVehSalida')));
        $llegada = date('H:i:s', strtotime($request->input('ProgVehEntrada')));
        if($salida >= 12){
            $turno = "0";
        }
        else{
            $turno = "1";
        }
        $programacion = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
        $programacion->FK_ProgServi = $request->input('FK_ProgServi');
        $programacion->ProgVehFecha = $request->input('ProgVehFecha');
        $programacion->ProgVehTurno = $turno;
        $programacion->ProgVehtipo = "1";
        if($request->input('ProgVehEntrada')){
            $programacion->ProgVehEntrada = $request->input('ProgVehFecha').' '.$llegada;
            $programacion->progVehKm = $request->input('progVehKm');
            $vehiculo = Vehiculo::where('ID_Vehic', $request->input('FK_ProgVehiculo'))->first();
            $vehiculo->VehicKmActual = $request->input('progVehKm');
            $vehiculo->save();
        }
        else{
            $programacion->ProgVehEntrada = null;
            $programacion->progVehKm = null;
        }
        $programacion->ProgVehSalida = $request->input('ProgVehFecha').' '.$salida;
        $programacion->FK_ProgVehiculo = $request->input('FK_ProgVehiculo');
        $programacion->FK_ProgMan = "1";
        $programacion->FK_ProgConductor = $request->input('FK_ProgConductor');
        $programacion->FK_ProgAyudante = $request->input('FK_ProgAyudante');
        $programacion->ProgVehColor = $request->input('ProgVehColor');
        $programacion->save();

        $log = new audit();
        $log->AuditTabla="progvehiculos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$programacion->ID_ProgVeh;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        return redirect()->route('vehicle-programacion.edit',['id' => $id])->with('mensaje', trans('adminlte_lang::message.progvehceditsuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programacion = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
        if ($programacion->ProgVehDelete == 0){
            $programacion->ProgVehDelete = 1;

            $log = new audit();
            $log->AuditTabla = "progvehiculos";
            $log->AuditType = "Eliminado";
            $log->AuditRegistro = $programacion->ID_ProgVeh;
            $log->AuditUser = Auth::user()->email;
            $log->Auditlog = $programacion->ProgVehDelete;
            $log->save();
            $programacion->save();
            return redirect()->route('vehicle-programacion.create')->with('Delete', trans('adminlte_lang::message.progvehcdeletesuccess'));
        }
        else{
            $programacion->ProgVehDelete = 0;

            $log = new audit();
            $log->AuditTabla = "progvehiculos";
            $log->AuditType = "Restaurado";
            $log->AuditRegistro = $programacion->ID_ProgVeh;
            $log->AuditUser = Auth::user()->email;
            $log->Auditlog = $programacion->ProgVehDelete;
            $log->save();
            $programacion->save();
            return redirect()->route('vehicle-programacion.edit',['id' => $id])->with('mensaje', trans('adminlte_lang::message.progvehcdelete2success'));
        }
    }
}
