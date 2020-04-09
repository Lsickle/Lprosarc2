<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use App\audit;
use App\ProgramacionVehiculo;
use App\Vehiculo;
use App\Personal;
use App\SolicitudServicio;
use App\GenerSede;
use App\SolicitudResiduo;
use App\Documento;
use App\Docdato;
use App\Recolect;
use App\Sede;
use App\Requerimiento;
use Permisos;

class VehicProgController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC)){
			$programacions = DB::table('progvehiculos')
				->join('solicitud_servicios', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
				->join('clientes', 'solicitud_servicios.FK_SolSerCliente', 'clientes.ID_Cli')
				->select('progvehiculos.*', 'solicitud_servicios.ID_SolSer', 'solicitud_servicios.SolSerSlug', 'solicitud_servicios.SolSerVehiculo', 'solicitud_servicios.SolSerConductor', 'clientes.CliName')
				->where(function($query){
					if(!in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
						$query->where('progvehiculos.ProgVehDelete', 0);
					}
					if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOR)||in_array(Auth::user()->UsRol2, Permisos::CONDUCTOR)){
						$query->where('progvehiculos.FK_ProgConductor', Auth::user()->FK_UserPers);
						$query->where('progvehiculos.ProgVehStatus', 'Autorizado');
					}
					if(in_array(Auth::user()->UsRol, Permisos::TESORERIA)||in_array(Auth::user()->UsRol2, Permisos::TESORERIA)){
						$query->where('progvehiculos.ProgVehStatus', 'Pendiente');
					}
				})
				->get();
			$personals = DB::table('personals')
				->select('ID_Pers', 'PersFirstName', 'PersLastName')
				->get();
			$vehiculos = DB::table('vehiculos')
				->select('ID_Vehic','VehicPlaca')
				->get();

			$programacions = $programacions->map(function ($item) {
			  	$programacion = ProgramacionVehiculo::with(['puntosderecoleccion.generadors'])
			        ->where('ID_ProgVeh', $item->ID_ProgVeh)
			        // ->where('forevaluation', 0)
			        ->first();
		        
		        $item->puntosderecoleccion =  $programacion->puntosderecoleccion;
			  	return $item;
			});
			// return $programacions;
			return view('ProgramacionVehicle.index', compact('programacions', 'personals', 'vehiculos'));
		}
		 /*Validacion para usuarios no permitidos en esta vista*/
		else{
			abort(403);
		}
			// return $programacions;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) || in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC)){
			$programacions = DB::table('progvehiculos')
				->join('solicitud_servicios', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
				->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
				->select('progvehiculos.*', 'solicitud_servicios.ID_SolSer', 'clientes.CliName')
				->where('progvehiculos.ProgVehDelete', 0)
				->get();
			$transportadores = DB::table('clientes')
				->select('CliName', 'CliSlug')
				->where('CliCategoria', 'Transportador')
				->where('CliDelete', 0)
				->get();
			$mantenimientos = DB::table('mantenvehics')
				->join('vehiculos', 'mantenvehics.FK_VehMan', '=', 'vehiculos.ID_Vehic')
				->select('mantenvehics.*','vehiculos.VehicPlaca')
				->where('mantenvehics.HoraMavFin', '>', now())
				->get();
			/*conductores de prosarc*/
			$conductors = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('ID_Pers', 'PersFirstName', 'PersLastName')
				->where('CargName', 'Conductor')
				->where('ID_Cli', 1)
				->where('PersDelete', '!=' , 1)
				->get();
			/*auxiliares de prosarc*/
			$ayudantes = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('ID_Pers', 'PersFirstName', 'PersLastName')
				->where('CargName', 'Operario')
				->where('ID_Cli', 1)
				->where('PersDelete', '!=' , 1)
				->get();
			$vehiculos = DB::table('vehiculos')
				->select('ID_Vehic','VehicPlaca')
				->where('vehiculos.FK_VehiSede', 1)
				->where('VehicDelete', 0)
				->get();
			$serviciosnoprogramados = DB::table('solicitud_servicios')
				->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
				->select('solicitud_servicios.ID_SolSer', 'solicitud_servicios.SolSerSlug', 'solicitud_servicios.SolSerTipo', 'clientes.CliName')
				->where('SolSerDelete', 0)
				->where('SolSerStatus', 'Aprobado')
				->orderBy('solicitud_servicios.updated_at', 'asc')
				->get();
				/*return $programacions;*/
			return view('ProgramacionVehicle.create', compact('programacions', 'conductors', 'ayudantes', 'vehiculos', 'serviciosnoprogramados', 'mantenimientos', 'transportadores'));
		}
		 /*Validacion para usuarios no permitidos en esta vista*/
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
		$validate = $request->validate([
			'ProgVehPrecintos'   =>   'max:6|min:6'
		]);
		/*return $request;*/
		$programacion = new ProgramacionVehiculo();
		if(date('H', strtotime($request->input('ProgVehSalida'))) >= 12){
			$turno = "0";
		}
		else{
			$turno = "1";
		}
		$programacion->ProgVehTurno = $turno;
		$programacion->ProgVehFecha = $request->input('ProgVehFecha');
		$programacion->ProgVehSalida = $request->input('ProgVehFecha').' '.date('H:i:s', strtotime($request->input('ProgVehSalida')));


		/*typetransportador = 0 -> transporte prosarc*/
		/*typetransportador = 1 -> transporte alquilado*/
		if(!is_null($request->input('typetransportador'))){
			if($request->input('typetransportador') == 0){
				/*ProgVehtipo = 0 -> transporte externo*/
				/*ProgVehtipo = 1 -> transporte interno prosarc*/
				/*ProgVehtipo = 2 -> transporte alquilado*/

				$programacion->ProgVehtipo = 1;
				$programacion->FK_ProgVehiculo = $request->input('FK_ProgVehiculo');
				$programacion->ProgVehColor = $request->input('ProgVehColor');
				
				$programacion->ProgVehPrecintos = $request->input('ProgVehPrecintos');

				$programacion->FK_ProgConductor = $request->input('FK_ProgConductor');
				$programacion->FK_ProgAyudante = $request->input('FK_ProgAyudante');
				$conductor = Personal::select('PersFirstName', 'PersLastName')->where('ID_Pers', $request->input('FK_ProgConductor'))->first();
				$nomConduct = $conductor->PersFirstName." ".$conductor->PersLastName;
				$vehiculo = Vehiculo::select('VehicPlaca')->where('ID_Vehic', $request->input('FK_ProgVehiculo'))->first()->VehicPlaca;
				$transportador = DB::table('clientes')
					->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
					->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
					->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName', 'municipios.ID_Mun')
					->where('ID_Cli', 1)
					->first();
			}
			else{
				$programacion->ProgVehtipo = 2;
				$programacion->FK_ProgVehiculo = $request->input('vehicalqui');
				$programacion->FK_ProgAyudante = $request->input('FK_ProgAyudante');
				$programacion->ProgVehDocConductorEXT = $request->input('ProgVehDocConductorEXT');
				$programacion->ProgVehNameConductorEXT = $request->input('ProgVehNameConductorEXT');
				$programacion->ProgVehDocAuxiliarEXT = $request->input('ProgVehDocAuxiliarEXT');
				$programacion->ProgVehNameAuxiliarEXT = $request->input('ProgVehNameAuxiliarEXT');
				$programacion->ProgVehPlacaEXT = $request->input('ProgVehPlacaEXT');
				$programacion->ProgVehTipoEXT = $request->input('ProgVehTipoEXT');
				$programacion->ProgVehColor = '#FFFF00';
				if ($request->input('vehicalqui')!=null) {
					$vehiculo = Vehiculo::select('VehicPlaca')->where('ID_Vehic', $request->input('vehicalqui'))->first()->VehicPlaca;
				}else{
					$vehiculo = null;
				}
				
				$nomConduct = null;
				$transportador = DB::table('clientes')
					->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
					->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
					->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName', 'municipios.ID_Mun')
					->where('CliSlug', $request->input('transport'))
					->first();
			}
		}
		else{
			$nomConduct = null;
			$vehiculo = null;
			$programacion->ProgVehtipo = 0;
		}
		$programacion->FK_ProgServi = $request->input('FK_ProgServi');
		$programacion->ProgVehDelete = 0;
		$programacion->save();
		// return $request->input('FK_ProgServi');

		$SolicitudServicio = SolicitudServicio::where('ID_SolSer', $programacion->FK_ProgServi)->first();

		if ($SolicitudServicio->SolSerStatus == 'Aprobado') {
			
			$serviciovalidado = $request->input('FK_ProgServi');
			/*cuenta los diferentes generadores*/
			$generadoresdelasolicitud = GenerSede::whereHas('resgener.solres', function ($query) use ($serviciovalidado) {
			    $query->where('solicitud_residuos.FK_SolResSolSer', $serviciovalidado);
			})
			->with(['resgener' => function ($query) use ($serviciovalidado){
			    $query->with(['solres' => function ($query) use ($serviciovalidado){
			    	$query->where('FK_SolResSolSer', $serviciovalidado);
			    }]);
			    $query->whereHas('solres', function ($query) use ($serviciovalidado){
			    	$query->where('FK_SolResSolSer', $serviciovalidado);
			    });
			}])
			->get();
		}
		// return $generadoresdelasolicitud;
		/*$programacion->ProgVehtipo: 0 = externo; 1 = Prosarc; 2 = alquilado; */
		/*SolSerTypeCollect: 99 = sedes generadores; 98 = sede cliente; 97 = direccion especifica; */
		/*DocType: 0 = manifiesto de carga; 1 = certificado; 2 = manifiesto de envio*/
		switch ($SolicitudServicio->SolSerTypeCollect) {
			/*recolectar en sedes de los generadores*/
			case '99':
				foreach ($generadoresdelasolicitud as $sole) {
					switch ($programacion->ProgVehtipo) {
						/*externo*/
						case '0':
							$nuevodoc = new Documento;
							$nuevodoc->DocType = 0;
							$nuevodoc->DocNumero = 0;
							$nuevodoc->DocEspName = 0;
							$nuevodoc->DocEspValue = 0;
							$nuevodoc->DocObservacion = "no deberia generar documentos";
							$nuevodoc->DocSlug = hash('sha256', rand().time());
							$nuevodoc->DocSrc = $nuevodoc->DocSlug.'.pdf';
							$nuevodoc->DocNumRm = 0;
							$nuevodoc->DocAuthHseq = 0;
							$nuevodoc->DocAuthJl = 0;
							$nuevodoc->DocAuthDp = 0;
							$nuevodoc->DocAnexo = 0;
							$nuevodoc->FK_CertSolser = $SolicitudServicio->ID_SolSer;
							$nuevodoc->DocEspValue = 0;
							// return $nuevodoc;

							break;

						/*Prosarc*/
						case '1':
							$nuevodoc = new Documento;
							$nuevodoc->DocType = 0;
							$nuevodoc->DocNumero = 1;
							$nuevodoc->DocEspName = 1;
							$nuevodoc->DocEspValue = 1;
							$nuevodoc->DocObservacion = "ok generar varios documentos";
							$nuevodoc->DocSlug = hash('sha256', rand().time());
							$nuevodoc->DocSrc = $nuevodoc->DocSlug.'.pdf';
							$nuevodoc->DocNumRm = 1;
							$nuevodoc->DocAuthHseq = 0;
							$nuevodoc->DocAuthJl = 0;
							$nuevodoc->DocAuthDp = 0;
							$nuevodoc->DocAnexo = 1;
							$nuevodoc->FK_CertSolser = $SolicitudServicio->ID_SolSer;
							$nuevodoc->DocEspValue = 1;
							// return $nuevodoc;

							break;

						/*Alquilado*/
						case '2':
							$nuevodoc = new Documento;
							$nuevodoc->DocType = 0;
							$nuevodoc->DocNumero = 2;
							$nuevodoc->DocEspName = 2;
							$nuevodoc->DocEspValue = 2;
							$nuevodoc->DocObservacion = "ok generar varios documentos";
							$nuevodoc->DocSlug = hash('sha256', rand().time());
							$nuevodoc->DocSrc = $nuevodoc->DocSlug.'.pdf';
							$nuevodoc->DocNumRm = 2;
							$nuevodoc->DocAuthHseq = 0;
							$nuevodoc->DocAuthJl = 0;
							$nuevodoc->DocAuthDp = 0;
							$nuevodoc->DocAnexo = 2;
							$nuevodoc->FK_CertSolser = $SolicitudServicio->ID_SolSer;
							$nuevodoc->DocEspValue = 2;
							// return $nuevodoc;

							break;
						
						default:
							return "no encontro el tipo de servicio";
							break;
					}
						$nuevodoc->save();

						foreach ($sole->resgener as $resgener) {
							foreach ($resgener->solres as $key) {
								$nuevodocdato = new Docdato;
								$nuevodocdato->FK_DatoDoc = $nuevodoc->ID_Doc;
								$nuevodocdato->FK_DatoSolRes = $key->ID_SolRes;
								$nuevodocdato->save();
							}
						}
					$puntoderecoleccion = new Recolect;
					$puntoderecoleccion->FK_ColectSgen = $sole->ID_GSede;
					$puntoderecoleccion->FK_ColectProg = $programacion->ID_ProgVeh;
					$puntoderecoleccion->save();
				
					// return $puntoderecoleccion;

				}
				break;

			/*recolectar en sede del cliente*/
			case '98':
					switch ($programacion->ProgVehtipo) {
						/*externo*/
						case '0':
							$nuevodoc = new Documento;
							$nuevodoc->DocType = 0;
							$nuevodoc->DocNumero = 0;
							$nuevodoc->DocEspName = 0;
							$nuevodoc->DocEspValue = 0;
							$nuevodoc->DocObservacion = "no deberia generar documentos";
							$nuevodoc->DocSlug = hash('sha256', rand().time());
							$nuevodoc->DocSrc = $nuevodoc->DocSlug.'.pdf';
							$nuevodoc->DocNumRm = 0;
							$nuevodoc->DocAuthHseq = 0;
							$nuevodoc->DocAuthJl = 0;
							$nuevodoc->DocAuthDp = 0;
							$nuevodoc->DocAnexo = 0;
							$nuevodoc->FK_CertSolser = $SolicitudServicio->ID_SolSer;
							$nuevodoc->DocEspValue = 0;
							// return $nuevodoc;

							break;

						/*Prosarc*/
						case '1':
							$nuevodoc = new Documento;
							$nuevodoc->DocType = 0;
							$nuevodoc->DocNumero = 1;
							$nuevodoc->DocEspName = 1;
							$nuevodoc->DocEspValue = 1;
							$nuevodoc->DocObservacion = "documento con la sede del generador";
							$nuevodoc->DocSlug = hash('sha256', rand().time());
							$nuevodoc->DocSrc = $nuevodoc->DocSlug.'.pdf';
							$nuevodoc->DocNumRm = 1;
							$nuevodoc->DocAuthHseq = 0;
							$nuevodoc->DocAuthJl = 0;
							$nuevodoc->DocAuthDp = 0;
							$nuevodoc->DocAnexo = 1;
							$nuevodoc->FK_CertSolser = $SolicitudServicio->ID_SolSer;
							$nuevodoc->DocEspValue = 1;
							// return $nuevodoc;

							break;

						/*Alquilado*/
						case '2':
							$nuevodoc = new Documento;
							$nuevodoc->DocType = 0;
							$nuevodoc->DocNumero = 2;
							$nuevodoc->DocEspName = 2;
							$nuevodoc->DocEspValue = 2;
							$nuevodoc->DocObservacion = "documento con la sede del generador";
							$nuevodoc->DocSlug = hash('sha256', rand().time());
							$nuevodoc->DocSrc = $nuevodoc->DocSlug.'.pdf';
							$nuevodoc->DocNumRm = 2;
							$nuevodoc->DocAuthHseq = 0;
							$nuevodoc->DocAuthJl = 0;
							$nuevodoc->DocAuthDp = 0;
							$nuevodoc->DocAnexo = 2;
							$nuevodoc->FK_CertSolser = $SolicitudServicio->ID_SolSer;
							$nuevodoc->DocEspValue = 2;
							// return $nuevodoc;

							break;
						
						default:
							return "no encontro el tipo de servicio";
							break;
					}
						$nuevodoc->save();

					foreach ($generadoresdelasolicitud as $sole) {
						foreach ($sole->resgener as $resgener) {
							foreach ($resgener->solres as $key) {
								$nuevodocdato = new Docdato;
								$nuevodocdato->FK_DatoDoc = $nuevodoc->ID_Doc;
								$nuevodocdato->FK_DatoSolRes = $key->ID_SolRes;
								$nuevodocdato->save();
							}
						}
					}
					$puntoderecoleccion = new Recolect;
					$puntoderecoleccion->FK_ColectProg = $programacion->ID_ProgVeh;
					$puntoderecoleccion->save();


					
					// return $puntoderecoleccion;
				break;

			/*recolectar en direccion especifica*/
			case '97':
				switch ($programacion->ProgVehtipo) {
					/*externo*/
					case '0':
						$nuevodoc = new Documento;
						$nuevodoc->DocType = 0;
						$nuevodoc->DocNumero = 0;
						$nuevodoc->DocEspName = 0;
						$nuevodoc->DocEspValue = 0;
						$nuevodoc->DocObservacion = "no deberia generar documento";
						$nuevodoc->DocSlug = hash('sha256', rand().time());
						$nuevodoc->DocSrc = $nuevodoc->DocSlug.'.pdf';
						$nuevodoc->DocNumRm = 0;
						$nuevodoc->DocAuthHseq = 0;
						$nuevodoc->DocAuthJl = 0;
						$nuevodoc->DocAuthDp = 0;
						$nuevodoc->DocAnexo = 0;
						$nuevodoc->FK_CertSolser = $SolicitudServicio->ID_SolSer;
						$nuevodoc->DocEspValue = 0;
						// return $nuevodoc;

						break;

					/*Prosarc*/
					case '1':
						$nuevodoc = new Documento;
						$nuevodoc->DocType = 0;
						$nuevodoc->DocNumero = 1;
						$nuevodoc->DocEspName = 1;
						$nuevodoc->DocEspValue = 1;
						$nuevodoc->DocObservacion = "documento con la direccion especifica";
						$nuevodoc->DocSlug = hash('sha256', rand().time());
						$nuevodoc->DocSrc = $nuevodoc->DocSlug.'.pdf';
						$nuevodoc->DocNumRm = 1;
						$nuevodoc->DocAuthHseq = 0;
						$nuevodoc->DocAuthJl = 0;
						$nuevodoc->DocAuthDp = 0;
						$nuevodoc->DocAnexo = 1;
						$nuevodoc->FK_CertSolser = $SolicitudServicio->ID_SolSer;
						$nuevodoc->DocEspValue = 1;
						// return $nuevodoc;

						break;

					/*Alquilado*/
					case '2':
						$nuevodoc = new Documento;
						$nuevodoc->DocType = 0;
						$nuevodoc->DocNumero = 2;
						$nuevodoc->DocEspName = 2;
						$nuevodoc->DocEspValue = 2;
						$nuevodoc->DocObservacion = "documento con la direccion especifica";
						$nuevodoc->DocSlug = hash('sha256', rand().time());
						$nuevodoc->DocSrc = $nuevodoc->DocSlug.'.pdf';
						$nuevodoc->DocNumRm = 2;
						$nuevodoc->DocAuthHseq = 0;
						$nuevodoc->DocAuthJl = 0;
						$nuevodoc->DocAuthDp = 0;
						$nuevodoc->DocAnexo = 2;
						$nuevodoc->FK_CertSolser = $SolicitudServicio->ID_SolSer;
						$nuevodoc->DocEspValue = 2;
						// return $nuevodoc;

						break;
					
					default:
						return "no encontro el tipo de servicio";
						break;
				}
					$nuevodoc->save();

				foreach ($generadoresdelasolicitud as $sole) {
					foreach ($sole->resgener as $resgener) {
						foreach ($resgener->solres as $key) {
							$nuevodocdato = new Docdato;
							$nuevodocdato->FK_DatoDoc = $nuevodoc->ID_Doc;
							$nuevodocdato->FK_DatoSolRes = $key->ID_SolRes;
							$nuevodocdato->save();
						}
					}
				}
				$puntoderecoleccion = new Recolect;
				$puntoderecoleccion->FK_ColectProg = $programacion->ID_ProgVeh;
				$puntoderecoleccion->save();
				break;
			
			default:
				// return "el tipo de servicio es externo";
				break;
		}
		
		$SolicitudServicio->SolSerStatus = 'Programado';
		if(!is_null($request->input('typetransportador'))){
			$SolicitudServicio->SolSerConductor = $nomConduct;
			$SolicitudServicio->SolSerVehiculo = $vehiculo;
			$SolicitudServicio->SolSerNameTrans = $transportador->CliName;
			$SolicitudServicio->SolSerNitTrans = $transportador->CliNit;
			$SolicitudServicio->SolSerAdressTrans = $transportador->SedeAddress;
			$SolicitudServicio->SolSerCityTrans = $transportador->ID_Mun;
		}
		$SolicitudServicio->save();
		
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
		$Programacion = ProgramacionVehiculo::with('puntosderecoleccion')
		->where('ID_ProgVeh', $id)
		->first();
		// return $Programacion;
		if (!$Programacion) {
			abort(404, 'La programación de servicio no existe');
		}
		$SolicitudServicio = DB::table('solicitud_servicios')
			->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
			->select('solicitud_servicios.*','personals.PersFirstName','personals.PersLastName', 'personals.PersEmail')
			->where('solicitud_servicios.ID_SolSer', $Programacion->FK_ProgServi)
			->first();
		if (!$SolicitudServicio) {
			abort(404, 'La solicitud de servicio no existe');
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
		if($SolicitudServicio->SolSerStatus == 'Programado'){
			setlocale(LC_ALL, "es_CO.UTF-8");
			// $Programacion = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)->where('ProgVehDelete', 0)->first();
			if(date('H', strtotime($Programacion->ProgVehSalida)) >= 12){
				$horas = " en las horas de la tarde";
			}
			else{
				$horas = " en las horas de la mañana";
			}
			$TextProgramacion = "El día ".strftime("%d", strtotime($Programacion->ProgVehFecha))." del mes de ".strftime("%B", strtotime($Programacion->ProgVehFecha)).$horas;
			$Programaciones = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)
			// ->where('ProgVehEntrada', null)
			->where('ProgVehDelete', 0)
			->get();
			$ProgramacionesActivas = count(ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)
			->where('ProgVehEntrada', null)
			->where('ProgVehDelete', 0)
			->get());
			// $ProgramacionesActivas = ($Programaciones);
		}
		$Cliente = DB::table('clientes')
			->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
			->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
			->select('clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName')
			->where('clientes.ID_Cli', $SolicitudServicio->FK_SolSerCliente)
			->first();
		/*puntos de recoleccion de la solicitud array de ID_Gsede*/	
		$puntos = $Programacion->puntosderecoleccion->map(function ($item) {
		  	return $item->ID_GSede;
		});
		$GenerResiduos = DB::table('solicitud_residuos')
			->distinct()
			->join('residuos_geners', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
			->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
			->join('generadors' , 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
			->select('gener_sedes.GSedeName', 'residuos_geners.FK_SGener', 'generadors.GenerName','gener_sedes.GSedeSlug', 'gener_sedes.GSedeAddress')
			->where('solicitud_residuos.FK_SolResSolSer', $SolicitudServicio->ID_SolSer)
			->whereIn('gener_sedes.ID_GSede', $puntos)
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
			->select('solicitud_residuos.*','residuos_geners.FK_SGener', 'respels.*', 'requerimientos.ID_Req', 'tratamientos.TratName', 'clientes.CliName')
			->where('solicitud_residuos.FK_SolResSolSer', $SolicitudServicio->ID_SolSer)
			->whereIn('residuos_geners.FK_SGener', $puntos)
			// ->where('requerimientos.ofertado', 1)
	        // ->where('forevaluation', 0)
			->get();
		
		$Residuos = $Residuosoriginal->map(function ($item) {
		  $requerimientos = Requerimiento::with(['pretratamientosSelected'])
	        ->where('ID_Req', $item->FK_SolResRequerimiento)
	        // ->where('forevaluation', 0)
	        ->first();
	        
	        $item->pretratamientosSelected = $requerimientos->pretratamientosSelected;
		  	return $item;
		});
		// return $Residuos;
		return view('ProgramacionVehicle.show', compact('SolicitudServicio','Residuos', 'GenerResiduos', 'Cliente', 'SolSerCollectAddress', 'SolSerConductor', 'TextProgramacion', 'ProgramacionesActivas', 'Programacion','Municipio', 'Programaciones'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $programacion->FK_ProgServi
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2)){
			$programacion = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
			if (!$programacion) {
				abort(404);
			}
			$vehiculos = DB::table('vehiculos')
				->select('ID_Vehic','VehicPlaca')
				->where('VehicDelete', 0)
				->get();
			if($programacion->ProgVehtipo <> 0){
				$SedeVehiculo = DB::table('sedes')
					->join('vehiculos', 'sedes.ID_Sede', '=', 'vehiculos.FK_VehiSede')
					->select('sedes.ID_Sede')
					->where('vehiculos.ID_Vehic', $programacion->FK_ProgVehiculo)
					->first();
				$Vehiculos2 = DB::table('vehiculos')
					->select('VehicPlaca', 'ID_Vehic')
					->where('FK_VehiSede', $SedeVehiculo->ID_Sede)
					->where('VehicDelete', 0)
					->get();
			}
			else{
				$SedeVehiculo = 0;
				$Vehiculos2 = 0;
			}
			/*conductores de prosarc*/
			$conductors = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('ID_Pers', 'PersFirstName', 'PersLastName')
				->where('CargName', 'Conductor')
				->where('ID_Cli', 1)
				->where('PersDelete', '!=' , 1)
				->get();
			/*auxiliares de prosarc*/
			$ayudantes = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('ID_Pers', 'PersFirstName', 'PersLastName')
				->where('CargName', 'Operario')
				->where('ID_Cli', 1)
				->get();
			$transportadores = DB::table('clientes')
				->select('CliName', 'CliSlug')
				->where('CliCategoria', 'Transportador')
				->where('CliDelete', 0)
				->get();

			$serviciovalidado = $programacion->FK_ProgServi;
			/*cuenta los diferentes generadores*/
			$generadoresdelasolicitud = GenerSede::whereHas('resgener.solres', function ($query) use ($serviciovalidado) {
			    $query->where('solicitud_residuos.FK_SolResSolSer', $serviciovalidado);
			})
			// ->with(['resgener' => function ($query) use ($serviciovalidado){
			//     $query->with(['solres' => function ($query) use ($serviciovalidado){
			//     	$query->where('FK_SolResSolSer', $serviciovalidado);
			//     }]);
			//     $query->whereHas('solres', function ($query) use ($serviciovalidado){
			//     	$query->where('FK_SolResSolSer', $serviciovalidado);
			//     });
			// }])
			->get('ID_GSede');

			/*se crea array de las sedes de generador en la solicitud de servicio*/
			$sedesgenerfiltrado = collect([]);
			foreach ($generadoresdelasolicitud as $key => $value) {
				$sedesgenerfiltrado = $sedesgenerfiltrado->concat([$value->ID_GSede]);
			}
			$recolectPointsService = GenerSede::with('generadors')
				->whereIn('ID_GSede', $sedesgenerfiltrado)
				->get();

			// return $recolectPointsService;

			$recolectPointsProg = Recolect::with('sedegen.generadors')
				->where('FK_ColectProg', $programacion->ID_ProgVeh)
				->get();

			/*return $programacion*/;

			return view('ProgramacionVehicle.edit', compact('programacion', 'vehiculos', 'conductors', 'ayudantes', 'Vehiculos2', 'transportadores', 'recolectPointsService', 'recolectPointsProg'));
		}
		 /*Validacion para usuarios no permitidos en esta vista*/
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
		$validate = $request->validate([
			'ProgVehPrecintos'   =>   'max:6|min:6'
		]);


		$programacion = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
		if (!$programacion) {
			abort(404);
		}
		// return $request;
		$programacion->ProgVehFecha = $request->input('ProgVehFecha');
		$salida = date('H:i:s', strtotime($request->input('ProgVehSalida')));
		$llegada = date('H:i:s', strtotime($request->input('ProgVehEntrada')));
		if($salida >= 12){
			$turno = "0";
		}
		else{
			$turno = "1";
		}
		$programacion->ProgVehTurno = $turno;
		$programacion->ProgVehSalida = $request->input('ProgVehFecha').' '.$salida;
		if($programacion->ProgVehtipo == 1){
			if($request->input('ProgVehEntrada')){
				$programacion->ProgVehEntrada = $request->input('ProgVehFecha').' '.$llegada;
				$programacion->progVehKm = $request->input('progVehKm');


				$vehiculo = Vehiculo::where('ID_Vehic', $request->input('FK_ProgVehiculo'))->first();
				$vehiculo->VehicKmActual = $request->input('progVehKm');
				$vehiculo->save();
			}
			else{
				$programacion->ProgVehEntrada = null;
				$programacion->progVehKm = null;
			}
			$conductor = Personal::select('PersFirstName', 'PersLastName')->where('ID_Pers', $request->input('FK_ProgConductor'))->first();
			$nomConduct = $conductor->PersFirstName." ".$conductor->PersLastName;
			$vehiculo = Vehiculo::select('VehicPlaca')->where('ID_Vehic', $request->input('FK_ProgVehiculo'))->first()->VehicPlaca;
			$programacion->FK_ProgVehiculo = $request->input('FK_ProgVehiculo');
			$programacion->FK_ProgConductor = $request->input('FK_ProgConductor');
			$programacion->FK_ProgAyudante = $request->input('FK_ProgAyudante');


			$programacion->ProgVehPrecintos = $request->input('ProgVehPrecintos');


			$programacion->ProgVehColor = $request->input('ProgVehColor');
		}
		else if($programacion->ProgVehtipo == 2){
			if($request->input('ProgVehEntrada')){
				$programacion->ProgVehEntrada = $request->input('ProgVehFecha').' '.$llegada;
			}
			$programacion->ProgVehDocConductorEXT = $request->input('ProgVehDocConductorEXT');
			$programacion->ProgVehNameConductorEXT = $request->input('ProgVehNameConductorEXT');
			$programacion->ProgVehDocAuxiliarEXT = $request->input('ProgVehDocAuxiliarEXT');
			$programacion->ProgVehNameAuxiliarEXT = $request->input('ProgVehNameAuxiliarEXT');
			$programacion->ProgVehPlacaEXT = $request->input('ProgVehPlacaEXT');
			$programacion->ProgVehTipoEXT = $request->input('ProgVehTipoEXT');
			$programacion->FK_ProgAyudante = $request->input('FK_ProgAyudante');
			$programacion->FK_ProgVehiculo = $request->input('vehicalqui');

			$programación->ProgVehPrecintos = $request->input('ProgVehPrecintos');

			$nomConduct = $programacion->ProgVehDocConductorEXT;
			$vehiculo = $programacion->ProgVehPlacaEXT;
		}
		else{
			if($request->input('ProgVehEntrada')){
				$programacion->ProgVehEntrada = $request->input('ProgVehFecha').' '.$llegada;
			}
			$programacion->FK_ProgVehiculo = $request->input('vehicalqui');
			$programacion->FK_ProgAyudante = $request->input('FK_ProgAyudante');
			// $vehiculo = Vehiculo::select('VehicPlaca')->where('ID_Vehic', $request->input('vehicalqui'))->first()->VehicPlaca;
			$nomConduct = null;
		}
		$programacion->update();
		// return $request->input('ProgGenerSedes');
		$programacion->puntosderecoleccion()->sync($request->input('ProgGenerSedes'));

		$SolicitudServicio = SolicitudServicio::where('ID_SolSer', $programacion->FK_ProgServi)->first();
		$SolicitudServicio->SolSerStatus = 'Programado';
		if($programacion->ProgVehtipo <> 0){
			$SolicitudServicio->SolSerConductor = $nomConduct;
			$SolicitudServicio->SolSerVehiculo = $vehiculo;
		}
		$SolicitudServicio->save();

		$log = new audit();
		$log->AuditTabla="progvehiculos";
		$log->AuditType="Modificado";
		$log->AuditRegistro=$programacion->ID_ProgVeh;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$request->all();
		$log->save();
		return redirect()->route('vehicle-programacion.edit',['id' => $id])->with('mensaje', trans('adminlte_lang::message.progvehceditsuccess'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$programacion = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
		if (!$programacion) {
			abort(404);
		}
		$SolicitudServicio = SolicitudServicio::where('ID_SolSer', $programacion->FK_ProgServi)->first();
		$programaciones = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)->where('ProgVehDelete', 0)->where('ID_ProgVeh', '<>', $programacion->ID_ProgVeh)->first();
		if ($programacion->ProgVehDelete == 0){
			$programacion->ProgVehDelete = 1;
			$programacion->save();
			if(is_null($programaciones) && $SolicitudServicio->SolSerStatus == 'Programado'){
				$SolicitudServicio->SolSerStatus = 'Aprobado';
				if($SolicitudServicio->SolSerTipo == 'Interno'){
					$transportador = DB::table('clientes')
						->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
						->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
						->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName',  'municipios.ID_Mun')
						->where('ID_Cli', 1)
						->first();
					$SolicitudServicio->SolSerConductor = null;
					$SolicitudServicio->SolSerVehiculo = null;
					$SolicitudServicio->SolSerNameTrans = $transportador->CliName;
					$SolicitudServicio->SolSerNitTrans = $transportador->CliNit;
					$SolicitudServicio->SolSerAdressTrans = $transportador->SedeAddress;
					$SolicitudServicio->SolSerCityTrans = $transportador->ID_Mun;
				}
				$SolicitudServicio->save();
			}

			$log = new audit();
			$log->AuditTabla = "progvehiculos";
			$log->AuditType = "Eliminado";
			$log->AuditRegistro = $programacion->ID_ProgVeh;
			$log->AuditUser = Auth::user()->email;
			$log->Auditlog = $programacion->ProgVehDelete;
			$log->save();
			return redirect()->route('vehicle-programacion.create')->with('Delete', trans('adminlte_lang::message.progvehcdeletesuccess'));
		}
		else{
			$programacion->ProgVehDelete = 0;
			if($SolicitudServicio->SolSerStatus == 'Aprobado'){
				$SolicitudServicio->SolSerStatus = 'Programado';
				if($SolicitudServicio->SolSerTipo == 'Interno'){
					$SolicitudServicio->SolSerConductor = $programacion->FK_ProgConductor;
					$SolicitudServicio->SolSerVehiculo = $programacion->FK_ProgVehiculo;
				}
				$SolicitudServicio->save();
			}

			$log = new audit();
			$log->AuditTabla = "progvehiculos";
			$log->AuditType = "Restaurado";
			$log->AuditRegistro = $programacion->ID_ProgVeh;
			$log->AuditUser = Auth::user()->email;
			$log->Auditlog = $programacion->ProgVehDelete;
			$log->save();
			$programacion->save();
			return redirect()->route('vehicle-programacion.edit',['id' => $id])->with('mensaje', trans('adminlte_lang::message.progvehcdelete2success'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function updateStatus($id)
	{
		$programacion = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
		if (!$programacion) {
			abort(404);
		}
		$SolicitudServicio = SolicitudServicio::where('ID_SolSer', $programacion->FK_ProgServi)->first();
		$programaciones = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)
		->where('ProgVehDelete', 0)
		->get();
		// return $programaciones;
		foreach ($programaciones as $vehiculo) {
			// $vehiculo = ProgramacionVehiculo::where('ID_ProgVeh', $vehiculo->ID_ProgVeh)->first();
			$vehiculo->ProgVehStatus = "Autorizado";
			$vehiculo->save();

			$log = new audit();
			$log->AuditTabla="progvehiculos";
			$log->AuditType="Autorizado";
			$log->AuditRegistro=$vehiculo->ID_ProgVeh;
			$log->AuditUser=Auth::user()->email;
			$log->Auditlog=$vehiculo->ProgVehStatus;
			$log->save();
		}


		return redirect()->route('vehicle-programacion.index')->with('mensaje', trans('servicio autorizado correctamente'));
		
	}

		/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function añadirVehiculo(Request $request, $id)
	{
		// return $request;
		$programacion = new ProgramacionVehiculo();
		if(date('H', strtotime($request->input('ProgVehSalida'))) >= 12){
			$turno = "0";
		}
		else{
			$turno = "1";
		}
		$programacion->ProgVehTurno = $turno;
		$programacion->ProgVehFecha = $request->input('ProgVehFecha');
		$programacion->ProgVehSalida = $request->input('ProgVehFecha').' '.date('H:i:s', strtotime($request->input('ProgVehSalida')));
		/*typetransportador = 0 -> transporte prosarc*/
		/*typetransportador = 1 -> transporte alquilado*/
		if(!is_null($request->input('typetransportador'))){
			if($request->input('typetransportador') == 0){
				/*ProgVehtipo = 0 -> transporte externo*/
				/*ProgVehtipo = 1 -> transporte interno prosarc*/
				/*ProgVehtipo = 2 -> transporte alquilado*/

				$programacion->ProgVehtipo = 1;
				$programacion->FK_ProgVehiculo = $request->input('FK_ProgVehiculo');
				$programacion->ProgVehColor = $request->input('ProgVehColor');
				$programacion->FK_ProgConductor = $request->input('FK_ProgConductor');
				$programacion->FK_ProgAyudante = $request->input('FK_ProgAyudante');
				$conductor = Personal::select('PersFirstName', 'PersLastName')->where('ID_Pers', $request->input('FK_ProgConductor'))->first();
				$nomConduct = $conductor->PersFirstName." ".$conductor->PersLastName;
				$vehiculo = Vehiculo::select('VehicPlaca')->where('ID_Vehic', $request->input('FK_ProgVehiculo'))->first()->VehicPlaca;
				$transportador = DB::table('clientes')
					->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
					->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
					->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName', 'municipios.ID_Mun')
					->where('ID_Cli', 1)
					->first();
			}
			else{
				$programacion->ProgVehtipo = 2;
				$programacion->FK_ProgVehiculo = $request->input('vehicalqui');
				$programacion->FK_ProgAyudante = $request->input('FK_ProgAyudante');
				$programacion->ProgVehDocConductorEXT = $request->input('ProgVehDocConductorEXT');
				$programacion->ProgVehNameConductorEXT = $request->input('ProgVehNameConductorEXT');
				$programacion->ProgVehDocAuxiliarEXT = $request->input('ProgVehDocAuxiliarEXT');
				$programacion->ProgVehNameAuxiliarEXT = $request->input('ProgVehNameAuxiliarEXT');
				$programacion->ProgVehPlacaEXT = $request->input('ProgVehPlacaEXT');
				$programacion->ProgVehTipoEXT = $request->input('ProgVehTipoEXT');
				$programacion->ProgVehColor = '#FFFF00';
				if ($request->input('vehicalqui')!=null) {
					$vehiculo = Vehiculo::select('VehicPlaca')->where('ID_Vehic', $request->input('vehicalqui'))->first()->VehicPlaca;
				}else{
					$vehiculo = null;
				}
				
				$nomConduct = null;
				$transportador = DB::table('clientes')
					->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
					->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
					->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.MunName', 'municipios.ID_Mun')
					->where('CliSlug', $request->input('transport'))
					->first();
			}
		}
		else{
			$nomConduct = null;
			$vehiculo = null;
			$programacion->ProgVehtipo = 0;
		}
		$programacion->FK_ProgServi = $id;
		$programacion->ProgVehDelete = 0;
		$programacion->ProgVehStatus =  $request->input('StatusProgServi');
		$programacion->save();

		// $SolicitudServicio = SolicitudServicio::where('ID_SolSer', $programacion->FK_ProgServi)->first();
		// $SolicitudServicio->SolSerStatus = 'Programado';
		// if(!is_null($request->input('typetransportador'))){
		// 	$SolicitudServicio->SolSerConductor = $nomConduct;
		// 	$SolicitudServicio->SolSerVehiculo = $vehiculo;
		// 	$SolicitudServicio->SolSerNameTrans = $transportador->CliName;
		// 	$SolicitudServicio->SolSerNitTrans = $transportador->CliNit;
		// 	$SolicitudServicio->SolSerAdressTrans = $transportador->SedeAddress;
		// 	$SolicitudServicio->SolSerCityTrans = $transportador->ID_Mun;
		// }
		// $SolicitudServicio->save();
		
		return redirect()->route('vehicle-programacion.index');
		
	}
}
