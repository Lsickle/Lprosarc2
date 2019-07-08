<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonalStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Area;
use App\Cargo;
use App\Personal;
use App\audit;
use Permisos;


class PersonalInternoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){
		if(in_array(Auth::user()->UsRol, Permisos::Jefes) || in_array(Auth::user()->UsRol2, Permisos::Jefes)){
			$Personals = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','personals.PersEmail','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'areas.AreaName', 'clientes.ID_Cli')
				->where(function($query){
					$id = userController::IDClienteSegunUsuario();
					/*Validacion para el Administrador ver el personal de Prosarc solo los que no esten eliminados*/
					if(Auth::user()->UsRol <> trans('adminlte_lang::message.Programador')){
						$query->where('clientes.ID_Cli', '=', $id);
						$query->where('personals.PersDelete', '=', 0);
					}
					/*Validacion del Programador para ver todo el personal interno aun asi este eliminado*/
					else{
						$query->where('clientes.ID_Cli', '=', $id);
					}
				})
				->get();
			return view('personal.personalInterno.index', compact('Personals'));
		}
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
	public function create(){
		/*Validacion para personas autorisadas a crear una persona*/
		if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1)){
			$Sedes = DB::table('sedes')
				->select('SedeSlug', 'SedeName')
				->where('FK_SedeCli', userController::IDClienteSegunUsuario())
				->where('SedeDelete', '=', 0)
				->get();
			return view('personal.personalInterno.create', compact('Sedes'));
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
	public function store(PersonalStoreRequest $request){
		$NuevaArea = $request->input('NewArea');
		$NuevoCargo =  $request->input('NewCargo');
		if($request->input('CargArea') <> "NewArea"){
			$NuevaArea = null;
		}
		if($request->input('FK_PersCargo') <> "NewCargo"){
			$NuevoCargo = null;
		}
		/*Valida si se ha creado un nuevo cargo*/
		if($NuevoCargo <> null){
			/*Valida si se ha creado una nueva area*/
			if($NuevaArea <> null){
				$newArea = new Area();
				$newArea->AreaName = $request->input('NewArea');
				$newArea->FK_AreaSede = $request->input('Sede');
				$newArea->AreaDelete = 0;
				$newArea->AreaSlug = hash('sha256', rand().time().$newArea->AreaName);
				$newArea->save();

				$newCargo = new Cargo();
				$newCargo->CargName = $request->input('NewCargo');
				$newCargo->CargArea = $newArea->ID_Area;
				$newCargo->CargDelete = 0;
				$newCargo->CargSlug = hash('sha256', rand().time().$newCargo->CargName);
				$newCargo->save();
				$Cargo = $newCargo->ID_Carg;
			}
			else{
				$newCargo = new Cargo();
				$newCargo->CargName = $request->input('NewCargo');
				$newCargo->CargArea = $request->input('CargArea');
				$newCargo->CargDelete = 0;
				$newCargo->CargSlug = hash('sha256', rand().time().$newCargo->CargName);
				$newCargo->save();
				$Cargo = $newCargo->ID_Carg;
			}
		}
		else{
			$Cargo = Cargo::select('ID_Carg')->where('CargSlug', $request->input('FK_PersCargo'))->first()->ID_Carg;
		}

		$Personal = new Personal();
		$Personal->PersType = 0;
		$Personal->PersDocType = $request->input('PersDocType');
		$Personal->PersDocNumber = $request->input('PersDocNumber');
		$Personal->PersFirstName = $request->input('PersFirstName');
		$Personal->PersSecondName = $request->input('PersSecondName');
		$Personal->PersLastName = $request->input('PersLastName');
		$Personal->PersEmail = $request->input('PersEmail');
		$Personal->PersCellphone = $request->input('PersCellphone');
		$Personal->PersAddress = $request->input('PersAddress');
		$Personal->FK_PersCargo = $Cargo;
		$Personal->PersBirthday = $request->input('PersBirthday');
		$Personal->PersPhoneNumber = $request->input('PersPhoneNumber');
		$Personal->PersEPS = $request->input('PersEPS');
		$Personal->PersARL = $request->input('PersARL');
		$Personal->PersLibreta = $request->input('PersLibreta');
		$Personal->PersBank = $request->input('PersBank');
		$Personal->PersBankAccaunt = $request->input('PersBankAccaunt');
		$Personal->PersIngreso = $request->input('PersIngreso');
		if($request->input('PersSalida') <> null){
			$Personal->PersSalida = $request->input('PersSalida');
		}
		$Personal->PersPase = $request->input('PersPase');
		$Personal->PersDelete = 0;
		$Personal->PersSlug = hash('sha256', rand().time().$Personal->PersDocNumber);
		$Personal->save();

		return redirect()->route('personalInterno.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id){
		$Personas = DB::table('personals')
			->join('cargos', 'FK_PersCargo', '=', 'ID_Carg')
			->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('personals.*', 'cargos.CargName','sedes.SedeName','clientes.ID_Cli')
			->where('PersSlug',$id)
			->get();
		$IDClienteSegunUsuario = userController::IDClienteSegunUsuario();
		 return view('personal.personalInterno.show', compact('Personas', 'IDClienteSegunUsuario'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id){
		if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1)){
			$Persona = Personal::where('PersSlug', $id)->first();
			$Sede = DB::table('sedes')
				->join('areas', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('cargos', 'cargos.CargArea', '=', 'areas.ID_Area')
				->select('sedes.ID_Sede', 'areas.ID_Area', 'cargos.ID_Carg')
				->where('cargos.ID_Carg', $Persona->FK_PersCargo)
				->first();
			$Sedes = DB::table('sedes')
				->select('ID_Sede', 'SedeSlug', 'SedeName')
				->where('FK_SedeCli', userController::IDClienteSegunUsuario())
				->where('SedeDelete', '=', 0)
				->get();
			$Areas = DB::table('areas')
				->select('ID_Area', 'AreaSlug', 'AreaName')
				->where('FK_AreaSede', $Sede->ID_Sede)
				->where('AreaDelete', '=', 0)
				->get();
			$Cargos = DB::table('cargos')
				->select('ID_Carg', 'CargSlug', 'CargName')
				->where('CargArea', $Sede->ID_Area)
				->where('CargDelete', '=', 0)
				->get();
			return view('personal.personalInterno.edit', compact('Persona', 'Sede', 'Cargos', 'Sedes', 'Areas'));
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
		$Persona = Personal::where('PersSlug', $id)->first();
		$validate = $request->validate([
			'Sede'          => 'required',
			'CargArea'      => 'required',
			'FK_PersCargo'  => 'required',
			'PersDocType'   => 'required|in:CC,CE,NIT,RUT',
			'PersDocNumber' => 'required|max:25|unique:personals,PersDocNumber,'.$request->input('PersDocNumber').',PersDocNumber',
			'PersFirstName' => 'required|max:64',
			'PersSecondName'=> 'max:64|nullable',
			'PersLastName'  => 'required|max:64',
			'PersEmail'     => 'required|email|max:255',
			'PersCellphone' => 'required|min:12',
			'PersAddress'   => 'max:255|nullable',
			'PersPhoneNumber' => 'max:20|min:10|nullable',
			'PersEPS'       => 'max:255|min:5|nullable',
			'PersARL'       => 'max:255|min:5|nullable',
			'PersLibreta'   => 'max:25',
			'PersPase'      => 'max:25',
			'PersBank'      => 'max:255',
			'PersBankAccaunt' => 'max:64',
			'PersIngreso'   => 'date',
			'PersSalida'    => 'date|after:PersIngreso|nullable',
		]);
		$NuevaArea = $request->input('NewArea');
		$NuevoCargo =  $request->input('NewCargo');
		if($request->input('CargArea') <> "NewArea"){
			$NuevaArea = null;
		}
		if($request->input('FK_PersCargo') <> "NewCargo"){
			$NuevoCargo = null;
		}
		if($NuevoCargo <> null){
			if($NuevaArea <> null){
				$newArea = new Area();
				$newArea->AreaName = $request->input('NewArea');
				$newArea->FK_AreaSede = $request->input('Sede');
				$newArea->AreaDelete = 0;
				$newArea->AreaSlug = hash('sha256', rand().time().$newArea->AreaName);
				$newArea->save();

				$newCargo = new Cargo();
				$newCargo->CargName = $request->input('NewCargo');
				$newCargo->CargArea = $newArea->ID_Area;
				$newCargo->CargDelete = 0;
				$newCargo->CargSlug = hash('sha256', rand().time().$newCargo->CargName);
				$newCargo->save();
				$Cargo = $newCargo->ID_Carg;
			}
			else{
				$newCargo = new Cargo();
				$newCargo->CargName = $request->input('NewCargo');
				$newCargo->CargArea = $request->input('CargArea');
				$newCargo->CargDelete = 0;
				$newCargo->CargSlug = hash('sha256', rand().time().$newCargo->CargName);
				$newCargo->save();
				$Cargo = $newCargo->ID_Carg;
			}
		}
		else{
			$Cargo = Cargo::select('ID_Carg')->where('CargSlug', $request->input('FK_PersCargo'))->first()->ID_Carg;
		}
		
		$Persona->fill($request->except('FK_PersCargo'));
		$Persona->FK_PersCargo = $Cargo;
		$Persona->save();

		$log = new audit();
		$log->AuditTabla = "personals";
		$log->AuditType = "Modificado";
		$log->AuditRegistro = $Persona->ID_Pers;
		$log->AuditUser = Auth::user()->email;
		$log->Auditlog = $request->all();
		$log->save();

		return redirect()->route('personalInterno.show',['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id){
		$Persona = Personal::where('PersSlug', $id)->first();
		$Cargo = Cargo::where('ID_Carg', $Persona->FK_PersCargo)->first();
		$Area = Area::where('ID_Area', $Cargo->CargArea)->first();
		if ($Persona->PersDelete == 0){
			$Persona->PersDelete = 1;

			$log = new audit();
			$log->AuditTabla = "personals";
			$log->AuditType = "Eliminado";
			$log->AuditRegistro = $Persona->ID_Pers;
			$log->AuditUser = Auth::user()->email;
			$log->Auditlog = $Persona->PersDelete;
			$log->save();
		}
		else{
			$Persona->PersDelete = 0;
			$Cargo->CargDelete = 0;
			$Area->AreaDelete = 0;
			$Cargo->save();
			$Area->save();

			$log = new audit();
			$log->AuditTabla = "personals";
			$log->AuditType = "Restaurado";
			$log->AuditRegistro = $Persona->ID_Pers;
			$log->AuditUser = Auth::user()->email;
			$log->Auditlog = $Persona->PersDelete;
			$log->save();
		}
		$Persona->save();

		return redirect()->route('personalInterno.index');
	}
}
