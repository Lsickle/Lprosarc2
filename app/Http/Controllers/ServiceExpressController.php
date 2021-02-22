<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SolServStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use App\Http\Controllers\userController;
use App\Http\Controllers\SolicitudResiduoController;
use App\Mail\NewSolServEmail;
use App\Mail\SolSerLeftRespel;
use App\Mail\NewSolServProsarcEmail;
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
use App\Tarifa;
use App\Rango;
use App\Certificado;
use App\Certdato;
use App\Manifiesto;
use App\Manifdato;
use App\Requerimiento;
use App\Documento;
use App\Docdato;
use App\ProgramacionVehiculo;
use App\RequerimientosCliente;
use App\Observacion;
use Permisos;

class ServiceExpressController extends Controller
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
			->join('personals as Comercial', 'Comercial.ID_Pers', '=', 'clientes.CliComercial')
			->select('solicitud_servicios.ID_SolSer',
			'solicitud_servicios.SolSerStatus',
			'solicitud_servicios.SolSerTipo',
			'solicitud_servicios.SolSerAuditable',
			'solicitud_servicios.SolSerConductor',
			'solicitud_servicios.SolSerVehiculo',
			'solicitud_servicios.SolSerSlug',
			'solicitud_servicios.created_at',
			'solicitud_servicios.updated_at',
			'solicitud_servicios.SolSerDelete',
			'solicitud_servicios.SolResAuditoriaTipo',
			'solicitud_servicios.SolSerNameTrans',
			'solicitud_servicios.SolSerNitTrans',
			'solicitud_servicios.SolSerAdressTrans',
			'solicitud_servicios.SolSerTypeCollect',
			'solicitud_servicios.SolSerCollectAddress',
			'solicitud_servicios.SolServCertStatus',
			'clientes.CliName',
			'clientes.CliSlug',
			'clientes.CliStatus',
			'clientes.TipoFacturacion',
			'clientes.CliCategoria',
			'personals.PersFirstName',
			'personals.PersLastName',
			'personals.PersSlug',
			'personals.PersEmail',
			'personals.PersCellphone',
			'Comercial.ID_Pers as ComercialID_Pers',
			'Comercial.PersFirstName as ComercialPersFirstName',
			'Comercial.PersLastName as ComercialPersLastName',
			'Comercial.PersSlug as ComercialPersSlug',
			'Comercial.PersEmail as ComercialPersEmail',
			'Comercial.PersCellphone as ComercialPersCellphone')
			->where(function($query){
				if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
					$query->where('ID_Cli',userController::IDClienteSegunUsuario());
				}
				if(in_array(Auth::user()->UsRol, Permisos::SOLSERACEPTADO) || in_array(Auth::user()->UsRol2, Permisos::SOLSERACEPTADO)){
					if(!in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
						$query->where('solicitud_servicios.SolSerStatus', 'Pendiente');
						$query->orWhere('solicitud_servicios.SolServCertStatus', 1);
					}
				}
				if(in_array(Auth::user()->UsRol, Permisos::COMERCIALES) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALES)){
					if(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)){
						$query->where('Comercial.ID_Pers', Auth::user()->FK_UserPers);
					}
				}
			})
			->where('CliCategoria', 'ClientePrepago')
			->orderBy('created_at', 'desc')
			->get();
		$Cliente = Cliente::select('CliName','ID_Cli', 'CliStatus')->where('ID_Cli',userController::IDClienteSegunUsuario())->first();
		foreach ($Servicios as $servicio) {
			if($servicio->SolSerTypeCollect == 98){
				$Address = Sede::select('SedeAddress')->where('ID_Sede',$servicio->SolSerCollectAddress)->first();
				$servicio->SolSerCollectAddress = $Address->SedeAddress;
			}

			/* validacion para encontrar la fecha de recepción en planta del servicio */
			$fechaRecepcion = SolicitudServicio::find($servicio->ID_SolSer)->programacionesrecibidas()->first();
			if($fechaRecepcion){
				$servicio->recepcion = $fechaRecepcion->ProgVehSalida;
			}else{
				$servicio->recepcion = null;
			}
		}
		if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
			return view('serviciosexpress.index', compact('Servicios', 'Residuos', 'Cliente'));
		}else{
			return view('serviciosexpress.indexprosarc', compact('Servicios', 'Residuos', 'Cliente'));
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(in_array(Auth::user()->UsRol, Permisos::EXPRESS) || in_array(Auth::user()->UsRol, Permisos::EXPRESS)){			

			$Clientes = Cliente::with('sedes')->where('CliCategoria', 'ClientePrepago')->orderBy('created_at', 'desc')->get();

			return view('serviciosexpress.create', compact('Clientes'));
		}
		else{
			abort(403, 'Solo los Roles autorizados pueden realizar nuevas solicitudes de servicio Express');
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
		// return $request;

		$Cliente = Cliente::where('CliSlug', $request->input('FK_SolSerCliente'))->first();

		$Persona = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('personals.*')
				->where('clientes.ID_Cli', $Cliente->ID_Cli)
				->where('personals.PersDelete', 0)
				->first();


		for ($i=0; $i < $request->input('SolServCantidad'); $i++) { 
			$SolicitudServicio = new SolicitudServicio();
			$SolicitudServicio->SolSerStatus = 'Aprobado';
			$SolicitudServicio->SolSerAuditable = 0;
			$SolicitudServicio->SolResAuditoriaTipo = "No Auditable";
			$SolicitudServicio->SolSerDescript = $request->input('SolServCantidad');
			// $SolicitudServicio->SolServMailCopia = json_encode($request->input('SolServMailCopia'));
			if(isset($request['SupportPay'])){
				$fileSupport = $request['SupportPay'];
				$nameSupport = hash('sha256', rand().time().$fileSupport->getClientOriginalName()).'.pdf';
				$fileSupport->move(public_path().'\img\SupportPay/',$nameSupport);
				$SolicitudServicio->SolSerSupport = $nameSupport;
			}
			$SolicitudServicio->SolSerTipo = "Interno";
			$SolicitudServicio->SolSerNameTrans = 'Prosarc S.A. ESP.';
			$SolicitudServicio->SolSerNitTrans = '900.079.188-0';
			$SolicitudServicio->SolSerAdressTrans = 'KM 6 VÍA LA MESA SUB ESTACIÓN BALSILLAS';
			$SolicitudServicio->SolSerCityTrans = 584;
			$SolicitudServicio->SolSerConductor = null;
			$SolicitudServicio->SolSerVehiculo = null;
			$SolicitudServicio->SolSerDescript = 'Frecuencia:'.$request->input('SolServFrecuencia').'  '.$request->input('SolSerDescript');
			$SolicitudServicio->SolSerTypeCollect = 99;
			$SolicitudServicio->SolSerCollectAddress = "Recolección Express en la sede de cada generador";
			$SolicitudServicio->SolSerBascula = 0;
			$SolicitudServicio->SolSerCapacitacion = 0;
			$SolicitudServicio->SolSerMasPerson = 0;
			$SolicitudServicio->SolSerVehicExclusive = 0;
			$SolicitudServicio->SolSerPlatform = 0;
			$SolicitudServicio->SolSerDevolucion = 0;
			$SolicitudServicio->SolSerDevolucionTipo = null;
			$SolicitudServicio->SolSerSlug = hash('sha256', rand().time().$SolicitudServicio->SolSerNameTrans);
			$SolicitudServicio->SolSerDelete = 0;

			$SolicitudServicio->FK_SolSerPersona = $Persona->ID_Pers;
			$SolicitudServicio->FK_SolSerCliente = $Cliente->ID_Cli;
			$SolicitudServicio->save();
			$this->createSolRes($request, $SolicitudServicio->ID_SolSer);

			/*se guarda la observacion inicial de la creación del servicio*/
			$Observacion = new Observacion();
			$Observacion->ObsStatus = $SolicitudServicio->SolSerStatus;
			$Observacion->ObsMensaje = $SolicitudServicio->SolSerDescript;
			$Observacion->ObsTipo = 'prosarc';
			$Observacion->ObsRepeat = 1;
			$Observacion->ObsDate = now();
			$Observacion->ObsUser = Auth::user()->email;
			$Observacion->ObsRol = Auth::user()->UsRol;
			$Observacion->FK_ObsSolSer = $SolicitudServicio->ID_SolSer;
			$Observacion->save();
			
		}
		// se establece la lista de destinatarios
		if ($Cliente->CliComercial <> null) {
			$comercial = Personal::where('ID_Pers', $Cliente->CliComercial)->first();
			$destinatarios = ['logistica@prosarc.com.co',
								'asistentelogistica@prosarc.com.co',
								'gerenteplanta@prosarc.com.co',
								'subgerencia@prosarc.com.co',
								'recepcionpda@prosarc.com.co',
								$comercial->PersEmail
							];
		}else{
			$comercial = "";
			$destinatarios = ['logistica@prosarc.com.co',
								'asistentelogistica@prosarc.com.co',
								'gerenteplanta@prosarc.com.co',
								'subgerencia@prosarc.com.co',
								'recepcionpda@prosarc.com.co'
							];	
		}
		$SolicitudServicio['comercial'] = $comercial;
		$SolicitudServicio['personalcliente'] = Personal::where('ID_Pers', $SolicitudServicio->FK_SolSerPersona)->first();
		// se envia un correo por cada residuo registrado
		Mail::to($destinatarios)->send(new NewSolServEmail($SolicitudServicio));
		return redirect()->route('serviciosexpress.show', ['id' => $SolicitudServicio->SolSerSlug]);
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
		if (!$SolicitudServicio) {
			abort(404);
		}

		$Observaciones = Observacion::where('FK_ObsSolSer', $SolicitudServicio->ID_SolSer)->orderBy('ObsDate', 'desc')->get();

		if($SolicitudServicio->SolSerStatus == 'Completado'||$SolicitudServicio->SolSerStatus == 'Corregido'){
			$ultimoRecordatorio = Observacion::where('FK_ObsSolSer', $SolicitudServicio->ID_SolSer)
								->where('ObsStatus', 'Recordatorio+')
								->orderBy('ObsDate', 'desc')
								->first();
			if(!$ultimoRecordatorio){
				$ultimoRecordatorio = Observacion::where('FK_ObsSolSer', $SolicitudServicio->ID_SolSer)
								->where('ObsStatus', 'Completado')
								->orderBy('ObsDate', 'asc')
								->first();
				if(!$ultimoRecordatorio){
					$ultimoRecordatorio = collect();
					$ultimoRecordatorio->ObsDate = $SolicitudServicio->updated_at;
				}
				$ultimoRecordatorio->ObsRepeat = 0;
			}
		}

		
		$SolSerCollectAddress = $SolicitudServicio->SolSerCollectAddress;
		$SolSerConductor = $SolicitudServicio->SolSerConductor;
		if($SolicitudServicio->SolSerTipo == 'Interno'){
			$SolSerConductor = Personal::where('ID_Pers', $SolicitudServicio->SolSerConductor)->first();
		}
		if($SolicitudServicio->SolSerTypeCollect == 98){
			$Address = Sede::select('SedeAddress')->where('ID_Sede',$SolicitudServicio->SolSerCollectAddress)->first();
			$SolSerCollectAddress = $Address->SedeAddress;
		}
		if($SolicitudServicio->SolSerCityTrans <> null){
			$Municipio1 = DB::table('municipios')
				->select('MunName')
				->where('ID_Mun', $SolicitudServicio->SolSerCityTrans)
				->first();
			$Municipio = $Municipio1->MunName;
		}
		if($SolicitudServicio->FK_SolSerCollectMun <> null){
			$Municipio2 = DB::table('municipios')
				->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
				->select('municipios.MunName', 'departamentos.DepartName')
				->where('municipios.ID_Mun', $SolicitudServicio->FK_SolSerCollectMun)
				->first();
			$SolSerCollectAddress = $SolSerCollectAddress." (".$Municipio2->MunName." - ".$Municipio2->DepartName.")";
		}
		$TextProgramacion = null;
		switch ($SolicitudServicio->SolSerStatus) {
			case 'Notificado':
			case 'Programado':
				setlocale(LC_ALL, "es_CO.UTF-8");
				$Programacion = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)->where('ProgVehDelete', 0)->first();
				if(date('H', strtotime($Programacion->ProgVehSalida)) >= 12){
					$horas = " en las horas de la tarde";
				}
				else{
					$horas = " en las horas de la mañana";
				}
				$TextProgramacion = "El día ".strftime("%d", strtotime($Programacion->ProgVehFecha))." del mes de ".strftime("%B", strtotime($Programacion->ProgVehFecha)).$horas;
				$Programaciones = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)
				->where('ProgVehDelete', 0)
				->get();
				$ProgramacionesActivas = count(ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)
				->where('ProgVehEntrada', null)
				->where('ProgVehDelete', 0)
				->get());
				// $ProgramacionesActivas = ($Programaciones);
				break;

			case 'Residuo Faltante':
				setlocale(LC_ALL, "es_CO.UTF-8");
				$Programacion = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)->where('ProgVehDelete', 0)->first();
				if(date('H', strtotime($Programacion->ProgVehSalida)) >= 12){
					$horas = " en las horas de la tarde";
				}
				else{
					$horas = " en las horas de la mañana";
				}
				$TextProgramacion = "";
				$Programaciones = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)
				->where('ProgVehDelete', 0)
				->get();
				$ProgramacionesActivas = count(ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)
				->where('ProgVehEntrada', null)
				->where('ProgVehDelete', 0)
				->get());
				// $ProgramacionesActivas = ($Programaciones);
				break;

			default:
				$Programaciones = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)
				// ->where('ProgVehEntrada', null)
				->where('ProgVehDelete', 0)
				->get();
				break;
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
			->select('gener_sedes.GSedeName', 'residuos_geners.FK_SGener', 'generadors.GenerName','gener_sedes.GSedeSlug', 'gener_sedes.GSedeAddress')
			->where('solicitud_residuos.FK_SolResSolSer', $SolicitudServicio->ID_SolSer)
			->get();
		// $Residuos = DB::table('solicitud_residuos')
		// 	->join('residuos_geners', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
		// 	->join('respels' , 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
		// 	->select('solicitud_residuos.*','residuos_geners.FK_SGener', 'respels.RespelName','respels.RespelSlug', 'respels.RespelStatus')
		// 	->where('solicitud_residuos.FK_SolResSolSer', $SolicitudServicio->ID_SolSer)
		// 	->get();
		$Residuosoriginal = DB::table('solicitud_residuos')
			->join('residuos_geners', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
			->join('respels' , 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
			->join('requerimientos' , 'solicitud_residuos.FK_SolResRequerimiento', '=', 'requerimientos.ID_Req')
			->join('tratamientos' , 'requerimientos.FK_ReqTrata', '=', 'tratamientos.ID_Trat')
			->join('sedes' , 'tratamientos.FK_TratProv', '=', 'sedes.ID_Sede')
			->join('clientes' , 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('solicitud_residuos.*','residuos_geners.FK_SGener', 'respels.*', 'requerimientos.ID_Req', 'tratamientos.TratName', 'tratamientos.ID_Trat', 'clientes.CliShortName')
			->where('solicitud_residuos.FK_SolResSolSer', $SolicitudServicio->ID_SolSer)
			// ->where('requerimientos.ofertado', 1)
	        // ->where('forevaluation', 0)
			->get();
		
		$Residuos = $Residuosoriginal->map(function ($item) {
		  $requerimientos = Requerimiento::with(['pretratamientosSelected'])
	        ->where('ID_Req', $item->FK_SolResRequerimiento)
	        // ->where('forevaluation', 0)
			->first();
			
			$rm = SolicitudResiduo::where('SolResSlug', $item->SolResSlug)->first('SolResRM');
	        
	        $item->pretratamientosSelected = $requerimientos->pretratamientosSelected;
	        $item->SolResRM2 = $rm->SolResRM;
		  	return $item;
		});
		
		$SolicitudServicio->Repetible = 0;

		/* se convierte el tipo de dato a aray mediante la consulta en el modelo de la columna SolSerRMs usando eloquent*/
		$rms = SolicitudServicio::where('SolSerSlug', $SolicitudServicio->SolSerSlug)->first('SolSerRMs');
		$SolicitudServicio->SolSerRMs = $rms->SolSerRMs;

		// return $Residuos;

		foreach ($Residuos as $residuo => $value) {
			$requerimientos = Requerimiento::with(['pretratamientosSelected'])
	        ->where('ID_Req', $value->FK_SolResRequerimiento)
	        ->first();
			$residuoSinTratamiento = Requerimiento::where('FK_ReqRespel', $requerimientos->FK_ReqRespel)
			->where('ofertado', 1)
			->where('forevaluation', 1)
	        ->first();


			if ($residuoSinTratamiento == null) {
				$SolicitudServicio->Repetible++;
			}
		}

		$SolicitudesServicioscount = SolicitudServicio::with(['Personal', 'cliente', 'municipio', 'SolicitudResiduo'])
			->where('ID_SolSer', $SolicitudServicio->ID_SolSer)
			->orderBy('created_at', 'desc')
			->get();
		
		/*se inicializan las variables para el calculo de totales */
		$total['estimado'] = 0;		
		$total['recibido'] = 0;		
		$total['conciliado'] = 0;		
		$total['tratado'] = 0;		
		$cantidadesXtratamiento = [];
		

		/* se itera sobre todos los residuos de las solicitudes de servicio */
		foreach ($SolicitudesServicioscount as $servicio) {
			foreach ($servicio->SolicitudResiduo as $residuo) {
				$collection = collect($cantidadesXtratamiento);

				/* si el tratamiento existe en la lista se suman las cantidadesxtratamiento y los totales correspondientes */
				if ($collection->has($residuo->requerimiento->tratamiento->TratName)) {
					$cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['estimado'] = $cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['estimado'] + $residuo->SolResKgEnviado;
					$cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['recibido'] = $cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['recibido'] + $residuo->SolResKgRecibido;
					$cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['conciliado'] = $cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['conciliado'] + $residuo->SolResKgConciliado;
					$cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['tratado'] = $cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['tratado'] + $residuo->SolResKgTratado;
					$total['estimado'] = $total['estimado'] + $residuo->SolResKgEnviado;
					$total['recibido'] = $total['recibido'] + $residuo->SolResKgRecibido;
					$total['conciliado'] = $total['conciliado'] + $residuo->SolResKgConciliado;
					$total['tratado'] = $total['tratado'] + $residuo->SolResKgTratado;
				}else{
					$cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['estimado'] = $residuo->SolResKgEnviado;
					$cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['recibido'] = $residuo->SolResKgRecibido;
					$cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['conciliado'] = $residuo->SolResKgConciliado;
					$cantidadesXtratamiento[$residuo->requerimiento->tratamiento->TratName]['tratado'] = $residuo->SolResKgTratado;
					$total['estimado'] = $total['estimado'] + $residuo->SolResKgEnviado;
					$total['recibido'] = $total['recibido'] + $residuo->SolResKgRecibido;
					$total['conciliado'] = $total['conciliado'] + $residuo->SolResKgConciliado;
					$total['tratado'] = $total['tratado'] + $residuo->SolResKgTratado;
				}
			}
		}
		if (in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol, Permisos::SolSer1)) {
			$tratamientos = Tratamiento::where('FK_TratProv', 1)->get();
		}else{
			$tratamientos = 'NoAutorizado';
		}

		/* validacion para encontrar la fecha de recepción en planta del servicio */
		$fechaRecepcion = SolicitudServicio::find($servicio->ID_SolSer)->programacionesrecibidas()->first();
		if($fechaRecepcion){
			$SolicitudServicio->recepcion = $fechaRecepcion->ProgVehSalida;
		}else{
			$SolicitudServicio->recepcion = null;
		}
		
		return view('serviciosexpress.show', compact('SolicitudServicio','Residuos', 'GenerResiduos', 'Cliente', 'SolSerCollectAddress', 'SolSerConductor', 'TextProgramacion', 'ProgramacionesActivas', 'Programacion','Municipio', 'Programaciones', 'total', 'cantidadesXtratamiento', 'tratamientos', 'Observaciones', 'ultimoRecordatorio'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
				if ((isset($request['SolResTypeUnidad'][$Generador][$y]))){
					if($request['SolResTypeUnidad'][$Generador][$y] == 99){
						$SolicitudResiduo->SolResTypeUnidad = "Unidad";
					}
					else if($request['SolResTypeUnidad'][$Generador][$y] == 98){
						$SolicitudResiduo->SolResTypeUnidad = "Litros";
					}
					if (isset($request['SolResCantiUnidad'][$Generador][$y])&&$request['SolResCantiUnidad'][$Generador][$y] != null) {
						$SolicitudResiduo->SolResCantiUnidad = $request['SolResCantiUnidad'][$Generador][$y];
						$SolicitudResiduo->SolResCantiUnidadConciliada = 0;
						$SolicitudResiduo->SolResCantiUnidadRecibida = 0;
					}else {
						$SolicitudResiduo->SolResCantiUnidad = 0;
						$SolicitudResiduo->SolResCantiUnidadConciliada = 0;
						$SolicitudResiduo->SolResCantiUnidadRecibida = 0;
					}
				}
				
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
					case 87:
						$SolicitudResiduo->SolResEmbalaje = "Canecas 55 gal.";
						break;
					case 86:
						$SolicitudResiduo->SolResEmbalaje = "Canecas 05 gal.";
						break;
				}

				$SolicitudResiduo->FK_SolResRg = ResiduosGener::select('ID_SGenerRes')->where('SlugSGenerRes',$request['FK_SolResRg'][$Generador][$y])->first()->ID_SGenerRes;
				/*validar el residuo para saber el tratamiento*/
				$respelref = ResiduosGener::select('FK_Respel')->where('SlugSGenerRes',$request['FK_SolResRg'][$Generador][$y])->first()->FK_Respel;
				/*asignar el requerimiento segun el tratamiento ofertado actualmente*/
				// $SolicitudResiduo->FK_SolResRequerimiento = Requerimiento::select('ID_Req')
				// ->where('FK_ReqRespel', $respelref)
				// ->where('ofertado', 1)
				// ->first()->ID_Req;
				// $SolicitudResiduo->save();
				$requerimientoparacopiar = Requerimiento::with(['pretratamientosSelected'])
				->where('FK_ReqRespel', $respelref)
				->where('ofertado', 1)
				->where('forevaluation', 1)
				->first();
				$nuevorequerimiento = $requerimientoparacopiar->replicate();
                $nuevorequerimiento->ReqSlug= hash('md5', rand().time().$respelref);
                $nuevorequerimiento->forevaluation=0;
                $nuevorequerimiento->ofertado=0;
                $nuevorequerimiento->save();
                $nuevorequerimiento->pretratamientosSelected()->attach($requerimientoparacopiar['pretratamientosSelected']);

                $tarifaparacopiar = Tarifa::with(['rangos'])
                ->where('FK_TarifaReq', $requerimientoparacopiar->ID_Req)->first();
                $nuevatarifa = $tarifaparacopiar->replicate();
                $nuevatarifa->FK_TarifaReq=$nuevorequerimiento->ID_Req;
                $nuevatarifa->save();

                foreach ($tarifaparacopiar->rangos as $rango) {
                	$rangoparacopiar = Rango::find($rango->ID_Rango);
                	$nuevarango = $rangoparacopiar->replicate();
                	$nuevarango->FK_RangoTarifa = $nuevatarifa->ID_Tarifa;
                	$nuevarango->save();
                }

                
                $SolicitudResiduo->FK_SolResRequerimiento = $nuevorequerimiento->ID_Req;
                $SolicitudResiduo->save();
			}
		}
	}
}
