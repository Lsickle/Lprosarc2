<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Contrato;
use Permisos;
use App\Cliente;

class ContratoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if(in_array(Auth::user()->UsRol, Permisos::CONTRATOS) || in_array(Auth::user()->UsRol2, Permisos::CONTRATOS)){
			$Contratos = DB::table('contratos')
				->join('clientes', 'contratos.Fk_ContraCli', 'clientes.ID_Cli')
				->select('contratos.*', 'clientes.CliShortname')
				->where(function($query){
					// $id = userController::IDClienteSegunUsuario();
						/*Validacion del Programador para ver todas los cargos aun asi este eliminado*/
						// if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
							// $query->where('clientes.ID_Cli', '=', $id);
						// }
						/*Validacion del personal de Prosarc autorizado para los contratos que no esten eliminados*/
						// else{
							// $query->where('clientes.ID_Cli', '=', $id);
							// $query->where('cargos.CargDelete', '=', 0);
						// }
					}
				)
				->get();
			return view('contratos.index', compact('Contratos'));
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
		if(in_array(Auth::user()->UsRol, Permisos::CONTRATOSCRUD) || in_array(Auth::user()->UsRol2, Permisos::CONTRATOSCRUD)){
			$Clientes = Cliente::where('CliDelete', 0)->get();
			return view('contratos.create', compact('Clientes'));
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Contrato  $contrato
	 * @return \Illuminate\Http\Response
	 */
	public function show(Contrato $contrato)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Contrato  $contrato
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Contrato $contrato)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Contrato  $contrato
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Contrato $contrato)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Contrato  $contrato
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Contrato $contrato)
	{
		//
	}
}
