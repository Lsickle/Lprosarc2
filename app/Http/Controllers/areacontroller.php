<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Area;
use App\Cargo;
use App\Sede;
use App\Personal;
use App\audit;
use Permisos;

class AreaController extends Controller{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){
		if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
			$Areas = DB::table('areas')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('areas.AreaSlug', 'areas.AreaName','areas.AreaDelete','sedes.SedeName','clientes.CliShortname','clientes.ID_Cli')
			->where(function($query){
				$id = userController::IDClienteSegunUsuario();
				/*Validacion del cliente que pueda ver solo las areas que tiene a cargo solo los que no esten eliminados*/
				if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
					$query->where('clientes.ID_Cli', '=', $id);
					$query->where('areas.AreaDelete', '=', 0);
				}
				/*Validacion del Programador para ver todas las areas del cliente aun asi este eliminado*/
				else{
					$query->where('clientes.ID_Cli', '<>', $id);
				}
			})
			->get();
			return view('areas.index', compact('Areas'));
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
			$Sedes = DB::table('sedes')
				->select('SedeSlug', 'SedeName')
				->where('FK_SedeCli', userController::IDClienteSegunUsuario())
				->where('SedeDelete', '=', 0)
				->get();
			return view('areas.create', compact('Sedes'));
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
			'AreaName'       => 'required|min:5|max:128',
			'FK_AreaSede'    => 'required',
		]);
		$area = new Area();
		$area->AreaName = $request->input('AreaName');
		$area->FK_AreaSede= Sede::select('ID_Sede')->where('SedeSlug',$request->input('FK_AreaSede'))->first()->ID_Sede;
		$area->AreaDelete = 0;
		$area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
		$area->save();

		return redirect()->route('areas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 **/
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
			$Areas = Area::where('AreaSlug', $id)->first();
			if (!$Areas) {
				abort(404);
			}
			$Sedes = DB::table('sedes')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('ID_Sede', 'SedeSlug', 'SedeName')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->where('sedes.SedeDelete', '=', 0)
				->get();
			$AreaOne = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->select('ID_Area')
				->where('personals.ID_Pers', '=', Auth::user()->FK_UserPers)
				->first();
			return view('areas.edit', compact('Sedes', 'Areas', 'AreaOne'));
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
			'AreaName'       => 'required|min:5|max:128',
			'FK_AreaSede'    => 'required',
		]);
		$Area = Area::where('AreaSlug', $id)->first();
		if (!$Area) {
			abort(404);
		}
		$Area->AreaName = $request->input('AreaName');
		$Area->FK_AreaSede = Sede::select('ID_Sede')->where('SedeSlug',$request->input('FK_AreaSede'))->first()->ID_Sede;
		$Area->save();

		$log = new audit();
		$log->AuditTabla="areas";
		$log->AuditType="Modificado";
		$log->AuditRegistro=$Area->ID_Area;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$request->all();
		$log->save();

		return redirect()->route('areas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id){
		$Area = Area::where('AreaSlug', $id)->first();
		if (!$Area) {
			abort(404);
		}
		$Cargo = Cargo::where('CargArea', $Area->ID_Area)->get();
			if ($Area->AreaDelete == 0) {
				$Area->AreaDelete = 1;
				for($X=0; $X<count($Cargo); $X++){
					$Cargo[$X]->CargDelete = 1;
					$Cargo[$X]->save();
					$Personal = Personal::where('FK_PersCargo', $Cargo[$X]->ID_Carg)->get();
					for($Y=0; $Y<count($Personal); $Y++){
						$Personal[$Y]->PersDelete = 1;
						$Personal[$Y]->save();
					}
				}

				$log = new audit();
				$log->AuditTabla = "areas";
				$log->AuditType = "Eliminado";
				$log->AuditRegistro = $Area->ID_Area;
				$log->AuditUser = Auth::user()->email;
				$log->Auditlog = $Area->AreaDelete;
				$log->save();
			}
			else{
				$Area->AreaDelete = 0;
				for($X=0; $X<count($Cargo); $X++){
					$Cargo[$X]->CargDelete = 0;
					$Cargo[$X]->save();
					$Personal = Personal::where('FK_PersCargo', $Cargo[$X]->ID_Carg)->get();
					for($Y=0; $Y<count($Personal); $Y++){
						$Personal[$Y]->PersDelete = 0;
						$Personal[$Y]->save();
					}
				}

				$log = new audit();
				$log->AuditTabla = "areas";
				$log->AuditType = "Restaurado";
				$log->AuditRegistro = $Area->ID_Area;
				$log->AuditUser = Auth::user()->email;
				$log->Auditlog = $Area->AreaDelete;
				$log->save();
			}
		$Area->save();

		return redirect()->route('areas.index');
	}
}
