<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Vehiculo;
use App\audit;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $Vehicles = DB::table('vehiculos')
            ->Join('sedes', 'vehiculos.FK_VehiSede', '=', 'sedes.ID_Sede')
            ->select('vehiculos.*', 'sedes.SedeName')
            ->get();
        return view('vehicle.index', compact('Vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Vehicle = new Vehiculo();
        if ($request->input('InternoExterno') == 'on') {
            $Vehicle->VehicInternExtern = '1';
        }else{
            $Vehicle->VehicInternExtern = '0';
        };
        $Vehicle->VehicPlaca = $request->input('placa');
        $Vehicle->VehicCapacidad = $request->input('capacidad');
        $Vehicle->VehicKmActual = $request->input('kmactual');
        $Vehicle->VehicTipo = $request->input('tipo');
        $Vehicle->FK_VehiSede = $request->input('sede');
        $Vehicle->save();

        $log = new audit();
        $log->AuditTabla="vehiculos";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Vehicle->ID_Vehic;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        
        return redirect()->route('vehicle.index');
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
        //
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
