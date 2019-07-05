<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
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
		if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol2 <> trans('adminlte_lang::message.Cliente')){
			$MantVehicles = DB::table('mantenvehics')
				->join('vehiculos', 'FK_VehMan', '=', 'ID_Vehic')
				->select('mantenvehics.*', 'vehiculos.VehicPlaca')
				->where(function($query){
					if(Auth::user()->UsRol <> trans('adminlte_lang::message.Programador')){
						$query->where('MvDelete', 0);
					}
				})
				->get();
			return view('manteniVehicle.index', compact('MantVehicles'));
		/*Validacion para usuarios no permitidos en esta vista*/
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
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$messages = [
			'after' => 'El campo :attribute debe ser una hora posterior a :date.',
		];
		$validation = Validator::make($request->all(), [
			'FK_VehMan'        => 'required',
			'MvKm'             => 'required|numeric',
			'HoraMavInicio1'   => 'required|date',
			'HoraMavInicio'    => 'required',
			'HoraMavFin1'      => 'required|date|after_or_equal:HoraMavInicio1',
			'HoraMavFin'       => 'required',
			'MvType'           => 'required|max:255',
		]);
		if($request->input('HoraMavInicio1') == $request->input('HoraMavFin1')){
			$validation = Validator::make($request->all(), [
				'HoraMavInicio'    => 'required',
				'HoraMavFin'       => 'required|after:HoraMavInicio',
			], $messages);
		}
		if ($validation->fails()) {
			return back()->withErrors($validation, 'createManVeh')->withInput();
		}
		$MantVehicles = new MantenimientoVehiculo();
		$MantVehicles->MvKm = $request->input('MvKm');
		$MantVehicles->MvType = $request->input('MvType');
		$MantVehicles->HoraMavInicio = $request->input('HoraMavInicio1').' '.$request->input('HoraMavInicio');
		$MantVehicles->HoraMavFin = $request->input('HoraMavFin1').' '.$request->input('HoraMavFin');
		$MantVehicles->FK_VehMan = $request->input('FK_VehMan');
		$MantVehicles->MvDelete = 0;
		$MantVehicles->save();

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
		$MantVehicles = MantenimientoVehiculo::where('ID_Mv', $id)->first();
		$vehiculos = DB::table('vehiculos')
			->select('ID_Vehic', 'VehicPlaca')
			->get();

		return view('manteniVehicle.edit', compact('vehiculos', 'MantVehicles'));
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
		$messages = [
			'after' => 'El campo :attribute debe ser una hora posterior a :date.',
		];
		$validation = Validator::make($request->all(), [
			'FK_VehMan'        => 'required',
			'MvKm'             => 'required',
			'HoraMavInicio1'   => 'required|date',
			'HoraMavInicio'    => 'required',
			'HoraMavFin1'      => 'required|date|after_or_equal:HoraMavInicio1',
			'HoraMavFin'       => 'required',
			'MvType'           => 'required|max:255',
		]);
		if($request->input('HoraMavInicio1') == $request->input('HoraMavFin1')){
			$validation = Validator::make($request->all(), [
				'HoraMavInicio'    => 'required',
				'HoraMavFin'       => 'required|after:HoraMavInicio',
			], $messages);
		}
		if ($validation->fails()) {
			return back()->withErrors($validation, 'createManVeh')->withInput();
		}
		$MantVehicles = MantenimientoVehiculo::where('ID_Mv', $id)->first();
		$MantVehicles->FK_VehMan = $request->input('FK_VehMan');
		$MantVehicles->MvKm = $request->input('MvKm');
		$MantVehicles->HoraMavInicio = $request->input('HoraMavInicio1').' '.$request->input('HoraMavInicio');
		$MantVehicles->HoraMavFin = $request->input('HoraMavFin1').' '.$request->input('HoraMavFin');
		$MantVehicles->MvType = $request->input('MvType');
		$MantVehicles->save();

		$log = new audit();
		$log->AuditTabla="mantenvehics";
		$log->AuditType="Modificado";
		$log->AuditRegistro=$MantVehicles->ID_Mv;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$request->all();
		$log->save();

		return redirect()->route('vehicle-mantenimiento.edit',['id' => $id])->with('Mensaje', trans('adminlte_lang::message.updatetrue'));
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
				$log = new audit();
				$log->AuditTabla="mantenvehics";
				$log->AuditType = "Eliminado";
				$log->AuditRegistro=$MantVehicles->ID_Mv;
				$log->AuditUser = Auth::user()->email;
				$log->Auditlog = $MantVehicles->MvDelete;
				$log->save();
		}
		else{
			$MantVehicles->MvDelete = 0;
			$log = new audit();
			$log->AuditTabla="mantenvehics";
			$log->AuditType = "Restaurado";
			$log->AuditRegistro=$MantVehicles->ID_Mv;
			$log->AuditUser = Auth::user()->email;
			$log->Auditlog = $MantVehicles->MvDelete;
			$log->save();
		}
		$MantVehicles->save();

		return redirect()->route('vehicle-mantenimiento.index');
	}
}
