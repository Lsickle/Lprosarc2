<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Contrato;
use App\audit;
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
			$Clientes = Cliente::where('CliDelete', 0)->where('ID_Cli', '<>', 1)->get();
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
		switch ($request->input('ContratoTypeVigencia')) {
			case 'Día(s)':
				$typedate = 'day';
				break;
			case 'Semana(s)':
				$typedate = 'week';
				break;
			case 'Mes(es)':
				$typedate = 'month';
				break;
		}
		$Cliente = Cliente::select('ID_Cli')->where('CliSlug', $request->input('Fk_ContraCli'))->first()->ID_Cli;
		$file = $request['ContraPdf'];
		$ContraPdf = hash('sha256', rand().time().$file->getClientOriginalName()).'.pdf';
		$file->move(public_path().'/img/Contratos/',$ContraPdf);
		$Contrato = new Contrato();
		$Contrato->ContraPdf = $ContraPdf;
		$Contrato->ContraVigencia = $request->input('ContraVigencia');
		$Contrato->ContraNotifiVigencia = date('Y-m-d', strtotime($Contrato->ContraVigencia."- ".$request->input('ContratoNumVigencia')." ".$typedate));
		$Contrato->ContratoNumVigencia = $request->input('ContratoNumVigencia');
		$Contrato->ContratoTypeVigencia = $request->input('ContratoTypeVigencia');
		$Contrato->Fk_ContraCli = $Cliente;
		$Contrato->ContraDelete = 0;
		$Contrato->ContraSlug = hash('sha256', rand().time().$Contrato->ContraPdf);
		$Contrato->save();

		return redirect()->route('contratos.index');
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
	public function edit($id)
	{
		if(in_array(Auth::user()->UsRol, Permisos::CONTRATOSCRUD) || in_array(Auth::user()->UsRol2, Permisos::CONTRATOSCRUD)){
			$Contrato = Contrato::where('ContraSlug', $id)->first();
			if (!$Contrato) {
				abort(404);
			}
			$Clientes = Cliente::where('CliDelete', 0)->where('ID_Cli', '<>', 1)->get();
			// return $Contrato;
			return view('contratos.edit', compact('Clientes', 'Contrato'));
		}
		else{
			abort(403);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Contrato  $contrato
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$Contrato = Contrato::where('ContraSlug', $id)->first();
		if (!$Contrato) {
			abort(404);
		}
		$Cliente = Cliente::select('ID_Cli')->where('CliSlug', $request->input('Fk_ContraCli'))->first()->ID_Cli;
		switch ($request->input('ContratoTypeVigencia')) {
			case 'Día(s)':
				$typedate = 'day';
				break;
			case 'Semana(s)':
				$typedate = 'week';
				break;
			case 'Mes(es)':
				$typedate = 'month';
				break;
		}
		if (isset($request['ContraPdf'])) {
			if($Contrato->ContraPdf <> null && file_exists(public_path().'/img/Contratos/'.$Contrato->ContraPdf)){
				unlink(public_path().'/img/Contratos/'.$Contrato->ContraPdf);
			}
			$file = $request['ContraPdf'];
			$ContraPdf = hash('sha256', rand().time().$file->getClientOriginalName()).'.pdf';
			$file->move(public_path().'/img/Contratos/',$ContraPdf);
		}
		else{
			$ContraPdf = $Contrato->ContraPdf;
		}
		$Contrato->ContraPdf = $ContraPdf;
		$Contrato->ContraVigencia = $request->input('ContraVigencia');
		$Contrato->ContraNotifiVigencia = date('Y-m-d', strtotime($Contrato->ContraVigencia."- ".$request->input('ContratoNumVigencia')." ".$typedate));
		$Contrato->ContratoNumVigencia = $request->input('ContratoNumVigencia');
		$Contrato->ContratoTypeVigencia = $request->input('ContratoTypeVigencia');
		$Contrato->Fk_ContraCli = $Cliente;
		$Contrato->save();

		$log = new audit();
		$log->AuditTabla="contratos";
		$log->AuditType="Modificado";
		$log->AuditRegistro=$Contrato->ID_Contra;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$request->all();
		$log->save();

		return redirect()->route('contratos.edit', [$id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Contrato  $contrato
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$Contrato = Contrato::where('ContraSlug', $id)->first();
		if (!$Contrato) {
			abort(404);
		}
		if ($Contrato->ContraDelete == 0) {
			$Contrato->ContraDelete = 1;
			$Contrato->save();

			$log = new audit();
			$log->AuditTabla="contratos";
			$log->AuditType="Eliminado";
			$log->AuditRegistro=$Contrato->ID_Contra;
			$log->AuditUser=Auth::user()->email;
			$log->Auditlog= $Contrato->ContraDelete;
			$log->save();

			return redirect()->route('contratos.index');
		}
		else{
			if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR)){
				$Contrato->ContraDelete = 0;
				$Contrato->save();

				$log = new audit();
				$log->AuditTabla="contratos";
				$log->AuditType="Restaurado";
				$log->AuditRegistro=$Contrato->ID_Contra;
				$log->AuditUser=Auth::user()->email;
				$log->Auditlog= $Contrato->ContraDelete;
				$log->save();

				return redirect()->route('contratos.edit', [$id]);
			}
			return redirect()->route('contratos.index');
		}
	}
}
