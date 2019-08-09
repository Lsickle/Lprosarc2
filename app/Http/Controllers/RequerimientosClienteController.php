<?php

namespace App\Http\Controllers;

use App\RequerimientosCliente;
use Illuminate\Http\Request;

class RequerimientosClienteController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
		$requerimiento = new RequerimientosCliente();
		if(!is_null($request->input('RequeCliBascula'))){
			$requerimiento->RequeCliBascula = 1;
		}
		else{
			$requerimiento->RequeCliBascula = 0;
		}
		if(!is_null($request->input('RequeCliCapacitacion'))){
			$requerimiento->RequeCliCapacitacion = 1;
		}
		else{
			$requerimiento->RequeCliCapacitacion = 0;
		}
		if(!is_null($request->input('RequeCliMasPerson'))){
			$requerimiento->RequeCliMasPerson = 1;
		}
		else{
			$requerimiento->RequeCliMasPerson = 0;
		}
		if(!is_null($request->input('RequeCliVehicExclusive'))){
			$requerimiento->RequeCliVehicExclusive = 1;
		}
		else{
			$requerimiento->RequeCliVehicExclusive = 0;
		}
		if(!is_null($request->input('RequeCliPlatform'))){
			$requerimiento->RequeCliPlatform = 1;
		}
		else{
			$requerimiento->RequeCliPlatform = 0;
		}
		$requerimiento->FK_RequeClient = $request->input('FK_RequeClient');
		$requerimiento->save();
		
		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\RequerimientosCliente  $requerimientosCliente
	 * @return \Illuminate\Http\Response
	 */
	public function show(RequerimientosCliente $requerimientosCliente)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\RequerimientosCliente  $requerimientosCliente
	 * @return \Illuminate\Http\Response
	 */
	public function edit(RequerimientosCliente $requerimientosCliente)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\RequerimientosCliente  $requerimientosCliente
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, RequerimientosCliente $requerimientosCliente)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\RequerimientosCliente  $requerimientosCliente
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(RequerimientosCliente $requerimientosCliente)
	{
		//
	}
}
