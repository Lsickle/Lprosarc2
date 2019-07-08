<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\audit;
use App\Area;
use App\Cargo;
use App\Personal;
use Illuminate\Support\Facades\Hash;


class CargoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){
		if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
			$Cargos = DB::table('cargos')
				->join('areas','cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('cargos.CargSlug','cargos.CargDelete','cargos.CargName','cargos.CargSalary','cargos.CargGrade','areas.AreaName','clientes.ID_Cli', 'clientes.CliShortname')
				->where(function($query){
						$id = userController::IDClienteSegunUsuario();
						/*Validacion del cliente que pueda ver solo los cargos que tiene a cargo solo los que no esten eliminados*/
						if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
							$query->where('clientes.ID_Cli', '=', $id);
							$query->where('cargos.CargDelete', '=', 0);
						}
						/*Validacion del Programador para ver todas los cargos del cliente aun asi este eliminado*/
						else{
							$query->where('clientes.ID_Cli', '<>', $id);
						}
					}
				)
			->get();
			return view('cargos.index', compact('Cargos'));
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
	public function create(){
		if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
			$Areas = DB::table('areas')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('areas.AreaSlug', 'areas.AreaName')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->where('areas.AreaDelete', '=', 0)
				->get();
			return view('cargos.create', compact('Areas'));
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
	public function store(Request $request){
		$validate = $request->validate([
			'CargName'       => 'required|min:5|max:128',
			'CargArea'       => 'required',
		]);
		$cargo = new Cargo();
		$cargo->CargName = $request->input('CargName');
		$cargo->CargArea = Area::select('ID_Area')->where('AreaSlug', $request->input('CargArea'))->first()->ID_Area;
		$cargo->CargDelete = 0;
		$cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
		$cargo->save();

		return redirect()->route('cargos.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id){
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id){
		if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
			$Cargos = Cargo::where('CargSlug', $id)->first();
			$Areas = DB::table('areas')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('areas.ID_Area', 'areas.AreaSlug', 'areas.AreaName')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->where('areas.AreaDelete', '=', 0)
				->get();
			$CargoOne = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->select('ID_Carg')
				->where('personals.ID_Pers', '=', Auth::user()->FK_UserPers)
				->first();
			return view('cargos.edit', compact('Areas','Cargos', 'CargoOne'));
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
	public function update(Request $request, $id){
		$validate = $request->validate([
			'CargName'       => 'required|min:5|max:128',
			'CargArea'       => 'required',
		]);
		$Cargo = Cargo::where('CargSlug', $id)->first();
		$Cargo->CargName = $request->input('CargName');
		$Cargo->CargArea = Area::select('ID_Area')->where('AreaSlug', $request->input('CargArea'))->first()->ID_Area;
		$Cargo->save();

		$log = new audit();
		$log->AuditTabla="cargos";
		$log->AuditType="Modificado";
		$log->AuditRegistro=$Cargo->ID_Carg;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$request->all();
		$log->save();

		return redirect()->route('cargos.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id){
		$Cargo = Cargo::where('CargSlug', $id)->first();
		$Personal = Personal::where('FK_PersCargo', $Cargo->ID_Carg)->get();
			if ($Cargo->CargDelete == 0) {
				$Cargo->CargDelete = 1;
				for($Y=0; $Y<count($Personal); $Y++){
					$Personal[$Y]->PersDelete = 1;
					$Personal[$Y]->save();
				}

				$log = new audit();
				$log->AuditTabla = "cargos";
				$log->AuditType = "Eliminado";
				$log->AuditRegistro = $Cargo->ID_Carg;
				$log->AuditUser = Auth::user()->email;
				$log->Auditlog = $Cargo->CargDelete;
				$log->save();
			}
			else{
				$Cargo->CargDelete = 0;
				for($Y=0; $Y<count($Personal); $Y++){
					$Personal[$Y]->PersDelete = 0;
					$Personal[$Y]->save();
				}
				$Area = Area::where('ID_Area', $Cargo->CargArea)->first();
				$Area->AreaDelete = 0;
				$Area->save();

				$log = new audit();
				$log->AuditTabla = "cargos";
				$log->AuditType = "Restaurado";
				$log->AuditRegistro = $Cargo->ID_Carg;
				$log->AuditUser = Auth::user()->email;
				$log->Auditlog = $Cargo->CargDelete;
				$log->save();
			}
		$Cargo->save();

		return redirect()->route('cargos.index');
	}
}
