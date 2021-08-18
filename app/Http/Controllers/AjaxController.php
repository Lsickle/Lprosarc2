<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Http\Controllers\userController;
use App\ProgramacionVehiculo;
use App\Http\Requests\CambiodefechaStoreRequest;
use App\Sede;
use App\Area;
use App\Requerimiento;
use App\Tratamiento;
use App\Pretratamientos;
use App\Generador;
use App\GenerSede;
use App\Certificado;
use App\SolicitudServicio;
use App\Cliente;
use App\Personal;
use App\Permisos;
use App\audit;
use App\Observacion;
use App\Prefactura;
use App\PrefacturaTratamiento;
use App\PrefacturaResiduo;
use App\Mail\SolSerEmail;
use App\Mail\ConcilacionRecordatorio;
use App\Mail\CertUpdatedComercial;
use App\Mail\ServicioFacturado;




class AjaxController extends Controller
{
	/*Funcion para ver por medio de Ajax los Municipios que le competen a un Departamento*/
	public function MuniDepart(Request $request, $id)
	{
		if ($request->ajax()) {
			$municipio = DB::table('municipios')
				->select('*')
				->where('FK_MunCity', $id)
				->orderBy('MunName', 'desc')
				->get();
			return response()->json($municipio);
		}
	}

	/*Funcion para ver por medio de Ajax los Municipios que le competen a un Departamento*/
	public function DocNumber(Request $request, $id)
	{
		if ($request->ajax()) {
			switch ($id) {
				case '0':
					$ultimoNumero = Certificado::where('CertNumero', '!=', NULL)->orderBy('CertNumero', 'desc')->first('CertNumero');
					$proximoNumero = ($ultimoNumero->CertNumero == NULL) ? 1 : $ultimoNumero->CertNumero+1 ;
					break;
				case '1':
					$ultimoNumero = Certificado::where('CertManifNumero', '!=', NULL)->orderBy('CertManifNumero', 'desc')->first('CertManifNumero');
					$proximoNumero = ($ultimoNumero == NULL) ? 1 : ($ultimoNumero->CertManifNumero+1);
					break;
				case '2':
					$proximoNumero = '';
				break;

				default:
					abort(404, 'tipo de documento no encontrado');
					break;
			}
			return response()->json($proximoNumero);
		}
	}

	/*Funcion para ver por medio de Ajax las Areas que le competen a una Sede*/
	public function AreasSedes(Request $request, $id)
	{
		if ($request->ajax()) {
			$Sede = Sede::where('SedeSlug', $id)->first();
			$Areas = DB::table('areas')
				->select('AreaSlug','AreaName')
				->where('FK_AreaSede', $Sede->ID_Sede)
				->where('AreaDelete', '=', 0)
				->get();

			return response()->json($Areas);
		}
	}
	/*Funcion para ver por medio de Ajax los Cargos que le competen a una Area*/
	public function CargosAreas(Request $request, $id)
	{
		if ($request->ajax()) {
			$Area = Area::where('AreaSlug', $id)->first();
			$Cargos = DB::table('cargos')
				->select('CargSlug', 'CargName')
				->where('CargArea', $Area->ID_Area)
				->where('CargDelete', '=', 0)
				->get();
			return response()->json($Cargos);
		}
	}
	/*Funcion para cambiar el dia y hora de la programacion de un Vehiculo*/
	public function CambioDeFecha(CambiodefechaStoreRequest $request, $id){
		/*return $request;*/
		if ($request->ajax()) {
			$fecha = date('Y-m-d', strtotime(substr($request->Event, 0, -1)));
			$hora = date('H:i:s', strtotime(substr($request->Event, 0, -1)));
			$eventos = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
			$eventos->ProgVehFecha = $fecha;
			$eventos->ProgVehSalida = $fecha." ".$hora;
			$eventos->save();
			return trans('adminlte_lang::message.progvehceditsuccess');
		}
	}

	/*Funcion para ver por medio de Ajax los Respels que le competen a una SGenerador*/
	public function SGenerRespel(Request $request, $id)
	{
		if ($request->ajax()) {
			$SGener = GenerSede::select('ID_GSede')->where('GSedeSlug', $id)->first();
			$ID_Cli = userController::IDClienteSegunUsuario();
			$ResSGeners = DB::table('residuos_geners')
				->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
				->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
				->select('respels.ID_Respel')
				->where('FK_SGener', '=', $SGener->ID_GSede)
				->where('residuos_geners.DeleteSGenerRes', '=', 0)
				->get();

			$Cliente = DB::table('gener_sedes')
				->join('generadors','generadors.ID_Gener','=', 'gener_sedes.FK_GSede')
				->join('sedes','sedes.ID_Sede','=', 'generadors.FK_GenerCli')
				->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
				->where('gener_sedes.ID_GSede', '=', $SGener->ID_GSede)
				->select('clientes.ID_Cli')
				->first();

			$Respels = DB::table('respels')
				->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
				->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
				->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
				->select('respels.ID_Respel', 'respels.RespelName', 'respels.RespelSlug')
				->whereIn('respels.RespelStatus', ['Aprobado', 'Revisado', 'Falta TDE', 'TDE actualizada', 'Vencido'])
				->where('cotizacions.CotiStatus', '=', 'Aprobada')
				->where('respels.RespelDelete', '=', 0)
				->where(function ($query) use ($ResSGeners){
					foreach ($ResSGeners as $ResSGener) {
						$query->where('respels.ID_Respel', '<>', $ResSGener->ID_Respel);
					}
				})
				->where(function ($query) use ($ID_Cli, $Cliente){
					if(Auth::user()->UsRol === 'Programador'){
						$query->where('clientes.ID_Cli', $Cliente->ID_Cli);
					}
					if(Auth::user()->UsRol === 'Cliente'){
						$query->where('clientes.ID_Cli', $ID_Cli);
					}
				})
				->get();

		return response()->json($Respels);
		}
	}

	/*Funcion para ver los residuos de una sede de generador*/
	public function RespelGener(Request $request, $slug){
		if ($request->ajax()){
			$Respels = DB::table('residuos_geners')
				->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
				->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
				->join('requerimientos', 'requerimientos.FK_ReqRespel', '=', 'respels.ID_Respel')
				->select('residuos_geners.SlugSGenerRes', 'respels.RespelName', 'respels.RespelSlug', 'respels.ID_Respel', 'requerimientos.FK_ReqTrata', 'requerimientos.forevaluation', 'requerimientos.ofertado')
				->whereIn('respels.RespelStatus', ['Aprobado', 'Revisado', 'Falta TDE', 'TDE actualizada', 'Vencido'])
				->where('respels.RespelDelete', 0)
				->where('gener_sedes.GSedeSlug', $slug)
				->where('residuos_geners.DeleteSGenerRes', '=', 0)
				->where('requerimientos.forevaluation', 1)
				->where('requerimientos.ofertado', 1)
				->get();

			foreach ($Respels as $key => $value) {
				if (isset($Respels[$key]->FK_ReqTrata) && $Respels[$key]->ofertado == 1) {
					$tratamiento = Tratamiento::where('ID_Trat', $Respels[$key]->FK_ReqTrata)->first('TratName');
					if (isset($tratamiento->TratName)) {
						$Respels[$key]->TratName = $tratamiento->TratName;
					}else{
						$Respels[$key]->TratName = '';
					}
				}else{
					$Respels[$key]->TratName = '';
				}
			}
				return response()->json($Respels);
		}
	}

	/*Funcion para ver los requerimientos de un residuo sengun su tratamiento*/
	public function RequeRespel(Request $request, $slug){
		if($request->ajax()){
			$Requerimientos = DB::table('requerimientos')
				->join('respels', 'requerimientos.FK_ReqRespel', '=', 'respels.ID_Respel')
				->join('tarifas', 'requerimientos.ID_Req', '=', 'tarifas.FK_TarifaReq')
				->select('ReqFotoDescargue', 'ReqFotoDestruccion', 'ReqVideoDescargue', 'ReqVideoDestruccion', 'ReqDevolucion', 'ReqDevolucionTipo', 'tarifas.Tarifatipo', 'ReqAuditoria', 'auto_ReqFotoDescargue', 'auto_ReqFotoDestruccion', 'auto_ReqVideoDescargue', 'auto_ReqVideoDestruccion', 'auto_ReqDevolucion', 'auto_ReqAuditoria')
				->where('respels.RespelSlug', $slug)
				->where('requerimientos.ofertado', 1)
				->where('requerimientos.forevaluation', 1)
				->first();
			return response()->json($Requerimientos);
		}
	}

	/*Funcion para ver por medio de Ajax los vehiculos que le competen a un Transportador*/
	public function VehicTransport(Request $request, $id)
	{
		if ($request->ajax()) {
			$SedeTransportador = DB::table('clientes')
				->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
				->select('sedes.ID_Sede')
				->where('clientes.CliSlug', $id)
				->where('CliDelete', '=', 0)
				->first();
			$Vehiculos = DB::table('vehiculos')
				->select('VehicPlaca', 'ID_Vehic')
				->where('FK_VehiSede', $SedeTransportador->ID_Sede)
				->where('VehicDelete', 0)
				->get();
			return response()->json($Vehiculos);
		}
	}

	/*Funcion para ver por medio de Ajax los pretratamietnos que le competen a un tratamiento*/
	public function preTratamientoDinamico(Request $request, $id)
	{
		if ($request->ajax()) {
			$pretrataOption = Tratamiento::with('pretratamientos')
				->where('ID_Trat', $id)
				->first();
			return response()->json($pretrataOption);
		}
	}


	/*Funcion para ver por medio de Ajax los subcategorias que le corresponden a una categoria de respel public*/
	public function SubcategoriaDinamico(Request $request, $id)
	{
		if ($request->ajax()) {
			$subcategories = DB::table('subcategoryrespelpublic')
				->select('*')
				->where('FK_CategoryRP', $id)
				->orderBy('SubCategoryRpName', 'desc')
				->get();
			return response()->json($subcategories);
		}
	}

	/*Funcion para verificar si el numero de documento durante la actualizacion de certificados o manifiestos quedari duplicado en la base de datos*/
	public function verificarDuplicado(Request $request, $numero, $type)
	{
		if ($request->ajax()) {
			switch ($type) {
				case '0':
			$documentos = Certificado::where('CertNumero', $numero)->get();
					break;

				case '1':
			$documentos = Certificado::where('CertManifNumero', $numero)->get();
					break;

				default:
					# code...
					break;
			}
			if ($documentos->count() > 0) {
				$numeroexiste = true;
			}else{
				$numeroexiste = false;
			}
			return response()->json($numeroexiste);
		}
	}

	/*Funcion para certtificacion de servicios via ajax*/
	public function certificarServicio(Request $request, $servicio)
	{
		if ($request->ajax()) {
			if (in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi)) {
				$Solicitud = SolicitudServicio::where('SolSerSlug', $servicio)->first();
				if (!$Solicitud) {
					abort(404);
				}
				switch ($Solicitud->SolSerStatus) {
					case 'Conciliado':
					case 'Tratado':
					case 'Facturado':
						$Solicitud->SolSerStatus = 'Certificacion';
						$Solicitud->SolServCertStatus = 2;
						$Solicitud->SolSerDescript = $request->input('solserdescript');
						$Solicitud->save();

						$log = new audit();
						$log->AuditTabla="solicitud_servicios";
						$log->AuditType="Modificado Status";
						$log->AuditRegistro=$Solicitud->ID_SolSer;
						$log->AuditUser=Auth::user()->email;
						$log->Auditlog=$Solicitud->SolSerStatus;
						$log->save();

						$resCode = 200;
						$res = 'la solicitud de servicio #'.$Solicitud->ID_SolSer.' del cliente xxx certificada con exito';
						break;

					case 'Certificacion':
						$resCode = 400;
						$res = 'la solicitud de servicio #'.$Solicitud->ID_SolSer.' ya se encuentra certificada';
						break;

					default:
						$resCode = 403;
						$res = 'La solicitud de servicio #'.$Solicitud->ID_SolSer.', aun no se puede certificar, ya que se encuentra en status de '.$Solicitud->SolSerStatus;
						break;
				}
				if ($resCode == 200) {

					/*se guarda la observacion inicial de la creación del servicio*/
					$Observacion = new Observacion();
					$Observacion->ObsStatus = $Solicitud->SolSerStatus;
					if ($Solicitud->SolSerDescript == "" || $Solicitud->SolSerDescript == null) {
						$Observacion->ObsMensaje = 'Servicio Certificado';
					}else{
						$Observacion->ObsMensaje = $Solicitud->SolSerDescript;
					}
					$Observacion->ObsTipo = 'prosarc';
					$Observacion->ObsRepeat = 1;
					$Observacion->ObsDate = now();
					$Observacion->ObsUser = Auth::user()->email;
					$Observacion->ObsRol = Auth::user()->UsRol;
					$Observacion->FK_ObsSolSer = $Solicitud->ID_SolSer;
					$Observacion->save();

					$email = DB::table('solicitud_servicios')
						->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                		->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
						->select('personals.PersEmail', 'solicitud_servicios.*', 'clientes.CliName', 'clientes.CliComercial')
						->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
						->first();

					$comercial = Personal::where('ID_Pers', $email->CliComercial)->first();

					if ($comercial) {
						$destinatarios = [$comercial->PersEmail];
					} else {
						$destinatarios = [];
					}


					$destinatarios = [$comercial->PersEmail];
					if ($Solicitud->SolServMailCopia == "null") {
                        Mail::to($email->PersEmail)
                        ->cc($destinatarios)
                        ->send(new SolSerEmail($email));
                    }else{
                        foreach (json_decode($Solicitud->SolServMailCopia) as $key => $value) {
                            array_push($destinatarios, $value);
                        }
                        Mail::to($email->PersEmail)
                        ->cc($destinatarios)
                        ->send(new SolSerEmail($email));
                    }
				}
				return response()->json(['message' => $res, 'code' => $resCode], $resCode);

			}else{
				return response()->json(['error' => 'Usuario no autorizado'], 401);
			}


		}
	}

	/*Funcion para certtificacion de servicios via ajax*/
	public function facturarServicio(Request $request, $servicio)
	{
        // return $servicio;
		$request->validate([
			'FacturacionTipo' => 'required|in:Mensual,Servicio',
			'ordenCompra' => 'nullable|max:20',
			'costoTransporte' => 'required|numeric|min:0',
			'FechaInicial' => 'required_if:FacturacionTipo,Mensual|before_or_equal:FechaFinal|date_format:Y/m/d',
			'FechaFinal' => 'required_if:FacturacionTipo,Mensual|after_or_equal:FechaInicial|date_format:Y/m/d',
		], [
			'*.required' => 'debe especificar un valor en el campo :attribute',
			'costoTransporte.min' => 'ingrese un valor mayor a 0 en el campo :attribute',
			'costoTransporte.numeric' => 'ingrese un valor mayor a 0 en el campo :attribute',
			'FechaInicial.date' => 'la :attribute debe ser una fecha valida ',
			'FechaInicial.date_format' => 'el formato de :attribute debe ser YYYY/MM/DD',
			'FechaInicial.before_or_equal' => 'la :attribute debe ser anterior a la Fecha FINAL',
			'FechaFinal.date' => 'la :attribute debe ser una fecha valida',
			'FechaFinal.date_format' => 'el formato de :attribute debe ser YYYY/MM/DD',
			'FechaFinal.after_or_equal' => 'la :attribute debe ser posterior a la Fecha INICIAL',
		], [
			'FacturacionTipo' => 'Tipo de facturación',
			'ordenCompra' => 'Orden De Compra',
			'costoTransporte' => 'Costo de transporte',
			'FechaInicial' => 'Fecha inicial',
			'FechaFinal' => 'Fecha final',
		]);

		// $data = [];
		// if ($request->ajax()) {
		// 	$data['slug'] = $servicio;
		// 	$data['new_token'] = csrf_token();
		// 	$data['peticionType'] = 'ajax';
		// 	$data['request'] = $request;
		// }else{
		// 	$data['peticionType'] = 'NO ajax';
		// }
		// return response()->json($data);

		// return $servicio;
        // return $request;
		if ($request->ajax()) {
			if (in_array(Auth::user()->UsRol, Permisos::COMERCIALES) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALES)) {
				$Solicitudorigin = SolicitudServicio::with('SolicitudResiduo')->where('SolSerSlug', $servicio)->first();

                // CHECK TYPE OF FACTURATION
                if ($request->FacturacionTipo == 'Mensual') {
                    // query services of clients with programacion de servicios
                    // formar fecha inicial y final
                    // $from = $request->input('FechaInicial');
                    // $to = $request->input('FechaFinal');
                    // // return $from;
                    // $serviciosPorFacturar = SolicitudServicio::with(['SolicitudResiduo', 'programacionesrecibidas'])
                    // ->whereHas('programacionesrecibidas', function ($query) use ($from, $to) {
                    //     $query->whereBetween('ProgVehFecha', [$from, $to]);
                    //     // $query->where('ProgVehFecha', '>=', $from);
                    //     // $query->where('ProgVehFecha', '<=', $to);
                    // })
                    // ->where('FK_SolSerCliente', $Solicitudorigin->FK_SolSerCliente)
                    // ->where('SolSerStatus', '=', 'Conciliado')
                    // ->get();

                    // foreach ($serviciosPorFacturar as $Solicitud) {
                    //     if (!$Solicitud) {
                    //         abort(404);
                    //     }
                    //     switch ($Solicitud->SolSerStatus) {
                    //         case 'Conciliado':
                    //         case 'Tratado':
                    //             $Solicitud->SolSerStatus = 'Facturado';
                    //             $Solicitud->SolServCertStatus = 1;
                    //             $Solicitud->SolSerDescript = $request->input('solserdescript');
                    //             $Solicitud->save();

                    //             $log = new audit();
                    //             $log->AuditTabla="solicitud_servicios";
                    //             $log->AuditType="Modificado Status";
                    //             $log->AuditRegistro=$Solicitud->ID_SolSer;
                    //             $log->AuditUser=Auth::user()->email;
                    //             $log->Auditlog=$Solicitud->SolSerStatus;
                    //             $log->save();

                    //             $resCode = 200;
                    //             $res = 'la solicitud de servicio #'.$Solicitud->ID_SolSer.' del cliente facturada con exito';

                    //             /* validacion para encontrar la fecha de recepción en planta del servicio */
                    //             $fechaRecepcion = $Solicitud->programacionesrecibidas()->first();
                    //             if($fechaRecepcion){
                    //                 $Solicitud->recepcion = $fechaRecepcion->ProgVehSalida;
                    //             }else{
                    //                 $Solicitud->recepcion = now()->format('Y-m-d');
                    //             }

                    //             $prefactura = new Prefactura();
                    //             $prefactura->FK_Comercial = $Solicitud->cliente->comercialAsignado->ID_Pers;
                    //             $prefactura->FK_Cliente = $Solicitud->FK_SolSerCliente;
                    //             $prefactura->FK_Servicio = $Solicitud->ID_SolSer;
                    //             $prefactura->Costo_transporte = $request->input('costoTransporte');
                    //             $prefactura->Subtotal_procesos = 0; /**sin incluir el costo por transportes */
                    //             $prefactura->Total_prefactura = $prefactura->Costo_transporte; /** total servicios mas costo de transportes */
                    //             $prefactura->status_prefactura = 'Abierta';
                    //             $prefactura->orden_compra = $request->input('ordenCompra');
                    //             $prefactura->Fecha_Servicio = $Solicitud->recepcion;
                    //             $prefactura->save();


                    //             $rms_list = array();

                    //             foreach ($Solicitud->SolicitudResiduo as $key => $residuo) {
                    //                 /**validar el peso segun el tipo de unidad */
                    //                 $pesoConciliado = 0;
                    //                 switch ($residuo->SolResTypeUnidad) {
                    //                     case 'Unidad':
                    //                     case 'Litros':
                    //                         $pesoConciliado = $residuo->SolResCantiUnidadConciliada;
                    //                         $unidadpesaje = $residuo->SolResTypeUnidad;
                    //                         break;

                    //                     default:
                    //                         $pesoConciliado = $residuo->SolResKgConciliado;
                    //                         $unidadpesaje = 'Kg';
                    //                         break;
                    //                 }
                    //                 // saltar si no hay cantidad conciliada
                    //                 if ($pesoConciliado <= 0) {
                    //                     continue;
                    //                 }
                    //                 // consltar el tipo de tratamiento
                    //                 $prefacturaTratamiento = PrefacturaTratamiento::with('prefacresiduo')
                    //                 ->where('FK_Prefactura', $prefactura->ID_Prefactura)
                    //                 ->where('FK_Tratamiento', $residuo->requerimiento->FK_ReqTrata)
                    //                 ->where('unidad_tratamiento', $unidadpesaje)
                    //                 ->first();

                    //                 /**validar si existe la prefac_tratamiento */
                    //                 if ($prefacturaTratamiento === null) {
                    //                     // en caso de que no esxista se crea una nuevo registro de prefactura tratamiento
                    //                     $prefacturaTratamiento = new prefacturaTratamiento();
                    //                     $prefacturaTratamiento->FK_Prefactura = $prefactura->ID_Prefactura;
                    //                     $prefacturaTratamiento->FK_Tratamiento = $residuo->requerimiento->FK_ReqTrata;
                    //                     $prefacturaTratamiento->unidad_tratamiento = $unidadpesaje;
                    //                     $prefacturaTratamiento->cantidad_tratamiento = 0;
                    //                     $prefacturaTratamiento->Subtotal_tarifa_trat = 0;
                    //                     $prefacturaTratamiento->Total_prefactratamiento = 0;

                    //                     if (Arr::accessible($residuo->SolResRM)) {
                    //                         if (Arr::isAssoc($residuo->SolResRM)) {
                    //                             $prefacturaTratamiento->RMs = '{"a":array asociativo}';
                    //                         }else{
                    //                             $prefacturaTratamiento->RMs = json_encode($residuo->SolResRM);
                    //                         }
                    //                         // $prefacturaTratamiento->RMs = $residuo->SolResRM;
                    //                     }else{
                    //                         $prefacturaTratamiento->RMs = '{"a":no array}';
                    //                     }
                    //                     $prefacturaTratamiento->save();
                    //                 }

                    //                 $prefacturaResiduo = new PrefacturaResiduo();
                    //                 $prefacturaResiduo->FK_Prefactura = $prefactura->ID_Prefactura;
                    //                 $prefacturaResiduo->FK_PreFacTratamiento = $prefacturaTratamiento->ID_PrefacTratamiento;
                    //                 $prefacturaResiduo->precio_tarifa = $residuo->SolResPrecio;
                    //                 switch ($residuo->SolResTypeUnidad) {
                    //                     case 'Unidad':
                    //                     case 'Litros':
                    //                         $prefacturaResiduo->subtotal_respel = $residuo->SolResPrecio * $residuo->SolResCantiUnidadConciliada;
                    //                         $prefacturaResiduo->cantidad_respel = $residuo->SolResCantiUnidadConciliada;
                    //                         $prefacturaResiduo->unidad_respel = $residuo->SolResTypeUnidad;
                    //                         break;

                    //                     default:
                    //                         $prefacturaResiduo->subtotal_respel = $residuo->SolResPrecio * $residuo->SolResKgConciliado;
                    //                         $prefacturaResiduo->cantidad_respel = $residuo->SolResKgConciliado;
                    //                         $prefacturaResiduo->unidad_respel = 'Kg';
                    //                         break;
                    //                 }
                    //                 if (Arr::accessible($residuo->SolResRM)) {
                    //                     if (Arr::isAssoc($residuo->SolResRM)) {
                    //                         $prefacturaResiduo->RMs = '{"a":array asociativo}';
                    //                     }else{
                    //                         $prefacturaResiduo->RMs = $residuo->SolResRM;
                    //                     }
                    //                     // $prefacturaResiduo->RMs = $residuo->SolResRM;
                    //                 }else{
                    //                     $prefacturaResiduo->RMs = '{"a":no array}';
                    //                 }
                    //                 $prefacturaResiduo->FK_SolRespel = $residuo->ID_SolRes;
                    //                 $prefacturaResiduo->save();

                    //                 $prefacturaTratamiento->cantidad_tratamiento += $prefacturaResiduo->cantidad_respel;
                    //                 $prefacturaTratamiento->Subtotal_tarifa_trat = $prefacturaResiduo->precio_tarifa;
                    //                 $prefacturaTratamiento->Total_prefactratamiento += $prefacturaResiduo->subtotal_respel;
                    //                 /* falta agrupar los numeros de los recibos de materiales ya que estan en formato string y puede dar error */
                    //                 if (Arr::accessible($residuo->SolResRM)) {
                    //                     if (Arr::isAssoc($residuo->SolResRM)) {
                    //                         $prefacturaTratamiento->RMs = '{"a":array asociativo}';
                    //                     }else{
                    //                         $rmsprevios = json_decode($prefacturaTratamiento->RMs, true) ;
                    //                         $prefacturaTratamiento->RMs = json_encode(array_unique(Arr::collapse([$rmsprevios, $residuo->SolResRM])));
                    //                     }
                    //                 }else{
                    //                     $prefacturaTratamiento->RMs = '{"a":no array}';
                    //                 }
                    //                 $prefacturaTratamiento->save();
                    //                 /**actualizar los totales de la factura */
                    //                 $prefactura->Subtotal_procesos += $prefacturaResiduo->subtotal_respel;
                    //                 $prefactura->Total_prefactura += $prefacturaResiduo->subtotal_respel;
                    //                 $prefactura->save();

                    //             }

                    //             break;

                    //         case 'Facturado':
                    //             $resCode = 400;
                    //             $res = 'la solicitud de servicio #'.$Solicitud->ID_SolSer.' ya se encuentra Facturada';
                    //             break;

                    //         case 'Certificacion':
                    //             $resCode = 400;
                    //             $res = 'la solicitud de servicio #'.$Solicitud->ID_SolSer.' ya se encuentra certificada y no admite cambios de status';
                    //             break;

                    //         default:
                    //             $resCode = 403;
                    //             $res = 'La solicitud de servicio #'.$Solicitud->ID_SolSer.', aun no se puede facturar, ya que se encuentra en status de '.$Solicitud->SolSerStatus;
                    //             break;
                    //     }
                    //     if ($resCode == 200) {

                    //         /*se guarda la observacion inicial de la creación del servicio*/
                    //         $Observacion = new Observacion();
                    //         $Observacion->ObsStatus = $Solicitud->SolSerStatus;
                    //         if ($Solicitud->SolSerDescript == "" || $Solicitud->SolSerDescript == null) {
                    //             $Observacion->ObsMensaje = 'Servicio enviado a Facturación';
                    //         }else{
                    //             $Observacion->ObsMensaje = $Solicitud->SolSerDescript;
                    //         }
                    //         $Observacion->ObsTipo = 'prosarc';
                    //         $Observacion->ObsRepeat = 1;
                    //         $Observacion->ObsDate = now();
                    //         $Observacion->ObsUser = Auth::user()->email;
                    //         $Observacion->ObsRol = Auth::user()->UsRol;
                    //         $Observacion->FK_ObsSolSer = $Solicitud->ID_SolSer;
                    //         $Observacion->save();

                    //         // $email = DB::table('solicitud_servicios')
                    //         // 	->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                    //         // 	->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                    //         // 	->select('personals.PersEmail', 'solicitud_servicios.*', 'clientes.CliName', 'clientes.CliComercial')
                    //         // 	->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                    //         // 	->first();

                    //         // $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();

                    //         // if ($comercial) {
                    //         // 	$destinatarios = [$comercial->PersEmail];
                    //         // } else {
                    //         // 	$destinatarios = [];
                    //         // }


                    //         // $destinatarios = [$comercial->PersEmail];
                    //         // if ($Solicitud->SolServMailCopia == "null") {
                    //         //     Mail::to($email->PersEmail)
                    //         //     ->cc($destinatarios)
                    //         //     ->send(new SolSerEmail($email));
                    //         // }else{
                    //         //     foreach (json_decode($Solicitud->SolServMailCopia) as $key => $value) {
                    //         //         array_push($destinatarios, $value);
                    //         //     }
                    //         //     Mail::to($email->PersEmail)
                    //         //     ->cc($destinatarios)
                    //         //     ->send(new SolSerEmail($email));
                    //         // }
                    //     }
                    //     if ($Solicitud->cliente->comercialAsignado->ID_Pers <> null) {
                    //         $comercial = Personal::where('ID_Pers', $Solicitud->cliente->comercialAsignado->ID_Pers)->first();
                    //         // $destinatarios = ['gestion@prosarc.com.co',
                    //         // 					'sistemas@prosarc.com.co',
                    //         // 					'subgerencia@prosarc.com.co',
                    //         // 					$comercial->PersEmail
                    //         // 				];
                    //         $destinatarios = ['sistemas@prosarc.com.co'];
                    //     }else{
                    //         $comercial = "";
                    //         $destinatarios = ['logistica@prosarc.com.co',
                    //                             'asistentelogistica@prosarc.com.co',
                    //                             'subgerencia@prosarc.com.co',
                    //                             'recepcionpda@prosarc.com.co'
                    //                         ];
                    //     }

                    //     $prefacturas = Prefactura::with(['cliente', 'comercial', 'servicio.programacionesrecibidas', 'prefacTratamiento.prefacresiduo'])->where('ID_Prefactura', $prefactura->ID_Prefactura)->get();

                    //     Mail::to($destinatarios)->send(new ServicioFacturado($prefacturas));
                    //     return response()->json([
                    //         'message' => $res,
                    //         'code' => $resCode,
                    //         'new_token' => csrf_token()],
                    //         $resCode);
                    // }
                } else {
                    if (!$Solicitudorigin) {
                        abort(404);
                    }
                    switch ($Solicitudorigin->SolSerStatus) {
                        case 'Conciliado':
                        case 'Tratado':
                            $Solicitudorigin->SolSerStatus = 'Facturado';
                            $Solicitudorigin->SolServCertStatus = 1;
                            $Solicitudorigin->SolSerDescript = $request->input('solserdescript');
                            $Solicitudorigin->save();

                            $log = new audit();
                            $log->AuditTabla="solicitud_servicios";
                            $log->AuditType="Modificado Status";
                            $log->AuditRegistro=$Solicitudorigin->ID_SolSer;
                            $log->AuditUser=Auth::user()->email;
                            $log->Auditlog=$Solicitudorigin->SolSerStatus;
                            $log->save();

                            $resCode = 200;
                            $res = 'la solicitud de servicio #'.$Solicitudorigin->ID_SolSer.' del cliente facturada con exito';

                            /* validacion para encontrar la fecha de recepción en planta del servicio */
                            $fechaRecepcion = $Solicitudorigin->programacionesrecibidas()->first();
                            if($fechaRecepcion){
                                $Solicitudorigin->recepcion = $fechaRecepcion->ProgVehSalida;
                            }else{
                                $Solicitudorigin->recepcion = now()->format('Y-m-d');
                            }

                            $prefactura = new Prefactura();
                            $prefactura->FK_Comercial = $Solicitudorigin->cliente->comercialAsignado->ID_Pers;
                            $prefactura->FK_Cliente = $Solicitudorigin->FK_SolSerCliente;
                            $prefactura->FK_Servicio = $Solicitudorigin->ID_SolSer;
                            $prefactura->Costo_transporte = $request->input('costoTransporte');
                            $prefactura->Subtotal_procesos = 0; /**sin incluir el costo por transportes */
                            $prefactura->Total_prefactura = $prefactura->Costo_transporte; /** total servicios mas costo de transportes */
                            $prefactura->status_prefactura = 'Abierta';
                            $prefactura->orden_compra = $request->input('ordenCompra');
                            $prefactura->Fecha_Servicio = $Solicitudorigin->recepcion;
                            $prefactura->save();


                            $rms_list = array();

                            foreach ($Solicitudorigin->SolicitudResiduo as $key => $residuo) {
                                /**validar el peso segun el tipo de unidad */
                                $pesoConciliado = 0;
                                switch ($residuo->SolResTypeUnidad) {
                                    case 'Unidad':
                                    case 'Litros':
                                        $pesoConciliado = $residuo->SolResCantiUnidadConciliada;
                                        $unidadpesaje = $residuo->SolResTypeUnidad;
                                        break;

                                    default:
                                        $pesoConciliado = $residuo->SolResKgConciliado;
                                        $unidadpesaje = 'Kg';
                                        break;
                                }
                                // saltar si no hay cantidad conciliada
                                if ($pesoConciliado <= 0) {
                                    continue;
                                }
                                // consltar el tipo de tratamiento
                                $prefacturaTratamiento = PrefacturaTratamiento::with('prefacresiduo')
                                ->where('FK_Prefactura', $prefactura->ID_Prefactura)
                                ->where('FK_Tratamiento', $residuo->requerimiento->FK_ReqTrata)
                                ->where('unidad_tratamiento', $unidadpesaje)
                                ->first();

                                /**validar si existe la prefac_tratamiento */
                                if ($prefacturaTratamiento === null) {
                                    // en caso de que no esxista se crea una nuevo registro de prefactura tratamiento
                                    $prefacturaTratamiento = new prefacturaTratamiento();
                                    $prefacturaTratamiento->FK_Prefactura = $prefactura->ID_Prefactura;
                                    $prefacturaTratamiento->FK_Tratamiento = $residuo->requerimiento->FK_ReqTrata;
                                    $prefacturaTratamiento->unidad_tratamiento = $unidadpesaje;
                                    $prefacturaTratamiento->cantidad_tratamiento = 0;
                                    $prefacturaTratamiento->Subtotal_tarifa_trat = 0;
                                    $prefacturaTratamiento->Total_prefactratamiento = 0;

                                    if (Arr::accessible($residuo->SolResRM)) {
                                        if (Arr::isAssoc($residuo->SolResRM)) {
                                            $prefacturaTratamiento->RMs = '{"a":array asociativo}';
                                        }else{
                                            $prefacturaTratamiento->RMs = json_encode($residuo->SolResRM);
                                        }
                                        // $prefacturaTratamiento->RMs = $residuo->SolResRM;
                                    }else{
                                        $prefacturaTratamiento->RMs = '{"a":no array}';
                                    }
                                    $prefacturaTratamiento->save();
                                }

                                $prefacturaResiduo = new PrefacturaResiduo();
                                $prefacturaResiduo->FK_Prefactura = $prefactura->ID_Prefactura;
                                $prefacturaResiduo->FK_PreFacTratamiento = $prefacturaTratamiento->ID_PrefacTratamiento;
                                $prefacturaResiduo->precio_tarifa = $residuo->SolResPrecio;
                                switch ($residuo->SolResTypeUnidad) {
                                    case 'Unidad':
                                    case 'Litros':
                                        $prefacturaResiduo->subtotal_respel = $residuo->SolResPrecio * $residuo->SolResCantiUnidadConciliada;
                                        $prefacturaResiduo->cantidad_respel = $residuo->SolResCantiUnidadConciliada;
                                        $prefacturaResiduo->unidad_respel = $residuo->SolResTypeUnidad;
                                        break;

                                    default:
                                        $prefacturaResiduo->subtotal_respel = $residuo->SolResPrecio * $residuo->SolResKgConciliado;
                                        $prefacturaResiduo->cantidad_respel = $residuo->SolResKgConciliado;
                                        $prefacturaResiduo->unidad_respel = 'Kg';
                                        break;
                                }
                                if (Arr::accessible($residuo->SolResRM)) {
                                    if (Arr::isAssoc($residuo->SolResRM)) {
                                        $prefacturaResiduo->RMs = '{"a":array asociativo}';
                                    }else{
                                        $prefacturaResiduo->RMs = $residuo->SolResRM;
                                    }
                                    // $prefacturaResiduo->RMs = $residuo->SolResRM;
                                }else{
                                    $prefacturaResiduo->RMs = '{"a":no array}';
                                }
                                $prefacturaResiduo->FK_SolRespel = $residuo->ID_SolRes;
                                $prefacturaResiduo->save();

                                $prefacturaTratamiento->cantidad_tratamiento += $prefacturaResiduo->cantidad_respel;
                                $prefacturaTratamiento->Subtotal_tarifa_trat = $prefacturaResiduo->precio_tarifa;
                                $prefacturaTratamiento->Total_prefactratamiento += $prefacturaResiduo->subtotal_respel;
                                /* falta agrupar los numeros de los recibos de materiales ya que estan en formato string y puede dar error */
                                if (Arr::accessible($residuo->SolResRM)) {
                                    if (Arr::isAssoc($residuo->SolResRM)) {
                                        $prefacturaTratamiento->RMs = '{"a":array asociativo}';
                                    }else{
                                        $rmsprevios = json_decode($prefacturaTratamiento->RMs, true) ;
                                        $prefacturaTratamiento->RMs = json_encode(array_unique(Arr::collapse([$rmsprevios, $residuo->SolResRM])));
                                    }
                                }else{
                                    $prefacturaTratamiento->RMs = '{"a":no array}';
                                }
                                $prefacturaTratamiento->save();
                                /**actualizar los totales de la factura */
                                $prefactura->Subtotal_procesos += $prefacturaResiduo->subtotal_respel;
                                $prefactura->Total_prefactura += $prefacturaResiduo->subtotal_respel;
                                $prefactura->save();

                            }

                            break;

                        case 'Facturado':
                            $resCode = 400;
                            $res = 'la solicitud de servicio #'.$Solicitudorigin->ID_SolSer.' ya se encuentra Facturada';
                            break;

                        case 'Certificacion':
                            $resCode = 400;
                            $res = 'la solicitud de servicio #'.$Solicitudorigin->ID_SolSer.' ya se encuentra certificada y no admite cambios de status';
                            break;

                        default:
                            $resCode = 403;
                            $res = 'La solicitud de servicio #'.$Solicitudorigin->ID_SolSer.', aun no se puede facturar, ya que se encuentra en status de '.$Solicitudorigin->SolSerStatus;
                            break;
                    }
                    if ($resCode == 200) {

                        /*se guarda la observacion inicial de la creación del servicio*/
                        $Observacion = new Observacion();
                        $Observacion->ObsStatus = $Solicitudorigin->SolSerStatus;
                        if ($Solicitudorigin->SolSerDescript == "" || $Solicitudorigin->SolSerDescript == null) {
                            $Observacion->ObsMensaje = 'Servicio enviado a Facturación';
                        }else{
                            $Observacion->ObsMensaje = $Solicitudorigin->SolSerDescript;
                        }
                        $Observacion->ObsTipo = 'prosarc';
                        $Observacion->ObsRepeat = 1;
                        $Observacion->ObsDate = now();
                        $Observacion->ObsUser = Auth::user()->email;
                        $Observacion->ObsRol = Auth::user()->UsRol;
                        $Observacion->FK_ObsSolSer = $Solicitudorigin->ID_SolSer;
                        $Observacion->save();

                        // $email = DB::table('solicitud_servicios')
                        // 	->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                        // 	->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                        // 	->select('personals.PersEmail', 'solicitud_servicios.*', 'clientes.CliName', 'clientes.CliComercial')
                        // 	->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                        // 	->first();

                        // $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();

                        // if ($comercial) {
                        // 	$destinatarios = [$comercial->PersEmail];
                        // } else {
                        // 	$destinatarios = [];
                        // }


                        // $destinatarios = [$comercial->PersEmail];
                        // if ($Solicitud->SolServMailCopia == "null") {
                        //     Mail::to($email->PersEmail)
                        //     ->cc($destinatarios)
                        //     ->send(new SolSerEmail($email));
                        // }else{
                        //     foreach (json_decode($Solicitud->SolServMailCopia) as $key => $value) {
                        //         array_push($destinatarios, $value);
                        //     }
                        //     Mail::to($email->PersEmail)
                        //     ->cc($destinatarios)
                        //     ->send(new SolSerEmail($email));
                        // }
                    }
                    if ($Solicitudorigin->cliente->comercialAsignado->ID_Pers <> null) {
                        $comercial = Personal::where('ID_Pers', $Solicitudorigin->cliente->comercialAsignado->ID_Pers)->first();
                        $destinatarios = ['gestion@prosarc.com.co',
                        					'sistemas@prosarc.com.co',
                        					'subgerencia@prosarc.com.co',
                        					$comercial->PersEmail
                        				];
                        // $destinatarios = ['sistemas@prosarc.com.co'];
                    }else{
                        $comercial = "";
                        $destinatarios = ['gestion@prosarc.com.co',
                        					'sistemas@prosarc.com.co',
                        					'subgerencia@prosarc.com.co'
                        				];
                    }

                    $prefacturas = Prefactura::with(['cliente', 'comercial', 'servicio.programacionesrecibidas', 'prefacTratamiento.prefacresiduo'])->where('ID_Prefactura', $prefactura->ID_Prefactura)->get();

                    Mail::to($destinatarios)->send(new ServicioFacturado($prefacturas));
                    return response()->json([
                        'message' => $res,
                        'code' => $resCode,
                        'new_token' => csrf_token()],
                        $resCode);
                }
			}else{
				return response()->json(['error' => 'Usuario no autorizado'], 401);
			}


		}
	}

	/* envio de recordatorios via ajax*/
    public function sendRecordatorio(Request $request)
    {
		session()->regenerate();

        $Solicitud = SolicitudServicio::where('SolSerSlug', $request->input('solserslug'))->first(['ID_SolSer', 'SolSerStatus', 'SolSerDescript', 'SolSerSlug', 'SolServMailCopia']);
		if (!$Solicitud) {
			abort(404, 'No se encuentra el servicio');
        }
        if ($Solicitud->SolSerStatus != 'Completado') {
			abort(
				response()->json([
						'message' => 'El servicio NO está en status (COMPLETADO)',
						'newtoken' => csrf_token()
				], 403)
			);
		}

		$Solicitud->SolSerDescript = $request->input('solserdescript');
        $Solicitud->save();

        $conteoRecordatorio = Observacion::where('FK_ObsSolSer', $Solicitud->ID_SolSer)->where('ObsStatus', 'Recordatorio+')->get(['ObsStatus', 'ID_Obs']);

        /*se guarda la observación de la modificación del servicio*/
        $Observacion = new Observacion();
        $Observacion->ObsStatus = 'Recordatorio+';
        $Observacion->ObsMensaje = $Solicitud->SolSerDescript;
        $Observacion->ObsTipo = 'prosarc';
        if ($conteoRecordatorio->count() > 0) {
            $Observacion->ObsRepeat = $conteoRecordatorio->count() + 1;
        }else{
            $Observacion->ObsRepeat = 1;
        }
        $Observacion->ObsDate = now();
        $Observacion->ObsUser = Auth::user()->email;
        $Observacion->ObsRol = Auth::user()->UsRol;
        $Observacion->FK_ObsSolSer = $Solicitud->ID_SolSer;
        $Observacion->save();

        $log = new audit();
		$log->AuditTabla="observaciones";
		$log->AuditType="Add observacion";
		$log->AuditRegistro=$Observacion->ID_Obs;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=[$Solicitud->SolSerStatus, $Solicitud->SolSerDescript];
        $log->save();

        $email = DB::table('solicitud_servicios')
                        ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                        ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                        ->select('personals.PersEmail', 'personals.PersFirstName', 'personals.PersLastName', 'clientes.CliName', 'clientes.CliComercial', 'solicitud_servicios.*')
                        ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                        ->first();

        $comercial = Personal::where('ID_Pers', $email->CliComercial)->first('PersEmail');

        if ($comercial == null) {
            $comercial->PersEmail = 'subgerencia@prosarc.com.co';
        }

        $copy = ['recepcionpda@prosarc.com.co',
                    'conciliaciones@prosarc.com.co',
                    $comercial->PersEmail
                ];

        $recipient = [$email->PersEmail];

        if ($Solicitud->SolServMailCopia !== "null") {
            foreach (json_decode($Solicitud->SolServMailCopia) as $key => $value) {
                array_push($copy, $value);
            }
        }

		Mail::to($recipient)->cc($copy)->send(new ConcilacionRecordatorio($email, $Observacion));

		$Response['newtoken'] = csrf_token();
		$Response['Observacion'] = $Observacion;
		$Response['Solicitud'] = $Solicitud;
		$Response['ultimorecordatorio'] = \Carbon\Carbon::parse($Solicitud->ultimorecordatorio()->ObsDate)->diffForhumans();;
		$Response['message'] = 'recordatorio enviado correctamente';

		return response()->json($Response);

	}

		/*Funcion para certtificacion de servicios via ajax*/
	public function firmarCertificado(Request $request, $slug)
	{
		if ($request->ajax()) {
			/*indice de firmas */
			// 0:Pendiente
			// 1:Director Planta
			// 2:Jefe de Logistica
			// 3:Jefe de Operaciones
			// 4:Supervisor de Turno
			// 5:Ingeniero HSEQ
			// 6:Asistente de Logistica
			// 7:Programador
			$certificado = Certificado::with('SolicitudServicio')->where('CertSlug', $slug)->first();
			if ($certificado==null) {
				abort(404, 'Certificado no encontrado.');
			}
			if ($certificado->SolicitudServicio->SolSerStatus == 'Certificacion') {
				switch (Auth::user()->UsRol) {
					case 'Hseq':
						$certificado->CertAuthHseq = 5;
						break;

					case 'JefeOperaciones':
						$certificado->CertAuthJo = 3;
						break;

					case 'JefeLogistica':
						$certificado->CertAuthJl = 2;
						break;

					case 'AdministradorPlanta':
						($certificado->CertAuthDp == 0) ? $certificado->CertAuthDp = 1 : $certificado->CertAuthDp = 0;
						break;

					case 'Supervisor':
						if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
							# code...
						}else{
							if (($certificado->CertAuthDp == 4)||($certificado->CertAuthJl == 4)||($certificado->CertAuthJo == 4)) {
								$c=1;
							}else{
								$c=0;
							}
							if (($certificado->CertAuthDp == 0)&&($c<1)) {
								$certificado->CertAuthDp = 4;
								$c=$c+1;
							}
							if (($certificado->CertAuthJl == 0)&&($c<1)) {
								$certificado->CertAuthJl = 4;
								$c=$c+1;
							}
							if (($certificado->CertAuthJo == 0)&&($c<1)) {
								$certificado->CertAuthJo = 4;
								$c=$c+1;
							}
						}

						break;

					case 'AsistenteLogistica':
						if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
							# code...
						}else{
							if (($certificado->CertAuthDp == 6)||($certificado->CertAuthJl == 6)||($certificado->CertAuthJo == 6)) {
								$c=1;
							}else{
								$c=0;
							}
							if (($certificado->CertAuthDp == 0)&&($c<1)) {
								$certificado->CertAuthDp = 6;
								$c=$c+1;
							}
							if (($certificado->CertAuthJl == 0)&&($c<1)) {
								$certificado->CertAuthJl = 6;
								$c=$c+1;
							}
							if (($certificado->CertAuthJo == 0)&&($c<1)) {
								$certificado->CertAuthJo = 6;
								$c=$c+1;
							}
						}

						break;


					case 'Programador':
						if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
							# code...
						}else{
							if (($certificado->CertAuthDp == 7)||($certificado->CertAuthJl == 7)||($certificado->CertAuthJo == 7)) {
								$c=1;
							}else{
								$c=0;
							}
							if (($certificado->CertAuthDp == 0)&&($c<1)) {
								$certificado->CertAuthDp = 7;
								$c=$c+1;
							}
							if (($certificado->CertAuthJl == 0)&&($c<1)) {
								$certificado->CertAuthJl = 7;
								$c=$c+1;
							}
							if (($certificado->CertAuthJo == 0)&&($c<1)) {
								$certificado->CertAuthJo = 7;
								$c=$c+1;
							}
						}

						break;

					default:
						# code...
						break;
				}
			}else{
				switch (Auth::user()->UsRol) {
					case 'Hseq':
						($certificado->CertAuthHseq == 0) ? $certificado->CertAuthHseq = 5 : $certificado->CertAuthHseq = 0;
						break;

					case 'JefeOperaciones':
						($certificado->CertAuthJo == 0) ? $certificado->CertAuthJo = 3 : $certificado->CertAuthJo = 0;
						break;

					case 'JefeLogistica':
						($certificado->CertAuthJl == 0) ? $certificado->CertAuthJl = 2 : $certificado->CertAuthJl = 0;
						break;

					case 'AdministradorPlanta':
						($certificado->CertAuthDp == 0) ? $certificado->CertAuthDp = 1 : $certificado->CertAuthDp = 0;
						break;

					case 'Supervisor':
						if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
							# code...
						}else{
							if (($certificado->CertAuthDp == 4)||($certificado->CertAuthJl == 4)||($certificado->CertAuthJo == 4)) {
								$c=1;
							}else{
								$c=0;
							}
							if (($certificado->CertAuthDp == 0)&&($c<1)) {
								$certificado->CertAuthDp = 4;
								$c=$c+1;
							}
							if (($certificado->CertAuthJl == 0)&&($c<1)) {
								$certificado->CertAuthJl = 4;
								$c=$c+1;
							}
							if (($certificado->CertAuthJo == 0)&&($c<1)) {
								$certificado->CertAuthJo = 4;
								$c=$c+1;
							}
						}

						break;

					case 'AsistenteLogistica':
						if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
							# code...
						}else{
							if (($certificado->CertAuthDp == 6)||($certificado->CertAuthJl == 6)||($certificado->CertAuthJo == 6)) {
								$c=1;
							}else{
								$c=0;
							}
							if (($certificado->CertAuthDp == 0)&&($c<1)) {
								$certificado->CertAuthDp = 6;
								$c=$c+1;
							}
							if (($certificado->CertAuthJl == 0)&&($c<1)) {
								$certificado->CertAuthJl = 6;
								$c=$c+1;
							}
							if (($certificado->CertAuthJo == 0)&&($c<1)) {
								$certificado->CertAuthJo = 6;
								$c=$c+1;
							}
						}

						break;


					case 'Programador':
						if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
							# code...
						}else{
							if (($certificado->CertAuthDp == 7)||($certificado->CertAuthJl == 7)||($certificado->CertAuthJo == 7)) {
								$c=1;
							}else{
								$c=0;
							}
							if (($certificado->CertAuthDp == 0)&&($c<1)) {
								$certificado->CertAuthDp = 7;
								$c=$c+1;
							}
							if (($certificado->CertAuthJl == 0)&&($c<1)) {
								$certificado->CertAuthJl = 7;
								$c=$c+1;
							}
							if (($certificado->CertAuthJo == 0)&&($c<1)) {
								$certificado->CertAuthJo = 7;
								$c=$c+1;
							}
						}

						break;

					default:
						# code...
						break;
				}
			}

			$certificado->save();

			$log = new audit();
			$log->AuditTabla="certificado";
			$log->AuditType="firmado";
			$log->AuditRegistro=$certificado->ID_Cert;
			$log->AuditUser=Auth::user()->email;
			$log->Auditlog=json_encode($slug);
			$log->save();

			if ($certificado->CertAuthJo != 0 && $certificado->CertAuthJl != 0 && $certificado->CertAuthDp != 0 ) {
				$servicio = SolicitudServicio::where('ID_SolSer', $certificado->FK_CertSolser)->first();
				$cliente = Cliente::where('ID_Cli', $servicio->FK_SolSerCliente)->first();
				// se verifica si el cliente tiene comercial asignado
				if ($cliente->CliComercial <> null) {
					$comercial = Personal::where('ID_Pers', $cliente->CliComercial)->first();
					// se establece la lista de destinatarios
					$destinatariosComercial = [$comercial->PersEmail];
					Mail::to($destinatariosComercial)->send(new CertUpdatedComercial($certificado, $servicio, $cliente));
				}
			}

			$Response['newtoken'] = csrf_token();
			$Response['Solicitud'] = $certificado->SolicitudServicio;
			$Response['Documento'] = $certificado;
			$Response['message'] = 'Documento aprobado por '.Auth::user()->email;

			return response()->json($Response);
		}
	}

	/*Funcion para ver los residuos de una sede de generador segun el cliente*/
	public function clienteExpressResiduos(Request $request, $slug){
		if ($request->ajax()){
			$Cliente = Cliente::where('CliSlug', $slug)->first();
			$Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();
			$generador = Generador::where('FK_GenerCli', $Sede->ID_Sede)->first();
			$sGener = GenerSede::with(['resgener.respels'])->where('FK_GSede', $generador->ID_Gener)->first();

			$Respels = DB::table('residuos_geners')
				->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
				->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
				->join('requerimientos', 'requerimientos.FK_ReqRespel', '=', 'respels.ID_Respel')
				->select('gener_sedes.*', 'residuos_geners.SlugSGenerRes', 'respels.RespelName', 'respels.RespelSlug', 'respels.ID_Respel', 'requerimientos.FK_ReqTrata', 'requerimientos.forevaluation', 'requerimientos.ofertado')
				->whereIn('respels.RespelStatus', ['Aprobado', 'Revisado', 'Falta TDE', 'TDE actualizada', 'Vencido'])
				->where('respels.RespelDelete', 0)
				->where('gener_sedes.GSedeSlug', $sGener->GSedeSlug)
				->where('residuos_geners.DeleteSGenerRes', '=', 0)
				->where('requerimientos.forevaluation', 1)
				->where('requerimientos.ofertado', 1)
				->get();

			foreach ($Respels as $key => $value) {
				if (isset($Respels[$key]->FK_ReqTrata) && $Respels[$key]->ofertado == 1) {
					$tratamiento = Tratamiento::where('ID_Trat', $Respels[$key]->FK_ReqTrata)->first('TratName');
					if (isset($tratamiento->TratName)) {
						$Respels[$key]->TratName = $tratamiento->TratName;
					}else{
						$Respels[$key]->TratName = '';
					}
				}else{
					$Respels[$key]->TratName = '';
				}
			}
				return response()->json($Respels);
		}
	}
	/*Funcion para ver por medio de Ajax los Municipios que le competen a un Departamento*/
	public function renewTokenAfterError(Request $request)
	{
		$response = "";
		if ($request->ajax()) {
			$response = csrf_token();
		}
		return response()->json($response);
	}
}
