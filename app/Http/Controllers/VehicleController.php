<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Vehiculo;
use App\audit;
use Permisos;

class VehicleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{ 
		if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC)){
			$Vehicles = DB::table('vehiculos')
				->Join('sedes', 'vehiculos.FK_VehiSede', '=', 'sedes.ID_Sede')
				->select('vehiculos.*', 'sedes.SedeName')
				->where(function($query){
					if(!in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
						$query->where('VehicDelete', 0);
					}
				})
				->get();
			return view('vehicle.index', compact('Vehicles'));
		}
		else{
			abort(403);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1)){
			$Sedes = DB::table('sedes')
				->select('ID_Sede', 'SedeName')
				->where('FK_SedeCli', userController::IDClienteSegunUsuario())
				->where('SedeDelete', 0)
				->get();
			return view('vehicle.create', compact('Sedes'));
		}
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
		$Vehicle = new Vehiculo();
		$Vehicle->VehicPlaca = $request->input('VehicPlaca');
		$Vehicle->VehicCapacidad = $request->input('VehicCapacidad');
		$Vehicle->VehicKmActual = $request->input('VehicKmActual');
		$Vehicle->VehicTipo = $request->input('VehicTipo');
		$Vehicle->FK_VehiSede = $request->input('FK_VehiSede');
		$Vehicle->VehicInternExtern = 1;
		$Vehicle->VehicDelete = 0;
		$Vehicle->save();
		
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
		if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1)){
			$Vehicle = Vehiculo::where('VehicPlaca', $id)->first();
			if (!$Vehicle) {
				abort(404);
			}
			$Sedes = DB::table('sedes')
				->select('ID_Sede', 'SedeName')
				->where('FK_SedeCli', userController::IDClienteSegunUsuario())
				->where('SedeDelete', 0)
				->get();
			return view('vehicle.edit', compact('Vehicle','Sedes'));
		}
		else{
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
		$Vehicle = Vehiculo::where('VehicPlaca', $id)->first();
		if (!$Vehicle) {
			abort(404);
		}
		$Vehicle->fill($request->all());
		$Vehicle->VehicInternExtern = 1;
		$Vehicle->save();

		$log = new audit();
		$log->AuditTabla="vehiculos";
		$log->AuditType="Modificado";
		$log->AuditRegistro=$Vehicle->VehicPlaca;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$request->all();
		$log->save();

		return redirect()->route('vehicle.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$Vehicle = Vehiculo::where('VehicPlaca', $id)->first();
		if (!$Vehicle) {
			abort(404);
		}
			if ($Vehicle->VehicDelete == 0) {
				$Vehicle->VehicDelete = 1;
			}
			else{
				$Vehicle->VehicDelete = 0;
			}
		$Vehicle->save();

		$log = new audit();
		$log->AuditTabla = "vehiculos";
		$log->AuditType = "Eliminado";
		$log->AuditRegistro = $Vehicle->VehicPlaca;
		$log->AuditUser = Auth::user()->email;
		$log->Auditlog = $Vehicle->VehicDelete;
		$log->save();

		return redirect()->route('vehicle.index');
	}
}
