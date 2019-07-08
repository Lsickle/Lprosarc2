<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SolServStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\userController;
use App\Http\Controllers\SolicitudResiduoController;
use App\SolicitudServicio;
use App\SolicitudResiduo;
use App\audit;
use App\Sede;
use App\GenerSede;
use App\Respel;
use App\ResiduosGener;
use App\Cliente;
use App\Tratamiento;
use App\Generador;
use App\Personal;
use App\Departamento;
use App\Municipio;
use App\ProgramacionVehiculo;


class SolicitudServicioController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$Servicios = DB::table('solicitud_servicios')
			->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
			->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
			->select('solicitud_servicios.*', 'clientes.CliShortname', 'clientes.CliSlug','personals.PersFirstName','personals.PersLastName', 'personals.PersSlug')
			->where(function($query){
				if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
					$query->where('ID_Cli',userController::IDClienteSegunUsuario());
				}
			})
			->get();
		foreach ($Servicios as $servicio) {
			if($servicio->SolSerTypeCollect == 98){
				$Address = Sede::select('SedeAddress')->where('ID_Sede',$servicio->SolSerCollectAddress)->first();
				$servicio->SolSerCollectAddress = $Address->SedeAddress;
			}
		}

		return view('solicitud-serv.index', compact('Servicios', 'Residuos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol2 === trans('adminlte_lang::message.Cliente')){
			$Departamentos = Departamento::all();
			$Cliente = Cliente::select('CliShortname','ID_Cli')->where('ID_Cli',userController::IDClienteSegunUsuario())->first();
			$Sedes = Sede::select('SedeSlug','SedeName')->where('FK_SedeCli', $Cliente->ID_Cli)->get();
			$SGeneradors = DB::table('gener_sedes')
				->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
				->join('sedes', 'generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('gener_sedes.GSedeSlug', 'gener_sedes.GSedeName', 'generadors.GenerShortname')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->get();
			$Personals = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('personals.PersSlug', 'personals.PersFirstName', 'personals.PersLastName')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->get();
			return view('solicitud-serv.create', compact('Personals','Cliente', 'SGeneradors', 'Departamentos', 'Sedes'));
		}
		else{
			abort(403);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\  $request 
	 * @return \Illuminate\Http\Response
	 */
	public function store(SolServStoreRequest $request)
	{
		// return $request;
		$SolicitudServicio = new SolicitudServicio();
		$SolicitudServicio->SolSerStatus = 'Pendiente';
		switch ($request->input('SolResAuditoriaTipo')) {
			case 99:
				$SolicitudServicio->SolSerAuditable = 1;
				$SolicitudServicio->SolResAuditoriaTipo = "Virtual";
				break;
			case 98:
				$SolicitudServicio->SolSerAuditable = 1;
				$SolicitudServicio->SolResAuditoriaTipo = "Presencial";
				break;
			case 97:
				$SolicitudServicio->SolSerAuditable = 0;
				$SolicitudServicio->SolResAuditoriaTipo = "No Auditable";
				break;
		}
		if($request->input('SolSerTipo') == 99){
			$cliente = DB::table('clientes')
				->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
				->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
				->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName')
				->where('ID_Cli', 1)
				->first();
			$tipo = "Interno";
			$transportadorname = $cliente->CliName;
			$transportadornit = $cliente->CliNit;
			$transportadoradress = $cliente->SedeAddress;
			$transportadorcity = $cliente->MunName;
			$conductor = null;
			$vehiculo = null;
		}
		else{
			if($request->input('SolSerTransportador') <> 98){
				$cliente = DB::table('clientes')
					->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
					->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
					->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName')
					->where('ID_Cli', userController::IDClienteSegunUsuario())
					->first();
				$transportadorname = $cliente->CliName;
				$transportadornit = $cliente->CliNit;
				$transportadoradress = $cliente->SedeAddress;
				$transportadorcity = $cliente->MunName;
			}
			else{
				$municipio = Municipio::select('MunName')->where('ID_Mun', $request->input('SolSerCityTrans'))->first();
				$transportadorname = $request->input('SolSerNameTrans');
				$transportadornit = $request->input('SolSerNitTrans');
				$transportadoradress = $request->input('SolSerAdressTrans');
				$transportadorcity = $municipio->MunName;
			}
			$tipo = "Externo";
			$conductor = $request->input('SolSerConductor');
			$vehiculo = $request->input('SolSerVehiculo');
		}
		$direccioncollect = 'No aplica';
		switch ($request->input('SolSerTypeCollect')) {
			case 99:
				$direccioncollect = "Recolección en la sede de cada generador";
				break;
			case 98:
				$sede = Sede::select('ID_Sede')->where('SedeSlug', $request->input('SedeCollect'))->first();
				$direccioncollect = $sede->ID_Sede;
				break;
			case 97:
				$direccioncollect = $request->input('AddressCollect');
				break;
		}
		$SolicitudServicio->SolSerTipo = $tipo;
		$SolicitudServicio->SolSerNameTrans = $transportadorname;
		$SolicitudServicio->SolSerNitTrans = $transportadornit;
		$SolicitudServicio->SolSerAdressTrans = $transportadoradress;
		$SolicitudServicio->SolSerCityTrans = $transportadorcity;
		$SolicitudServicio->SolSerConductor = $conductor;
		$SolicitudServicio->SolSerVehiculo = $vehiculo;
		$SolicitudServicio->SolSerTypeCollect = $request->input('SolSerTypeCollect');
		$SolicitudServicio->SolSerCollectAddress = $direccioncollect;
		if($request->input('SolSerBascula')){
			$SolicitudServicio->SolSerBascula = 1;
		}
		if($request->input('SolSerCapacitacion')){
			$SolicitudServicio->SolSerCapacitacion = 1;
		}
		if($request->input('SolSerMasPerson')){
			$SolicitudServicio->SolSerMasPerson = 1;
		}
		if($request->input('SolSerVehicExclusive')){
			$SolicitudServicio->SolSerVehicExclusive = 1;
		}
		if($request->input('SolSerPlatform')){
			$SolicitudServicio->SolSerPlatform = 1;
		}
		if($request->input('SolSerDevolucion')){
			$SolicitudServicio->SolSerDevolucion = 1;
			$SolicitudServicio->SolSerDevolucionTipo = $request->input('SolSerDevolucionTipo');
		}
		$SolicitudServicio->SolSerSlug = hash('sha256', rand().time().$SolicitudServicio->SolSerNameTrans);
		$SolicitudServicio->SolSerDelete = 0;
		$SolicitudServicio->FK_SolSerPersona = Personal::select('ID_Pers')->where('PersSlug',$request->input('FK_SolSerPersona'))->first()->ID_Pers;
		$SolicitudServicio->FK_SolSerCliente = userController::IDClienteSegunUsuario();
		$SolicitudServicio->save();
		$this->createSolRes($request, $SolicitudServicio->ID_SolSer);
		return redirect()->route('solicitud-servicio.show', ['id' => $SolicitudServicio->SolSerSlug]);
	}


	/*
	*
	* Create from solicitud de residuo
	*
	*/
	public function createSolRes($request, $ID_SolSer){
		foreach ($request->input('SGenerador') as $Generador => $value) {
			for ($y=0; $y < count($request['FK_SolResRg'][$Generador]); $y++) {
				$SolicitudResiduo = new SolicitudResiduo();
				$SolicitudResiduo->SolResKgEnviado = $request['SolResKgEnviado'][$Generador][$y];
				$SolicitudResiduo->SolResKgRecibido = 0;
				$SolicitudResiduo->SolResKgConciliado = 0;
				$SolicitudResiduo->SolResKgTratado = 0;
				$SolicitudResiduo->SolResDelete = 0;
				$SolicitudResiduo->SolResSlug = hash('sha256', rand().time().$SolicitudResiduo->SolResKgEnviado);
				$SolicitudResiduo->FK_SolResSolSer = $ID_SolSer;
				if($request['SolResTypeUnidad'][$Generador][$y] == 99){
					$SolicitudResiduo->SolResTypeUnidad = "Unidad";
				}
				else if($request['SolResTypeUnidad'][$Generador][$y] == 98){
					$SolicitudResiduo->SolResTypeUnidad = "Litros";
				}
				$SolicitudResiduo->SolResCantiUnidad = $request['SolResCantiUnidad'][$Generador][$y];
				switch ($request['SolResEmbalaje'][$Generador][$y]) {
					case 99:
						$SolicitudResiduo->SolResEmbalaje = "Sacos/Bolsas";
						break;
					case 98:
						$SolicitudResiduo->SolResEmbalaje = "Bidones Pequeños";
						break;
					case 97:
						$SolicitudResiduo->SolResEmbalaje = "Bidones Grandes";
						break;
					case 96:
						$SolicitudResiduo->SolResEmbalaje = "Estibas";
						break;
					case 95:
						$SolicitudResiduo->SolResEmbalaje = "Garrafones/Jerricanes";
						break;
					case 94:
						$SolicitudResiduo->SolResEmbalaje = "Cajas";
						break;
					case 93:
						$SolicitudResiduo->SolResEmbalaje = "Cuñetes";
						break;
					case 92:
						$SolicitudResiduo->SolResEmbalaje = "Big Bags";
						break;
					case 91:
						$SolicitudResiduo->SolResEmbalaje = "Isotanques";
						break;
					case 90:
						$SolicitudResiduo->SolResEmbalaje = "Tachos";
						break;
					case 89:
						$SolicitudResiduo->SolResEmbalaje = "Embalajes Compuestos";
						break;
					case 88:
						$SolicitudResiduo->SolResEmbalaje = "Granel";
						break;
				}
				$SolicitudResiduo->SolResAlto = $request['SolResAlto'][$Generador][$y];
				$SolicitudResiduo->SolResAncho = $request['SolResAncho'][$Generador][$y];
				$SolicitudResiduo->SolResProfundo = $request['SolResProfundo'][$Generador][$y];
				$SolicitudResiduo->SolResFotoDescargue_Pesaje = $request['SolResFotoDescargue_Pesaje'][$Generador][$y];
				$SolicitudResiduo->SolResFotoTratamiento = $request['SolResFotoTratamiento'][$Generador][$y];
				$SolicitudResiduo->SolResVideoDescargue_Pesaje = $request['SolResVideoDescargue_Pesaje'][$Generador][$y];
				$SolicitudResiduo->SolResVideoTratamiento = $request['SolResVideoTratamiento'][$Generador][$y];
				$SolicitudResiduo->FK_SolResRg = ResiduosGener::select('ID_SGenerRes')->where('SlugSGenerRes',$request['FK_SolResRg'][$Generador][$y])->first()->ID_SGenerRes;
				$SolicitudResiduo->save();
			}
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$SolicitudServicio = DB::table('solicitud_servicios')
			->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
			->select('solicitud_servicios.*','personals.PersFirstName','personals.PersLastName', 'personals.PersEmail')
			->where('solicitud_servicios.SolSerSlug', $id)
			->first();
		$SolSerCollectAddress = $SolicitudServicio->SolSerCollectAddress;
		$SolSerConductor = $SolicitudServicio->SolSerConductor;
		if($SolicitudServicio->SolSerTipo == 'Interno'){
			$SolSerConductor = Personal::where('ID_Pers', $SolicitudServicio->SolSerConductor)->first();
		}
		if($SolicitudServicio->SolSerTypeCollect == 98){
			$Address = Sede::select('SedeAddress')->where('ID_Sede',$SolicitudServicio->SolSerCollectAddress)->first();
			$SolSerCollectAddress = $Address->SedeAddress;
		}
		$TextProgramacion = null;
		if($SolicitudServicio->SolSerStatus == 'Programado'){
			setlocale(LC_TIME, "Spanish_Colombia");
			$Programacion = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)->first();
			if(date('H', strtotime($Programacion->ProgVehSalida)) >= 12){
				$horas = " en las horas de la tarde";
			}
			else{
				$horas = " en las horas de la mañana";
			}
			$TextProgramacion = "El día ".strftime("%d", strtotime($Programacion->ProgVehFecha))." del mes de ".strftime("%B", strtotime($Programacion->ProgVehFecha)).$horas;
			$Programaciones = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)->where('ProgVehEntrada', null)->get();
			$ProgramacionesActivas = count($Programaciones);
		}
		$Cliente = DB::table('clientes')
			->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
			->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
			->select('clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName')
			->where('clientes.ID_Cli', $SolicitudServicio->FK_SolSerCliente)
			->first();
		$GenerResiduos = DB::table('solicitud_residuos')
			->distinct()
			->join('residuos_geners', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
			->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
			->join('generadors' , 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
			->select('gener_sedes.GSedeName', 'residuos_geners.FK_SGener', 'generadors.GenerShortname','gener_sedes.GSedeSlug')
			->where('solicitud_residuos.FK_SolResSolSer', $SolicitudServicio->ID_SolSer)
			->get();
		$Residuos = DB::table('solicitud_residuos')
			->join('residuos_geners', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
			->join('respels' , 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
			->select('solicitud_residuos.*','residuos_geners.FK_SGener', 'respels.RespelName','respels.RespelSlug')
			->where('solicitud_residuos.FK_SolResSolSer', $SolicitudServicio->ID_SolSer)
			->get();
		return view('solicitud-serv.show', compact('SolicitudServicio','Residuos', 'GenerResiduos', 'Cliente', 'SolSerCollectAddress', 'SolSerConductor', 'TextProgramacion', 'ProgramacionesActivas', 'Programacion'));
	}


	public function changestatus(Request $request)
	{
		$Solicitud = SolicitudServicio::where('SolSerSlug', $request->input('solserslug'))->first();
		if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol2 === trans('adminlte_lang::message.Cliente')){
			if($request->input('solserstatus') == 'No Deacuerdo'){
				$Solicitud->SolSerStatus = 'No Conciliado';
			}
			if($request->input('solserstatus') == 'Conciliada'){
				$Solicitud->SolSerStatus = 'Conciliado';
			}
		}
		if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente')){
			if($Solicitud->SolSerStatus <> 'Certificacion'){
				switch ($request->input('solserstatus')) {
					case 'Aprobada':
						if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2)){
							$Solicitud->SolSerStatus = 'Aprobado';
						}
						break;
					case 'Recibida':
						if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1)){
							$Solicitud->SolSerStatus = 'Completado';
						}
						break;
					case 'Conciliación':
						if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2)){
							$Solicitud->SolSerStatus = 'Completado';
						}
						break;
					case 'Tratada':
						if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1)){
							$Solicitud->SolSerStatus = 'Tratado';
						}
						break;
					case 'Certificada':
						if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2)){
							$Solicitud->SolSerStatus = 'Certificacion';
						}
						break;
				}
			}
		}
		$Solicitud->SolSerDescript = $request->input('solserdescript');
		$Solicitud->save();

		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="Modificado Status";
		$log->AuditRegistro=$Solicitud->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$Solicitud->SolSerStatus;
		$log->save();

		if($Solicitud->SolSerStatus === 'Aprobado' || $Solicitud->SolSerStatus === 'Completado'|| $Solicitud->SolSerStatus === 'Certificacion' || $Solicitud->SolSerStatus = 'No Conciliado' || $Solicitud->SolSerStatus === 'Conciliado'){
			$slug = $Solicitud->SolSerSlug;
			return redirect()->route('email', compact('slug'));
		}
		return redirect()->route('solicitud-servicio.show', ['id' => $Solicitud->SolSerSlug]);
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol2 === trans('adminlte_lang::message.Cliente')){
			$Solicitud = SolicitudServicio::where('SolSerSlug', $id)->first();
			if($Solicitud->SolSerStatus === 'Tratado' || $Solicitud->SolSerStatus === 'Certificacion' || $Solicitud->SolSerStatus === 'Completado'){
				abort(403);
			}
			$Municipio = Municipio::select('FK_MunCity')->where('MunName', $Solicitud->SolSerCityTrans)->first();
			$Departamento = Departamento::where('ID_Depart', $Municipio->FK_MunCity)->first();
			$Municipios = Municipio::where('FK_MunCity', $Departamento->ID_Depart)->get();
			$Departamentos = Departamento::all();
			$Cliente = Cliente::where('ID_Cli', $Solicitud->FK_SolSerCliente)->first();
			$Sedes = Sede::select('SedeSlug','SedeName', 'ID_Sede')->where('FK_SedeCli', $Cliente->ID_Cli)->get();
			$SGeneradors = DB::table('gener_sedes')
				->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
				->join('sedes', 'generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('gener_sedes.GSedeSlug', 'gener_sedes.GSedeName', 'generadors.GenerShortname')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->get();
			$Persona = Personal::where('ID_Pers', $Solicitud->FK_SolSerPersona)
				->select('PersSlug','PersFirstName','PersLastName')
				->first();
			$Personals = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('personals.PersSlug', 'personals.PersFirstName', 'personals.PersLastName')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->get();
			return view('solicitud-serv.edit', compact('Solicitud','Cliente','Persona','Personals','Departamentos','SGeneradors', 'Departamento','Municipios', 'Sedes'));
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
		// return $request;
		$SolicitudServicio = SolicitudServicio::where('SolSerSlug', $id)->first();

		if($SolicitudServicio->SolSerStatus === 'Programado'){
			if($request->input('SolSerTransportador') <> null){
				if($request->input('SolSerTransportador') <> 98){
					$cliente = DB::table('clientes')
						->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
						->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
						->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName')
						->where('ID_Cli', userController::IDClienteSegunUsuario())
						->first();
					$transportadorname = $cliente->CliName;
					$transportadornit = $cliente->CliNit;
					$transportadoradress = $cliente->SedeAddress;
					$transportadorcity = $cliente->MunName;
				}
				else{
					$municipio = Municipio::select('MunName')->where('ID_Mun', $request->input('SolSerCityTrans'))->first();
					$transportadorname = $request->input('SolSerNameTrans');
					$transportadornit = $request->input('SolSerNitTrans');
					$transportadoradress = $request->input('SolSerAdressTrans');
					$transportadorcity = $municipio->MunName;
				}
				$SolicitudServicio->SolSerTipo = "Externo";
				$SolicitudServicio->SolSerNameTrans = $transportadorname;
				$SolicitudServicio->SolSerNitTrans = $transportadornit;
				$SolicitudServicio->SolSerAdressTrans = $transportadoradress;
				$SolicitudServicio->SolSerCityTrans = $transportadorcity;
				$SolicitudServicio->SolSerConductor =  $request->input('SolSerConductor');
				$SolicitudServicio->SolSerVehiculo = $request->input('SolSerVehiculo');
			}
			$SolicitudServicio->FK_SolSerPersona = Personal::select('ID_Pers')->where('PersSlug',$request->input('FK_SolSerPersona'))->first()->ID_Pers;
			$SolicitudServicio->save();

			$log = new audit();
			$log->AuditTabla="solicitud_servicios";
			$log->AuditType="Modificado";
			$log->AuditRegistro=$SolicitudServicio->ID_SolSer;
			$log->AuditUser=Auth::user()->email;
			$log->Auditlog=json_encode($request->all());
			$log->save();

			return redirect()->route('solicitud-servicio.show', ['id' => $SolicitudServicio->SolSerSlug]);
		}
		switch ($request->input('SolResAuditoriaTipo')) {
			case 99:
				$SolicitudServicio->SolSerAuditable = 1;
				$SolicitudServicio->SolResAuditoriaTipo = "Virtual";
				break;
			case 98:
				$SolicitudServicio->SolSerAuditable = 1;
				$SolicitudServicio->SolResAuditoriaTipo = "Presencial";
				break;
			case 97:
				$SolicitudServicio->SolSerAuditable = 0;
				$SolicitudServicio->SolResAuditoriaTipo = "No Auditable";
				break;
		}
		$collect = null;
		if($request->input('SolSerTipo') == 99){
			$cliente = DB::table('clientes')
				->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
				->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
				->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName')
				->where('ID_Cli', 1)
				->first();
			$tipo = "Interno";
			$transportadorname = $cliente->CliName;
			$transportadornit = $cliente->CliNit;
			$transportadoradress = $cliente->SedeAddress;
			$transportadorcity = $cliente->MunName;
			$conductor = null;
			$vehiculo = null;
			$collect = $request->input('SolSerTypeCollect');
		}
		else{
			if($request->input('SolSerTransportador') <> 98){
				$cliente = DB::table('clientes')
					->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
					->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
					->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName')
					->where('ID_Cli', userController::IDClienteSegunUsuario())
					->first();
				$transportadorname = $cliente->CliName;
				$transportadornit = $cliente->CliNit;
				$transportadoradress = $cliente->SedeAddress;
				$transportadorcity = $cliente->MunName;
			}
			else{
				$municipio = Municipio::select('MunName')->where('ID_Mun', $request->input('SolSerCityTrans'))->first();
				$transportadorname = $request->input('SolSerNameTrans');
				$transportadornit = $request->input('SolSerNitTrans');
				$transportadoradress = $request->input('SolSerAdressTrans');
				$transportadorcity = $municipio->MunName;
			}
			$tipo = "Externo";
			$conductor = $request->input('SolSerConductor');
			$vehiculo = $request->input('SolSerVehiculo');
		}
		$direccioncollect = null;
		switch ($request->input('SolSerTypeCollect')) {
			case 99:
				$direccioncollect = "Recolección en la sede de cada generador";
				break;
			case 98:
				$sede = Sede::select('ID_Sede')->where('SedeSlug', $request->input('SedeCollect'))->first();
				$direccioncollect = $sede->ID_Sede;
				break;
			case 97:
				$direccioncollect = $request->input('AddressCollect');
				break;
		}
		$SolicitudServicio->SolSerTipo = $tipo;
		$SolicitudServicio->SolSerNameTrans = $transportadorname;
		$SolicitudServicio->SolSerNitTrans = $transportadornit;
		$SolicitudServicio->SolSerAdressTrans = $transportadoradress;
		$SolicitudServicio->SolSerCityTrans = $transportadorcity;
		$SolicitudServicio->SolSerConductor = $conductor;
		$SolicitudServicio->SolSerVehiculo = $vehiculo;
		$SolicitudServicio->SolSerTypeCollect = $collect;
		$SolicitudServicio->SolSerCollectAddress = $direccioncollect;
		if($request->input('SolSerBascula')){
			$SolicitudServicio->SolSerBascula = 1;
		}
		else{
			$SolicitudServicio->SolSerBascula = null;
		}
		if($request->input('SolSerCapacitacion')){
			$SolicitudServicio->SolSerCapacitacion = 1;
		}
		else{
			$SolicitudServicio->SolSerCapacitacion = null;
		}
		if($request->input('SolSerMasPerson')){
			$SolicitudServicio->SolSerMasPerson = 1;
		}
		else{
			$SolicitudServicio->SolSerMasPerson = null;
		}
		if($request->input('SolSerVehicExclusive')){
			$SolicitudServicio->SolSerVehicExclusive = 1;
		}
		else{
			$SolicitudServicio->SolSerVehicExclusive = null;
		}
		if($request->input('SolSerPlatform')){
			$SolicitudServicio->SolSerPlatform = 1;
		}
		else{
			$SolicitudServicio->SolSerPlatform = null;
		}
		if($request->input('SolSerDevolucion')){
			$SolicitudServicio->SolSerDevolucion = 1;
			$SolicitudServicio->SolSerDevolucionTipo = $request->input('SolSerDevolucionTipo');
		}
		else{
			$SolicitudServicio->SolSerDevolucion = null;
			$SolicitudServicio->SolSerDevolucionTipo = null;
		}
		$SolicitudServicio->FK_SolSerPersona = Personal::select('ID_Pers')->where('PersSlug',$request->input('FK_SolSerPersona'))->first()->ID_Pers;
		$SolicitudServicio->FK_SolSerCliente = userController::IDClienteSegunUsuario();
		$SolicitudServicio->save();

		if(!is_null($request->input('SGenerador'))){
			$this->createSolRes($request, $SolicitudServicio->ID_SolSer);
		}

		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="Modificado";
		$log->AuditRegistro=$SolicitudServicio->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=json_encode($request->all());
		$log->save();

		return redirect()->route('solicitud-servicio.show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$SolicitudServicio = SolicitudServicio::where('SolSerSlug', $id)->first();
		SolicitudServicio::destroy($SolicitudServicio->ID_SolSer);

		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="Eliminado";
		$log->AuditRegistro=$SolicitudServicio->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$SolicitudServicio->SolSerDelete;
		$log->save();
		$SolicitudServicio->save();

		return redirect()->route('solicitud-servicio.index');
	}
}
