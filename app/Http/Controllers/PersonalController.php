<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonalStoreRequest;
use App\Http\Requests\PersonalUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Area;
use App\Cargo;
use App\Personal;
use App\audit;
use App\Sede;
use Permisos;


class PersonalController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){
		$Personals = DB::table('personals')
			->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
			->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','personals.PersEmail','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'personals.PersFactura', 'areas.AreaName', 'clientes.ID_Cli', 'clientes.CliName')
			->where(function($query){
				$id = userController::IDClienteSegunUsuario();
				/*Validacion del cliente que pueda ver solo el personal que tiene a cargo solo los que no esten eliminados*/
				if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
					$query->where('clientes.ID_Cli', '=', $id);
					$query->where('personals.PersDelete', '=', 0);
				}
				/*Validacion del Programador para ver todo el personal externo aun asi este eliminado*/
				else if(in_array(Auth::user()->UsRol,	 Permisos::PROGRAMADOR)){
					$query->where('clientes.ID_Cli', '<>', $id);
				}
				/*Validacion del personal de Prosarc autorizado para el personal del cliente solo los que no esten eliminados*/
				else{
					$query->where('clientes.ID_Cli', '<>', $id);
                    $query->where('clientes.CliDelete', 0);
					$query->where('personals.PersDelete', '=', 0);
				}
			})
			->get();

		$IDClienteSegunUsuario = userController::IDClienteSegunUsuario();

		/*registro de persona habilitada para facturación del cliente*/
		$IdPersonaFacturacion = DB::table('personals')
			->join('cargos', 'FK_PersCargo', '=', 'ID_Carg')
			->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('personals.ID_Pers')
			->where('PersFactura', 1)
			->where('ID_Cli', $IDClienteSegunUsuario)
			->get();

		/*registro de persona habilitada para administracion de usuarios del cliente*/
		$IdPersonaAdmin = DB::table('personals')
			->join('cargos', 'FK_PersCargo', '=', 'ID_Carg')
			->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('personals.ID_Pers')
			->where('PersAdmin', 1)
			->where('ID_Cli', $IDClienteSegunUsuario)
			->get();

		return view('personal.index', compact('Personals', 'IdPersonaFacturacion', 'IdPersonaAdmin'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(){
		/*Validacion para personas autorisadas a crear una persona*/
		if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
			$Sedes = DB::table('sedes')
				->select('SedeSlug', 'SedeName')
				->where('FK_SedeCli', userController::IDClienteSegunUsuario())
				->where('SedeDelete', '=', 0)
				->get();
			return view('personal.create', compact('Sedes'));
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
			if($request->input('FK_PersCargo') <> "NewCargo"){
				$NuevoCargo = null;
			}
		}
		/*Valida si se ha creado un nuevo cargo*/
		if($NuevoCargo <> null){
			/*Valida si se ha creado una nueva area*/
			if($NuevaArea <> null){
				$Sede = Sede::select('ID_Sede')->where('SedeSlug', $request->input('Sede'))->first();
				$newArea = new Area();
				$newArea->AreaName = $request->input('NewArea');
				$newArea->FK_AreaSede = $Sede->ID_Sede;
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
				$Area = Area::select('ID_Area')->where('AreaSlug', $request->input('CargArea'))->first();
				$newCargo = new Cargo();
				$newCargo->CargName = $request->input('NewCargo');
				$newCargo->CargArea = $Area->ID_Area;
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
		$Personal->PersType = 1;
		$Personal->PersDocType = $request->input('PersDocType');
		$Personal->PersDocNumber = $request->input('PersDocNumber');
		$Personal->PersFirstName = $request->input('PersFirstName');
		$Personal->PersSecondName = $request->input('PersSecondName');
		$Personal->PersLastName = $request->input('PersLastName');
		$Personal->PersEmail = $request->input('PersEmail');
		$Personal->PersCellphone = $request->input('PersCellphone');
		$Personal->PersAddress = $request->input('PersAddress');
		$Personal->FK_PersCargo = $Cargo;
		$Personal->PersDelete = 0;
		$Personal->PersSlug = hash('sha256', rand().time().$Personal->PersDocNumber);
		$Personal->save();

		return redirect()->route('personal.index');
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
		if (!$Personas) {
			abort(404);
		}
		$IDClienteSegunUsuario = userController::IDClienteSegunUsuario();
		return view('personal.show', compact('Personas', 'IDClienteSegunUsuario'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id){
		$IDClienteSegunUsuario = userController::IDClienteSegunUsuario();
		$Persona = DB::table('personals')
			->join('cargos', 'FK_PersCargo', '=', 'ID_Carg')
			->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('personals.*', 'cargos.CargName','sedes.SedeName','clientes.ID_Cli')
			->where('PersSlug', $id)
			->first();

		/*registro de persona habilitada para administracion de usuarios del cliente*/
		$IdPersonaAdmin = DB::table('personals')
			->join('cargos', 'FK_PersCargo', '=', 'ID_Carg')
			->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('personals.ID_Pers')
			->where('PersAdmin', 1)
			->where('ID_Cli', $IDClienteSegunUsuario)
			->get();

		/*registro de persona habilitada para administracion de usuarios del cliente*/
		$IdPersonaFacturacion = DB::table('personals')
			->join('cargos', 'FK_PersCargo', '=', 'ID_Carg')
			->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('personals.ID_Pers')
			->where('personals.PersFactura', 1)
			->where('ID_Cli', $IDClienteSegunUsuario)
			->get();

		if($Persona->ID_Cli == $IDClienteSegunUsuario || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
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
			return view('personal.edit', compact('Persona', 'Sede', 'Cargos', 'Sedes', 'Areas', 'IdPersonaAdmin', 'IdPersonaFacturacion'));
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
	public function update(PersonalUpdateRequest $request, $id){
		$Persona = Personal::where('PersSlug', $id)->first();
		if (!$Persona) {
			abort(404);
		}

		$NuevaArea = $request->input('NewArea');
		$NuevoCargo =  $request->input('NewCargo');
		if($request->input('CargArea') <> "NewArea"){
			$NuevaArea = null;
			if($request->input('FK_PersCargo') <> "NewCargo"){
				$NuevoCargo = null;
			}
		}
		if($NuevoCargo <> null){
			if($NuevaArea <> null){
				$Sede = Sede::select('ID_Sede')->where('SedeSlug', $request->input('Sede'))->first();
				$newArea = new Area();
				$newArea->AreaName = $request->input('NewArea');
				$newArea->FK_AreaSede = $Sede->ID_Sede;
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
				$Area = Area::select('ID_Area')->where('AreaSlug', $request->input('CargArea'))->first();
				$newCargo = new Cargo();
				$newCargo->CargName = $request->input('NewCargo');
				$newCargo->CargArea = $Area->ID_Area;
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
		$Persona->Persfactura = $request->input('Persfactura');
		$Persona->PersAdmin = $request->input('PersAdmin');

		$IDClienteSegunUsuario = userController::IDClienteSegunUsuario();

		/*registro de persona habilitada para facturación del cliente*/
		$IdPersonaFacturacion = DB::table('personals')
			->join('cargos', 'FK_PersCargo', '=', 'ID_Carg')
			->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('personals.ID_Pers')
			->where('PersFactura', 1)
			->where('ID_Cli', $IDClienteSegunUsuario)
			->get();

		/*registro de persona habilitada para administracion de usuarios del cliente*/
		$IdPersonaAdmin = DB::table('personals')
			->join('cargos', 'FK_PersCargo', '=', 'ID_Carg')
			->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('personals.ID_Pers')
			->where('PersAdmin', 1)
			->where('ID_Cli', $IDClienteSegunUsuario)
			->get();

		if (($Persona->Persfactura == 1)&&($IdPersonaAdmin[0]->ID_Pers == Auth::user()->FK_UserPers)) {
			/*se quita la condicion de facturacion a la persona de facturacion actual*/
			$Personadefacturacion = Personal::where('ID_Pers', $IdPersonaFacturacion[0]->ID_Pers)->first();
			$Personadefacturacion->Persfactura = 0;
			$Personadefacturacion->save();
		}
		if (($Persona->Persfactura == 0)&&($IdPersonaAdmin[0]->ID_Pers == Auth::user()->FK_UserPers)) {
			/*se quita la condicion de facturacion a la persona de facturacion actual*/
			// $Personadefacturacion = Personal::where('ID_Pers', $IdPersonaFacturacion[0]->ID_Pers)->first();
			// $Personadefacturacion->Persfactura = 0;
			// $Personadefacturacion->save();

			/*en caso de que vaya a quedar el cliente sin persona de facturacion*/
			if (($Persona->ID_Pers == $IdPersonaFacturacion[0]->ID_Pers)) {
				$Personadefacturacionpredeterminada = Personal::where('ID_Pers', $IdPersonaAdmin[0]->ID_Pers)->first();
				$Personadefacturacionpredeterminada->Persfactura = 1;
				$Personadefacturacionpredeterminada->save();
				if ($Persona->ID_Pers == $IdPersonaAdmin[0]->ID_Pers) {
					$Persona->Persfactura = 1;
				}
			}
		}
		if (($Persona->PersAdmin == 1)&&($IdPersonaAdmin[0]->ID_Pers == Auth::user()->FK_UserPers)) {
			/*se quita la condicion de administracion a la persona de administracion actual*/

			$Personadeadministracion = Personal::where('ID_Pers', $IdPersonaAdmin[0]->ID_Pers)->first();
			if ($Persona->ID_Pers == Auth::user()->FK_UserPers) {
				$Personadeadministracion->PersAdmin = 1;
			}else{
				$Personadeadministracion->PersAdmin = 0;
			}
			$Personadeadministracion->save();
		}
		$Persona->save();

		$log = new audit();
		$log->AuditTabla = "personals";
		$log->AuditType = "Modificado";
		$log->AuditRegistro = $Persona->ID_Pers;
		$log->AuditUser = Auth::user()->email;
		$log->Auditlog = $request->all();
		$log->save();

		return redirect()->route('personal.show',  ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id){
		$Persona = Personal::where('PersSlug', $id)->first();
		if (!$Persona) {
			abort(404);
		}
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


		return redirect()->route('personal.index');
	}
}
