<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MantenimientoVehiculo;
use Illuminate\Support\Facades\DB;
use App\audit;
use Illuminate\Support\Facades\Auth;

class VehicManteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->UsRol === "Programador"){
            $MantVehicles = DB::table('mantenvehics')
                ->join('vehiculos', 'FK_VehMan', '=', 'ID_Vehic')
                ->select('mantenvehics.*', 'vehiculos.VehicPlaca')
                ->get();
            return view('manteniVehicle.index', compact('MantVehicles'));
        }
        $MantVehicles = DB::table('mantenvehics')
            ->join('vehiculos', 'FK_VehMan', '=', 'ID_Vehic')
            ->select('mantenvehics.*', 'vehiculos.VehicPlaca')
            ->where('MvDelete', 0)
            ->get();
        return view('manteniVehicle.index', compact('MantVehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Vehicles = DB::table('vehiculos')
            ->select('ID_Vehic', 'VehicPlaca')
            ->get();
        return view('manteniVehicle.create', compact('Vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $MantVehicles = new MantenimientoVehiculo();
        $MantVehicles->MvKm = $request->input('MvKm');
        $MantVehicles->MvType = $request->input('MvType');
        $MantVehicles->HoraMavInicio = $request->input('HoraMavInicio');
        $MantVehicles->HoraMavFin = $request->input('HoraMavFin');
        $MantVehicles->FK_VehMan = $request->input('FK_VehMan');
        $MantVehicles->MvDelete = 0;
        $MantVehicles->save();

        return redirect()->route('vehicle-mantenimiento.index');
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
        $MantVehicles = MantenimientoVehiculo::where('ID_Mv', $id)->first();
        $Vehicles = DB::table('vehiculos')
            ->select('ID_Vehic', 'VehicPlaca')
            ->get();

        return view('manteniVehicle.edit', compact('Vehicles', 'MantVehicles'));
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
        $MantVehicles = MantenimientoVehiculo::where('ID_Mv', $id)->first();
        $MantVehicles->fill($request->all());
        $MantVehicles->save();
        /*return $MantVehicles;*/

        $log = new audit();
        $log->AuditTabla="mantenvehics";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$MantVehicles->ID_Mv;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('vehicle-mantenimiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $MantVehicles = MantenimientoVehiculo::where('ID_Mv', $id)->first();
        if ($MantVehicles->MvDelete == 0) {
                $MantVehicles->MvDelete = 1;
        }
        else{
            $MantVehicles->MvDelete = 0;
        }
        $MantVehicles->save();

        $log = new audit();
        $log->AuditTabla="mantenvehics";
        $log->AuditType = "Eliminado";
        $log->AuditRegistro=$MantVehicles->ID_Mv;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $MantVehicles->MvDelete;
        $log->save();

        return redirect()->route('vehicle-mantenimiento.index');
    }
}
