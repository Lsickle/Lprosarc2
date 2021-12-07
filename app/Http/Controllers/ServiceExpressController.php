<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SolServStoreRequest;
use App\Http\Requests\StoreServExpressRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\userController;
use App\Http\Controllers\SolicitudResiduoController;
use App\Mail\NewSolServEmail;
use App\Mail\SolSerLeftRespel;
use App\Mail\NewSolServProsarcEmail;
use App\Mail\SolSerExpressEmail;
use App\Mail\CertExpressRetenidoEmail;
use App\Mail\SolSerExpressConciliado;
use App\Mail\SolSerExpressRecibo;
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
use App\CertificadoExpress;
use App\CertExpressdato;
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
use App\ReciboDePago;
use Permisos;
use PDF;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;

class ServiceExpressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // check user  email
        $user = Auth::user();
        $user_email = $user->email;

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
			'clientes.ID_Cli',
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
				if(in_array(Auth::user()->UsRol, Permisos::COMERCIALES) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALES)){
					if(!in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
						$query->where('Comercial.ID_Pers', Auth::user()->FK_UserPers);
					}
				}
			})
            ->where(function($query) use ($user_email){
				if($user_email !== 'Sistemas@prosarc.com.co'){
                    $query->where('solicitud_servicios.SolSerDelete', 0);
                }
			})
			->where('CliCategoria', 'ClientePrepago')
			->orderBy('created_at', 'desc')
			->get();
		foreach ($Servicios as $servicio) {
			$sedeExpress = Sede::where('FK_SedeCli',$servicio->ID_Cli)->first();
			// $servicio->SolSerCollectAddress = $sedeExpress->SedeAddress;
			$servicio->FK_SedeMun = $sedeExpress->FK_SedeMun;
			$servicio->SedeMapLocalidad = $sedeExpress->SedeMapLocalidad;
			$servicio->SedeMapLat = $sedeExpress->SedeMapLat;
			$servicio->SedeMapLong = $sedeExpress->SedeMapLong;


			/* validacion para encontrar la fecha de recepción en planta del servicio */
			$fechaRecepcion = SolicitudServicio::find($servicio->ID_SolSer)->programacionesrecibidas()->first();
			if($fechaRecepcion){
				$servicio->recepcion = $fechaRecepcion->ProgVehSalida;
			}else{
				$servicio->recepcion = null;
			}

			$servicio->totalrerspel = SolicitudServicio::find($servicio->ID_SolSer)->SolicitudResiduo()->get('SolResKgConciliado')->sum('SolResKgConciliado');
		}
		// return $Servicios;
		return view('serviciosexpress.indexprosarc', compact('Servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(in_array(Auth::user()->UsRol, Permisos::COMERCIALEXPRESS) || in_array(Auth::user()->UsRol, Permisos::COMERCIALEXPRESS)){

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
    public function store(StoreServExpressRequest $request)
    {
		// return $request;

        //sede segun input

        $sede = Sede::where('SedeSlug', $request->input('SedeSlug'))->first();

		$Cliente = Cliente::where('ID_Cli', $sede->FK_SedeCli)->first();

        $file = $request->file('pagoComprobante');

        switch ($file->getClientOriginalExtension()) {
            case 'pdf':
            case 'png':
            case 'jpg':
            case 'jpeg':
            case 'jpe':
                $foldername = $Cliente->CliNit;
                $foldername = str_replace('.', '', $foldername);
                $foldername = str_replace(' ', '_', $foldername);
                $foldername = str_replace('(', '_', $foldername);
                $foldername = str_replace(')', '_', $foldername);
                $foldername = str_replace('__', '_', $foldername);

                $fileName = $request->input('Referencia');
                $fileName = str_replace('.', '', $fileName);
                $fileName = str_replace(' ', '_', $fileName);
                $fileName = str_replace('(', '_', $fileName);
                $fileName = str_replace(')', '_', $fileName);
                $fileName = str_replace('__', '_', $fileName);
                $fileName = time().$fileName;

                // Storage::put('comprobantes/'.$fileName.$file->getClientOriginalExtension(), $file, 'public');
                $filePath = $file->storeAs('comprobantes/'.$foldername.'/', $fileName.'.'.$file->getClientOriginalExtension(), 'public');
                break;

            default:
                abort(422, 'El archivo debe estar de un formato permitido png, jpg o pdf');
                break;
        }
        // return $filePath;

        // generar el registro para el recibo de pago
        $recibo = new ReciboDePago();
        $recibo->fecha_de_pago = $request->input('fechadepago');
        $recibo->monto = $request->input('montodepago');
        $recibo->referencia = $request->input('Referencia');
        $recibo->medio_de_pago = $request->input('mediodepago');
        $recibo->observacion = $request->input('SolSerDescript');
        $recibo->url_comprobante = $filePath;
        $recibo->url_recibo = '';
        $recibo->FK_ReciboCliente = $Cliente->ID_Cli;
        $recibo->ReciboSlug = hash('md5', rand().time().$recibo->Referencia);
        $recibo->save();

        /**crear el pdf de recibo */

        $qrCode = new QrCode(route('recibosdepago.show', ['reciboDePago' => $recibo->ReciboSlug]));
		$qrCode->setLogoPath(asset('img/LogoQR.png'));
		$qrCode->setLogoSize(60, 60);
		$qrCode->setSize(300);
		$qrCode->setMargin(0);
		$qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_SHRINK);

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('recibos.recibotopdf', compact(['recibo','Cliente','qrCode','sede']));
        Storage::put('recibosdepago/'.$foldername.'/RP-'.sprintf("%07s", $recibo->ID_Recibo).'.pdf', $pdf->output(), 'public');

        $recibo->url_recibo = 'recibosdepago/'.$foldername.'/RP-'.sprintf("%07s", $recibo->ID_Recibo).'.pdf';
        $recibo->save();

        // return $request;


		$Persona = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->select('personals.*')
				->where('sedes.ID_Sede', $sede->ID_Sede)
				->where('personals.PersDelete', 0)
				->first();

		for ($i=0; $i < $request->input('SolServCantidad'); $i++) {
			$SolicitudServicio = new SolicitudServicio();
			$SolicitudServicio->SolSerStatus = 'Aprobado';
			$SolicitudServicio->SolSerAuditable = 0;
			$SolicitudServicio->SolResAuditoriaTipo = "No Auditable";
            $SolicitudServicio->SolSerSupport = 'comprobantes/'.$foldername.'/'.$fileName.'.'.$file->getClientOriginalExtension();
			$SolicitudServicio->SolSerTipo = "Interno";
			$SolicitudServicio->SolSerNameTrans = 'Prosarc S.A. ESP.';
			$SolicitudServicio->SolSerNitTrans = '900.079.188-0';
			$SolicitudServicio->SolSerAdressTrans = 'KM 6 VÍA LA MESA SUB ESTACIÓN BALSILLAS';
			$SolicitudServicio->SolSerCityTrans = 584;
			$SolicitudServicio->SolSerConductor = null;
			$SolicitudServicio->SolSerVehiculo = null;
			$SolicitudServicio->SolSerDescript = 'Frecuencia:'.$request->input('SolServFrecuencia').'  '.$request->input('SolSerDescript');
			$SolicitudServicio->SolSerTypeCollect = 99;
			$SolicitudServicio->SolSerCollectAddress = $sede->SedeAddress;
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
			$SolicitudServicio->FK_ReciboSolserv = $recibo->ID_Recibo;
			$SolicitudServicio->save();
            if ($request->input('SolServTypeRecolection') == 'Especifica') {
                $this->createSolRes($request, $SolicitudServicio->ID_SolSer);
            }else{
                $this->addAllRespels($SolicitudServicio);
            }

			/*se guarda la observacion inicial de la creación del servicio*/
			$Observacion = new Observacion();
			$Observacion->ObsStatus = $SolicitudServicio->SolSerStatus;
			$Observacion->ObsMensaje = 'Recibo:'.$recibo->ID_Recibo.' '.$SolicitudServicio->SolSerDescript;
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
			$destinatarios = ['coordinadorse@prosarc.com.co',
								$comercial->PersEmail
							];
		}else{
			$comercial = "";
			$destinatarios = ['coordinadorse@prosarc.com.co'];
		}
		$SolicitudServicio['comercial'] = $comercial;
		$SolicitudServicio['personalcliente'] = Personal::where('ID_Pers', $SolicitudServicio->FK_SolSerPersona)->first();
		// se envia un correo por personal interesado
		// Mail::to($sede->SedeEmail)->cc($destinatarios)->send(new NewSolServEmail($SolicitudServicio));
        // se envia correo al cliente con el recibo de pado
        Mail::to($sede->SedeEmail)->cc($destinatarios)->send(new SolSerExpressRecibo($pdf, $recibo, $comercial, $Cliente, $sede));
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
			->select('solicitud_servicios.*','personals.PersFirstName','personals.PersLastName', 'personals.PersEmail', 'personals.PersCellphone')
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

            case 'Aprobado':
				setlocale(LC_ALL, "es_CO.UTF-8");
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
                $Programacion = ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)->where('ProgVehDelete', 0)->first();
				if(date('H', strtotime($Programacion->ProgVehSalida)) >= 12){
					$horas = " en las horas de la tarde";
				}
				else{
					$horas = " en las horas de la mañana";
				}
				$ProgramacionesActivas = count(ProgramacionVehiculo::where('FK_ProgServi', $SolicitudServicio->ID_SolSer)
				->where('ProgVehEntrada', null)
				->where('ProgVehDelete', 0)
				->get());
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
        switch ($SolicitudServicio->SolSerStatus) {
            case 'Aprobado':
                return view('serviciosexpress.show', compact('SolicitudServicio','Residuos', 'GenerResiduos', 'Cliente', 'SolSerCollectAddress', 'SolSerConductor', 'TextProgramacion', 'ProgramacionesActivas', 'Municipio', 'Programaciones', 'total', 'cantidadesXtratamiento', 'tratamientos', 'Observaciones'));
                break;

                default:
                return view('serviciosexpress.show', compact('SolicitudServicio','Residuos', 'GenerResiduos', 'Cliente', 'SolSerCollectAddress', 'SolSerConductor', 'TextProgramacion', 'ProgramacionesActivas', 'Programacion','Municipio', 'Programaciones', 'total', 'cantidadesXtratamiento', 'tratamientos', 'Observaciones'));
                break;
        }

    }

	public function changestatus(Request $request)
	{
		$Solicitud = SolicitudServicio::where('SolSerSlug', $request->input('solserslug'))->first();
		if (!$Solicitud) {
			abort(404);
		}
		if ($Solicitud->SolSerStatus <> 'Certificacion') {
			if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
				if ($Solicitud->SolSerStatus == 'Completado' || $Solicitud->SolSerStatus == 'Corregido') {
					if($request->input('solserstatus') == 'No Deacuerdo'){
						$Solicitud->SolSerStatus = 'No Conciliado';
					}
					if($request->input('solserstatus') == 'Conciliada'){
						$Solicitud->SolSerStatus = 'Conciliado';
					}
				} else {
					if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
						abort(403, 'el servicio no esta habilitado para la conciliación de pesos');
					}
				}
			}

			if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) || in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC)){
				switch ($request->input('solserstatus')) {
					case 'Aprobada':
						if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2 ) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2 )){
							$Solicitud->SolSerStatus = 'Aprobado';
						}
						break;
					case 'Aceptada':
						if(in_array(Auth::user()->UsRol, Permisos::SOLSERACEPTADO) || in_array(Auth::user()->UsRol2, Permisos::SOLSERACEPTADO)){
							$Solicitud->SolSerStatus = 'Aceptado';
						}
						break;
					case 'Recibida':
						if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1)){
							$Solicitud->SolSerStatus = 'Completado';
						}
						break;
					case 'Residuo Faltante':
						if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1)){
							$Solicitud->SolSerStatus = 'Residuo Faltante';
						}
						break;
					case 'Conciliación':
						if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2)){
							$Solicitud->SolSerStatus = 'Corregido';
						}
						break;
					case 'Tratada':
						if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1)){
							$Solicitud->SolSerStatus = 'Tratado';
						}
						break;
					case 'Conciliada':
						if(in_array(Auth::user()->UsRol, Permisos::ADMINPLANTA) || in_array(Auth::user()->UsRol2, Permisos::ADMINPLANTA)){
							$Solicitud->SolSerStatus = 'Conciliado';
						}
						if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOREXPRESS ) || in_array(Auth::user()->UsRol2, Permisos::CONDUCTOREXPRESS )){
							$Solicitud->SolSerStatus = 'Conciliado';
						}
						break;
					case 'Certificada':
						if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi)){
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

							// return redirect()->route('serviciosexpress.index');
							$slug = $Solicitud->SolSerSlug;
							return redirect()->route('email-solser', compact('slug'));

						}
						break;
					case 'Facturada':
						if(in_array(Auth::user()->UsRol, Permisos::COMERCIALES) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALES)){
							$Solicitud->SolSerStatus = 'Facturado';
						}
						break;
				}
			}
		}else{
			abort(403, 'el servicio ya ha sido certificado y no admite cambios de status');
		}
		$Solicitud->SolSerDescript = $request->input('solserdescript');
		$Solicitud->save();

		if ($Solicitud->SolSerStatus == 'Conciliado') {
			$this->solservdocstore($Solicitud->ID_SolSer);
		}

		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="Modificado Status";
		$log->AuditRegistro=$Solicitud->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=[$Solicitud->SolSerStatus, $Solicitud->SolSerDescript];
		$log->save();


		/*se guarda la observacion de la modificacion del servicio*/
		$Observacion = new Observacion();
		$Observacion->ObsStatus = $Solicitud->SolSerStatus;
		$Observacion->ObsMensaje = $Solicitud->SolSerDescript;
		switch ($Solicitud->SolSerStatus) {
			case 'Aprobado':
				$Observacion->ObsTipo = 'cliente';
				break;

			case 'Programado':
				$Observacion->ObsTipo = 'prosarc';
				break;

			case 'Notificado':
				$Observacion->ObsTipo = 'prosarc';
				break;

			case 'Completado':
				$Observacion->ObsTipo = 'prosarc';
				break;

			case 'Conciliado':
				if (in_array(Auth::user()->UsRol, Permisos::CONDUCTOREXPRESS) || in_array(Auth::user()->UsRol2, Permisos::CONDUCTOREXPRESS)) {
					$Observacion->ObsTipo = 'prosarc';
				}else{
					$Observacion->ObsTipo = 'cliente';
				}
				break;

			case 'No Conciliado':
				$Observacion->ObsTipo = 'cliente';
				break;

			case 'Tratado':
				$Observacion->ObsTipo = 'prosarc';
				break;

			case 'Certificacion':
				$Observacion->ObsTipo = 'prosarc';
				break;

			case 'Corregido':
				$Observacion->ObsTipo = 'prosarc';
				break;

			case 'Residuo Faltante':
				$Observacion->ObsTipo = 'prosarc';
				break;

			case 'Facturado':
				$Observacion->ObsTipo = 'prosarc';
				break;

			default:
			$Observacion->ObsTipo = 'prosarc';
				break;
		}
		$Observacion->ObsRepeat = 1;
		$Observacion->ObsDate = now();
		$Observacion->ObsUser = Auth::user()->email;
		$Observacion->ObsRol = Auth::user()->UsRol;
		$Observacion->FK_ObsSolSer = $Solicitud->ID_SolSer;
		$Observacion->save();

		switch($Solicitud->SolSerStatus){
			case 'Tratado':
			case 'Facturado':
				return redirect()->route('serviciosexpress.show', ['id' => $Solicitud->SolSerSlug]);
				break;
			case 'Aceptado':
				return redirect()->route('serviciosexpress.index');
				break;
			default:
				$slug = $Solicitud->SolSerSlug;
				return redirect()->route('email-solser', compact('slug'));
		}
	}

	public function repeat(Request $request, $slug)
	{
		$SolicitudOld = SolicitudServicio::where('SolSerSlug', $slug)->first();
		if (!$SolicitudOld) {
			abort(404, 'la solicitud que esta tratando de repetir no se encuentra en la base de datos');
		}

		$Cliente = Cliente::where('ID_Cli', $SolicitudOld->FK_SolSerCliente)->first();
        $Requerimiento = RequerimientosCliente::where('FK_RequeClient', $Cliente->ID_Cli)->first();

		if(!is_null($SolicitudOld)){
				$SolResOlds = SolicitudResiduo::where('FK_SolResSolSer', $SolicitudOld->ID_SolSer)->get();
				$SolicitudNew = new SolicitudServicio();
				$SolicitudNew->SolSerStatus = 'Aprobado';
				$SolicitudNew->SolSerAuditable = $SolicitudOld->SolSerAuditable;
				$SolicitudNew->SolResAuditoriaTipo = $SolicitudOld->SolResAuditoriaTipo;
				$SolicitudNew->SolSerTipo = $SolicitudOld->SolSerTipo;
				$SolicitudNew->SolSerNameTrans = $SolicitudOld->SolSerNameTrans;
				$SolicitudNew->SolSerNitTrans = $SolicitudOld->SolSerNitTrans;
				$SolicitudNew->SolSerAdressTrans = $SolicitudOld->SolSerAdressTrans;
				$SolicitudNew->SolSerCityTrans = $SolicitudOld->SolSerCityTrans;
				$SolicitudNew->SolSerConductor = $SolicitudOld->SolSerConductor;
				$SolicitudNew->SolSerVehiculo = $SolicitudOld->SolSerVehiculo;
				$SolicitudNew->SolSerTypeCollect = $SolicitudOld->SolSerTypeCollect;
				$SolicitudNew->SolSerCollectAddress = $SolicitudOld->SolSerCollectAddress;
				if ($Requerimiento->RequeCliBascula==0) {
					$SolicitudNew->SolSerBascula = 0;
				}else{
					$SolicitudNew->SolSerBascula = $SolicitudOld->SolSerBascula;
				}

				if ($Requerimiento->RequeCliCapacitacion==0) {
					$SolicitudNew->SolSerCapacitacion = 0;
				}else{
					$SolicitudNew->SolSerCapacitacion = $SolicitudOld->SolSerCapacitacion;
				}

				if ($Requerimiento->RequeCliMasPerson==0) {
					$SolicitudNew->SolSerMasPerson = 0;
				}else{
					$SolicitudNew->SolSerMasPerson = $SolicitudOld->SolSerMasPerson;
				}

				if ($Requerimiento->RequeCliVehicExclusive==0) {
					$SolicitudNew->SolSerVehicExclusive = 0;
				}else{
					$SolicitudNew->SolSerVehicExclusive = $SolicitudOld->SolSerVehicExclusive;
				}

				if ($Requerimiento->RequeCliPlatform==0) {
					$SolicitudNew->SolSerPlatform = 0;
				}else{
					$SolicitudNew->SolSerPlatform = $SolicitudOld->SolSerPlatform;
				}
				$SolicitudNew->SolSerDevolucion = $SolicitudOld->SolSerDevolucion;
				$SolicitudNew->SolSerDevolucionTipo = $SolicitudOld->SolSerDevolucionTipo;
				$SolicitudNew->FK_SolSerPersona = $SolicitudOld->FK_SolSerPersona;
				$SolicitudNew->FK_SolSerCliente = $SolicitudOld->FK_SolSerCliente;
				$SolicitudNew->SolServMailCopia = $SolicitudOld->SolServMailCopia;
				$SolicitudNew->SolSerSlug = hash('sha256', rand().time().$SolicitudNew->SolSerNameTrans);
				$SolicitudNew->SolSerDelete = 0;
				$SolicitudNew->SolSerDescript = $request->input('solserdescript');
				$SolicitudNew->save();

				foreach ($SolResOlds as $SolResOld) {
					$SolResNew = new SolicitudResiduo();
					$SolResNew->SolResKgEnviado = $SolResOld->SolResKgEnviado;
					$SolResNew->SolResKgRecibido = 0;
					$SolResNew->SolResKgConciliado = 0;
					$SolResNew->SolResKgTratado = 0;
					$SolResNew->SolResDelete = 0;
					$SolResNew->SolResTypeUnidad = $SolResOld->SolResTypeUnidad;
					$SolResNew->SolResCantiUnidad = $SolResOld->SolResCantiUnidad;
					$SolResNew->SolResEmbalaje = $SolResOld->SolResEmbalaje;
					$SolResNew->SolResAlto = $SolResOld->SolResAlto;
					$SolResNew->SolResAncho = $SolResOld->SolResAncho;
					$SolResNew->SolResProfundo = $SolResOld->SolResProfundo;
					$SolResNew->SolResSlug = hash('sha256', rand().time().$SolResNew->SolResKgEnviado);
					$SolResNew->FK_SolResRg = $SolResOld->FK_SolResRg;
					$SolResNew->FK_SolResSolSer = $SolicitudNew->ID_SolSer;
					/*se verifica el requerimiento actualmente ofertado para el residuo*/
					$respelgener= ResiduosGener::find($SolResOld->FK_SolResRg);

					$requerimientoOfertado = Requerimiento::with(['pretratamientosSelected'])
						->where('FK_ReqRespel', '=', $respelgener->FK_Respel)
						->where('ofertado', '=', 1)
						->where('forevaluation', '=', 1)
						->first();

					if ($requerimientoOfertado == null) {
						$SolicitudNew->delete();

						$log = new audit();
						$log->AuditTabla="solicitud_servicios";
						$log->AuditType="repetir fallido";
						$log->AuditRegistro=$SolicitudNew->ID_SolSer;
						$log->AuditUser=Auth::user()->email;
						$log->Auditlog=$SolicitudNew;
						$log->save();

						abort(404, 'el servicio no se puede repetir debido a que alguno de los residuos no posee tratamiento ofertado, Verifique con su asesor Comercial');
					}
					if ($requerimientoOfertado->ReqFotoDescargue==0) {
						$SolResNew->SolResFotoDescargue_Pesaje = 0;
					}else{
						$SolResNew->SolResFotoDescargue_Pesaje = $SolResOld->SolResFotoDescargue_Pesaje;
					}

					if ($requerimientoOfertado->ReqFotoDestruccion==0) {
						$SolResNew->SolResFotoTratamiento = 0;
					}else{
						$SolResNew->SolResFotoTratamiento = $SolResOld->SolResFotoTratamiento;
					}

					if ($requerimientoOfertado->ReqVideoDescargue==0) {
						$SolResNew->SolResVideoDescargue_Pesaje = 0;
					}else{
						$SolResNew->SolResVideoDescargue_Pesaje = $SolResOld->SolResVideoDescargue_Pesaje;
					}

					if ($requerimientoOfertado->ReqVideoDestruccion==0) {
						$SolResNew->SolResVideoTratamiento = 0;
					}else{
						$SolResNew->SolResVideoTratamiento = $SolResOld->SolResVideoTratamiento;
					}

					if ($requerimientoOfertado->ReqDevolucion==0) {
						$SolResNew->SolResDevolucion = 0;
					}else{
						$SolResNew->SolResDevolucion = $SolResOld->SolResDevolucion;
					}

					if ($requerimientoOfertado->ReqAuditoria==0) {
						$SolResNew->SolResAuditoria = 0;
					}else{
						$SolResNew->SolResAuditoria = $SolResOld->SolResAuditoria;
					}
					$SolResNew->SolResVideoTratamiento = $SolResOld->SolResVideoTratamiento;
					$SolResNew->SolResDevolucion = $SolResOld->SolResVideoTratamiento;
					$SolResNew->SolResDevolCantidad = $SolResOld->SolResVideoTratamiento;
					$SolResNew->SolResAuditoria = $SolResOld->SolResVideoTratamiento;
					$SolResNew->SolResAuditoriaTipo = $SolResOld->SolResVideoTratamiento;
					/*se verifica los requerimientos y pretratamientos seleccionados para copiarlos*/

					$nuevorequerimiento = $requerimientoOfertado->replicate();
					$nuevorequerimiento->ReqSlug= hash('md5', rand().time().$respelgener->FK_Respel);
					$nuevorequerimiento->forevaluation=0;
					$nuevorequerimiento->ofertado=0;
					$nuevorequerimiento->save();
					$nuevorequerimiento->pretratamientosSelected()->attach($requerimientoOfertado['pretratamientosSelected']);

					$tarifaparacopiar = Tarifa::with(['rangos'])
					->where('FK_TarifaReq', $requerimientoOfertado->ID_Req)->first();
					$nuevatarifa = $tarifaparacopiar->replicate();
					$nuevatarifa->FK_TarifaReq=$nuevorequerimiento->ID_Req;
					$nuevatarifa->save();

					foreach ($tarifaparacopiar->rangos as $rango) {
						$rangoparacopiar = Rango::find($rango->ID_Rango);
						$nuevarango = $rangoparacopiar->replicate();
						$nuevarango->FK_RangoTarifa = $nuevatarifa->ID_Tarifa;
						$nuevarango->save();
					}
					$SolResNew->FK_SolResRequerimiento = $nuevorequerimiento->ID_Req;
					$SolResNew->save();
				}

			$SolicitudServicio = $SolicitudNew;

			if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
				/*se guarda la observacion inicial del servicio repetido*/
				$Observacion = new Observacion();
				$Observacion->ObsStatus = $SolicitudServicio->SolSerStatus;
				$Observacion->ObsMensaje = $SolicitudServicio->SolSerDescript;
				$Observacion->ObsTipo = 'cliente';
				$Observacion->ObsRepeat = 1;
				$Observacion->ObsDate = now();
				$Observacion->ObsUser = Auth::user()->email;
				$Observacion->ObsRol = Auth::user()->UsRol;
				$Observacion->FK_ObsSolSer = $SolicitudServicio->ID_SolSer;
				$Observacion->save();

			} else {

				/* se incluye la primera observacion del cliente del servicio original */
				$observacionOriginal = Observacion::where('FK_ObsSolSer', $SolicitudOld->ID_SolSer)->first();
				/*se guarda la observacion inicial del servicio repetido*/
				$Observacion = new Observacion();
				$Observacion->ObsStatus = $observacionOriginal->ObsStatus;
				$Observacion->ObsMensaje = $observacionOriginal->ObsMensaje;
				$Observacion->ObsTipo = $observacionOriginal->ObsTipo;
				$Observacion->ObsRepeat = 1;
				$Observacion->ObsDate = $observacionOriginal->ObsDate;
				$Observacion->ObsUser = $observacionOriginal->ObsUser;
				$Observacion->ObsRol = $observacionOriginal->ObsRol;
				$Observacion->FK_ObsSolSer = $SolicitudServicio->ID_SolSer;
				$Observacion->save();


				/*se guarda la observacion inicial del servicio repetido*/
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


						// se verifica si el cliente tiene comercial asignado
			$SolicitudServicio['cliente'] = Cliente::where('ID_Cli', $SolicitudNew->FK_SolSerCliente)->first();
			// se establece la lista de destinatarios
			if ($SolicitudServicio['cliente']->CliComercial <> null) {
				$comercial = Personal::where('ID_Pers', $SolicitudServicio['cliente']->CliComercial)->first();
				$destinatarios = ['dirtecnica@prosarc.com.co',
									'logistica@prosarc.com.co',
									'asistentelogistica@prosarc.com.co',
									'auxiliarlogistico@prosarc.com.co',
									'gerenteplanta@prosarc.com.co',
									'subgerencia@prosarc.com.co',
									$comercial->PersEmail
								];
			}else{
				$comercial = "";
				$destinatarios = ['dirtecnica@prosarc.com.co',
									'logistica@prosarc.com.co',
									'asistentelogistica@prosarc.com.co',
									'auxiliarlogistico@prosarc.com.co',
									'gerenteplanta@prosarc.com.co',
									'subgerencia@prosarc.com.co'
								];
			}

			$SolicitudServicio['comercial'] = $comercial;
			$SolicitudServicio['personalcliente'] = Personal::where('ID_Pers', $SolicitudNew->FK_SolSerPersona)->first();

			if ($SolicitudServicio->SolServMailCopia != "null") {
				foreach (json_decode($SolicitudServicio->SolServMailCopia) as $key => $value) {
					array_push($destinatarios, $value);
				}
			}

			if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
				Mail::to($SolicitudServicio['personalcliente']->PersEmail)->cc($destinatarios)->send(new NewSolServEmail($SolicitudServicio));
			}else{
				Mail::to($SolicitudServicio['personalcliente']->PersEmail)->cc($destinatarios)->send(new NewSolServProsarcEmail($SolicitudServicio));
			}

			return redirect()->route('serviciosexpress.show', ['id' => $SolicitudNew->SolSerSlug]);
		}
		else{
			abort(404, 'la solicitud que esta tratando de repetir no se encuentra en la base de datos');
		}
	}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
			$Solicitud = SolicitudServicio::where('SolSerSlug', $id)->first();
			if (!$Solicitud) {
				abort(404);
			}
			if($Solicitud->SolSerStatus === 'Tratado' || $Solicitud->SolSerStatus === 'Certificacion' || $Solicitud->SolSerStatus === 'Completado'){
				abort(403);
			}
			if($Solicitud->SolSerCityTrans <> null){
				$Municipio = Municipio::select('FK_MunCity')->where('ID_Mun', $Solicitud->SolSerCityTrans)->first();
				$Departamento = Departamento::where('ID_Depart', $Municipio->FK_MunCity)->first();
				$Municipios = Municipio::where('FK_MunCity', $Departamento->ID_Depart)->get();
			}
			if($Solicitud->FK_SolSerCollectMun <> null){
				$Municipio2 = Municipio::select('FK_MunCity')->where('ID_Mun', $Solicitud->FK_SolSerCollectMun)->first();
				$Departamento2 = Departamento::where('ID_Depart', $Municipio2->FK_MunCity)->first();
				$Municipios2 = Municipio::where('FK_MunCity', $Departamento2->ID_Depart)->get();
			}
			$Departamentos = Departamento::all();
			$Cliente = Cliente::where('ID_Cli', $Solicitud->FK_SolSerCliente)->first();
            $Requerimientos = RequerimientosCliente::where('FK_RequeClient', $Cliente->ID_Cli)->get();
			$Sedes = Sede::select('SedeSlug','SedeName', 'ID_Sede')->where('FK_SedeCli', $Cliente->ID_Cli)->get();
			$SGeneradors = DB::table('gener_sedes')
				->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
				->join('sedes', 'generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('gener_sedes.GSedeSlug', 'gener_sedes.GSedeName', 'generadors.GenerName')
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
				->select('personals.PersSlug', 'personals.PersFirstName', 'personals.PersLastName', 'personals.PersEmail')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->where('personals.PersDelete', 0)
				->get();
			$KGenviados = DB::table('solicitud_residuos')
				->select('SolResKgEnviado')
				->where('FK_SolResSolSer', $Solicitud->ID_SolSer)
				->get();
			$totalenviado = 0;
			foreach ($KGenviados as $KGenviado) {
				$totalenviado = $totalenviado + $KGenviado->SolResKgEnviado;
			}
			return view('serviciosexpress.edit', compact('Solicitud','Cliente','Persona','Personals','Departamentos','SGeneradors', 'Departamento','Municipios', 'Departamento2','Municipios2', 'Sedes', 'totalenviado', 'Requerimientos'));
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
		if (!$SolicitudServicio) {
			abort(404);
		}
		$SolicitudServicio->SolServMailCopia = json_encode($request->input('SolServMailCopia'));

		if($SolicitudServicio->SolSerStatus === 'Programado'){
			if($request->input('SolSerTransportador') <> null){
				if($request->input('SolSerTransportador') <> 98){
					$cliente = DB::table('clientes')
						->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
						->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
						->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.ID_Mun')
						->where('ID_Cli', userController::IDClienteSegunUsuario())
						->first();
					$transportadorname = $cliente->CliName;
					$transportadornit = $cliente->CliNit;
					$transportadoradress = $cliente->SedeAddress;
					$transportadorcity = $cliente->ID_Mun;
				}
				else{
					$transportadorname = $request->input('SolSerNameTrans');
					$transportadornit = $request->input('SolSerNitTrans');
					$transportadoradress = $request->input('SolSerAdressTrans');
					$transportadorcity = $request->input('SolSerCityTrans');
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

			/*se guarda la observacion de la modificacion del servicio*/
			$Observacion = new Observacion();
			$Observacion->ObsStatus = $SolicitudServicio->SolSerStatus;
			$Observacion->ObsMensaje = $SolicitudServicio->SolSerDescript;
			$Observacion->ObsTipo = 'cliente';
			$Observacion->ObsRepeat = 1;
			$Observacion->ObsDate = now();
			$Observacion->ObsUser = Auth::user()->email;
			$Observacion->ObsRol = Auth::user()->UsRol;
			$Observacion->FK_ObsSolSer = $SolicitudServicio->ID_SolSer;
			$Observacion->save();

			return redirect()->route('serviciosexpress.show', ['id' => $SolicitudServicio->SolSerSlug]);
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
				->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.ID_Mun')
				->where('ID_Cli', 1)
				->first();
			$tipo = "Interno";
			$transportadorname = $cliente->CliName;
			$transportadornit = $cliente->CliNit;
			$transportadoradress = $cliente->SedeAddress;
			$transportadorcity = $cliente->ID_Mun;
			$conductor = null;
			$vehiculo = null;
			$collect = $request->input('SolSerTypeCollect');
		}
		else{
			if($request->input('SolSerTransportador') <> 98){
				$cliente = DB::table('clientes')
					->join('sedes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
					->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
					->select('clientes.ID_Cli', 'clientes.CliNit', 'clientes.CliName', 'sedes.SedeAddress', 'municipios.ID_Mun')
					->where('ID_Cli', userController::IDClienteSegunUsuario())
					->first();
				$transportadorname = $cliente->CliName;
				$transportadornit = $cliente->CliNit;
				$transportadoradress = $cliente->SedeAddress;
				$transportadorcity = $cliente->ID_Mun;
			}
			else{
				$transportadorname = $request->input('SolSerNameTrans');
				$transportadornit = $request->input('SolSerNitTrans');
				$transportadoradress = $request->input('SolSerAdressTrans');
				$transportadorcity = $request->input('SolSerCityTrans');
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
				$SolicitudServicio->FK_SolSerCollectMun = $request->input('FK_SolSerCollectMun');
				break;
		}
		if(isset($request['SupportPay'])){
			if($SolicitudServicio->SolSerSupport <> null && file_exists(public_path().'/img/SupportPay/'.$SolicitudServicio->SolSerSupport)){
				unlink(public_path().'/img/SupportPay/'.$SolicitudServicio->SolSerSupport);
			}
			$fileSupport = $request['SupportPay'];
			$nameSupport = hash('sha256', rand().time().$fileSupport->getClientOriginalName()).'.pdf';
			$fileSupport->move(public_path().'\img\SupportPay/',$nameSupport);
			$SolicitudServicio->SolSerSupport = $nameSupport;
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
		$SolicitudServicio->SolSerDescript = $request->input('SolSerDescript');
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

		/*se guarda la observacion de la modificacion del servicio*/
		$Observacion = new Observacion();
		$Observacion->ObsStatus = $SolicitudServicio->SolSerStatus;
		$Observacion->ObsMensaje = $SolicitudServicio->SolSerDescript;
		$Observacion->ObsTipo = 'cliente';
		$Observacion->ObsRepeat = 1;
		$Observacion->ObsDate = now();
		$Observacion->ObsUser = Auth::user()->email;
		$Observacion->ObsRol = Auth::user()->UsRol;
		$Observacion->FK_ObsSolSer = $SolicitudServicio->ID_SolSer;
		$Observacion->save();

		return redirect()->route('serviciosexpress.show', ['id' => $id]);
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

		if (!$SolicitudServicio) {
			abort(404, 'no se pudo eliminar la solicitud de servicio ya que no se encuentra en la base da datos');
		}

		switch ($SolicitudServicio->SolSerStatus) {
			case 'Pendiente':
			case 'Aceptado':
			case 'Programado':
			case 'Notificado':
			case 'Aprobado':

				$documentos = Documento::where('FK_CertSolser', $SolicitudServicio->ID_SolSer)->get();

				foreach ($documentos as $key => $documento) {
					$docdato = DocDato::where('FK_DatoDoc', $documento->ID_Doc)->get();

					foreach ($docdato as $key => $dato) {
							DocDato::destroy($dato->ID_Dato);
					}
					Documento::destroy($documento->ID_Doc);
				}

				SolicitudServicio::destroy($SolicitudServicio->ID_SolSer);

				break;

			default:
				abort(503, 'el servicio no puede ser eliminado si ya fue recibido en Planta');
				break;
		}


		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="Eliminado";
		$log->AuditRegistro=$SolicitudServicio->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$SolicitudServicio->SolSerDelete;
		$log->save();
		$SolicitudServicio->save();

		return redirect()->route('serviciosexpress.index');
	}

	/*
	*
	* Create from solicitud de residuo
	*
	*/
	public function createSolRes($request, $ID_SolSer)
	{
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

	/**
	 * list the related documents for specific solserv.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function solservdocindex($id)
	{
		if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
			$SolicitudServicio = DB::table('solicitud_servicios')
			->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
			->select('solicitud_servicios.*','personals.PersFirstName','personals.PersLastName','personals.PersEmail')
			->where('solicitud_servicios.SolSerSlug', $id)
			->where('solicitud_servicios.SolSerStatus', 'Certificacion')
			->first();
			if (!$SolicitudServicio) {
				abort(403,'Sus residuos aun no han sido certificados');
			}
			$certificados = Certificado::where(function($query) use ($SolicitudServicio){
			    $UserSedeID = DB::table('personals')
			    ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
			    ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
			    ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
			    ->join('clientes', 'clientes.ID_Cli', 'sedes.FK_SedeCli')
			    ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
			    ->value('clientes.ID_Cli');

			    $query->where('FK_CertCliente', $UserSedeID);
			    $query->where('CertAuthJo', '!=', 0);
			    $query->where('CertAuthJl', '!=', 0);
			    $query->where('CertAuthDp', '!=', 0);
			    $query->where('FK_CertSolser', $SolicitudServicio->ID_SolSer);

			})
			->with(['tratamiento'])
			->get();
		}else{
			$SolicitudServicio = DB::table('solicitud_servicios')
			->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
			->select('solicitud_servicios.*','personals.PersFirstName','personals.PersLastName','personals.PersEmail')
			->where('solicitud_servicios.SolSerSlug', $id)
			->first();
			if (!$SolicitudServicio) {
				abort(404);
			}


			$SolicitudServicio->cliente = Cliente::where('ID_CLi', $SolicitudServicio->FK_SolSerCliente)->first(['CliName', 'CliSlug']);

			if ($SolicitudServicio->cliente->CliCategoria == 'ClientePrepago') {
				$certificados = CertificadoExpress::with(['certdato.solres'])
				->where('FK_CertSolser', $SolicitudServicio->ID_SolSer)
				->get();

			} else {
				$certificados = Certificado::with(['certdato.solres'])
				->where('FK_CertSolser', $SolicitudServicio->ID_SolSer)
				->get();
			}
		}
		/* validacion para encontrar la fecha de recepción en planta del servicio */
		$fechaRecepcion = SolicitudServicio::find($SolicitudServicio->ID_SolSer)->programacionesrecibidas()->first();
		if($fechaRecepcion){
			$SolicitudServicio->recepcion = $fechaRecepcion->ProgVehSalida;
		}else{
			$SolicitudServicio->recepcion = null;
		}

		// return $certificados;
		return view('solicitud-serv.documentos', compact('SolicitudServicio', 'certificados'));
	}

	public function sendtobilling($id)
	{
		$Solicitud = SolicitudServicio::where('SolSerSlug', $id)->first();
		if (!$Solicitud) {
			abort(404);
		}

		$Solicitud->SolServCertStatus=1;
		$Solicitud->save();

		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="enviado a facturacion";
		$log->AuditRegistro=$Solicitud->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$Solicitud->SolServCertStatus;
		$log->save();

		return redirect()->route('serviciosexpress.show', ['id' => $id]);
	}

	public function updateRms(Request $request, $id)
	{
		$Solicitud = SolicitudServicio::where('SolSerSlug', $id)->first();
		if (!$Solicitud) {
			abort(404);
		}

		$Solicitud->SolSerRMs=$request->input('SolServRM');
		$Solicitud->save();

		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="actualizados los RMs";
		$log->AuditRegistro=$Solicitud->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$request;
		$log->save();

		return redirect()->route('serviciosexpress.show', ['id' => $id]);
	}

	public function solservdocstore($id)
	{

		$SolicitudServicio = SolicitudServicio::where('ID_SolSer', $id)->first();
		$serviciovalidado = $id;
		/*cuenta los diferentes generadores*/
		$generadoresdelasolicitud = GenerSede::whereHas('resgener.solres', function ($query) use ($serviciovalidado) {
		    $query->where('solicitud_residuos.FK_SolResSolSer', $serviciovalidado);
		})
		->with(['resgener' => function ($query) use ($serviciovalidado){
		    $query->with(['solres' => function ($query) use ($serviciovalidado){
		    	$query->where('FK_SolResSolSer', $serviciovalidado);
		    	$query->with(['requerimiento.tratamiento.gestor', 'requerimiento:ID_Req,FK_ReqTrata']);
		    }]);
		    $query->whereHas('solres', function ($query) use ($serviciovalidado){
		    	$query->where('FK_SolResSolSer', $serviciovalidado);
		    });
		}])
		->get();
		// return $generadoresdelasolicitud;
		/*consulta para el cliente de esta solicitud*/
		$cliente = Cliente::whereHas('sedes.generador', function ($query) use ($generadoresdelasolicitud) {
		    $query->where('generadors.ID_Gener', $generadoresdelasolicitud[0]->FK_GSede);
		})->first();
		foreach ($generadoresdelasolicitud as $genersede) {
			foreach ($genersede->resgener as $resgener) {
				foreach ($resgener->solres as $key) {
					if ($key->SolResKgConciliado > 0) {
						switch ($key->requerimiento->tratamiento->TratTipo) {
							case '0':
								// "tratamiento tipo: interno; Certificado";

								$certificadoprevio = Certificado::where('FK_CertTrat', $key->requerimiento->tratamiento->ID_Trat)
								->where('FK_CertSolser', $id)
								->where('FK_CertGenerSede', $genersede->ID_GSede)
								->first();

								$gestor = Sede::where('ID_Sede', $key->requerimiento->tratamiento->FK_TratProv)
								->first();

								if ((isset($certificadoprevio))&&($certificadoprevio->FK_CertTrat == $key->requerimiento->tratamiento->ID_Trat)&&($certificadoprevio->FK_CertGenerSede == $genersede->ID_GSede)) {

									$dato = new Certdato;
									$dato->FK_DatoCert = $certificadoprevio->ID_Cert;
									$dato->FK_DatoCertSolRes = $key->ID_SolRes;
									$dato->save();

								}else{

									$certificado = new Certificado;
									if ($key->requerimiento->tratamiento->TratName == 'TermoDestrucción') {
										$certificado->CertType = 0;
										$certificado->CertObservacion = "certificado con observacion generica";
									}else{
										$certificado->CertType = 1;
										$certificado->CertObservacion = "manifiesto con observacion generica";
									}
									$certificado->CertNumero = "";
									$certificado->CertManifNumero = "";
									$certificado->CertManifPrepend = "";
									$certificado->CertiEspName = "";
									$certificado->CertiEspValue = "";
									$certificado->CertSlug = hash('sha256', rand().time());
									$certificado->CertSrc = 'CertificadoDefault.pdf';
									// $certificado->CertNumRm = "C-130";
									$certificado->CertAuthHseq = 0;
									$certificado->CertAuthJl = 0;
									$certificado->CertAuthDp = 0;
									$certificado->CertAuthJo = 0;
									$certificado->CertAnexo = "anexo de certificado ".$key->requerimiento->tratamiento->TratName.$key->requerimiento->tratamiento->FK_TratProv;
									$certificado->FK_CertSolser = $id;
									$certificado->FK_CertCliente = $cliente->ID_Cli;
									$certificado->FK_CertGenerSede = $genersede->ID_GSede;
									$certificado->FK_CertGestor = $key->requerimiento->tratamiento->gestor->FK_SedeCli;
									$certificado->FK_CertTrat = $key->requerimiento->tratamiento->ID_Trat;
									if ($SolicitudServicio->SolSerTipo == 'Externo') {
										$certificado->FK_CertTransp = $cliente->ID_Cli;
									}else{
										$certificado->FK_CertTransp = 1;
									}

									$certificado->SolicitudServicio->SolicitudResiduo = $certificado->SolicitudServicio->SolicitudResiduo->map(function ($item) {
										$rm = SolicitudResiduo::where('SolResSlug', $item->SolResSlug)->first('SolResRM');
										$item->SolResRM2 = $rm->SolResRM;
										return $item;
									});
									$certificado->save();

									$dato = new Certdato;
									$dato->FK_DatoCert = $certificado->ID_Cert;
									$dato->FK_DatoCertSolRes = $key->ID_SolRes;
									$dato->save();

								}

								break;

							case '1':
								// "tratamiento tipo: externo ; manifiesto";
								/*se verifica si ya existe un documento con ese tratamiento para esa solicitud de servicio*/
								$manifiestoprevio = Manifiesto::where('FK_ManifTrat', $key->requerimiento->tratamiento->ID_Trat)
								->where('FK_ManifSolser', $id)
								->first();

								if ((isset($manifiestoprevio))&&($manifiestoprevio->FK_ManifTrat == $key->requerimiento->tratamiento->ID_Trat)) {

									$dato = new Manifdato;
									$dato->FK_DatoManif = $manifiestoprevio->ID_Manif;
									$dato->FK_DatoManifSolRes = $key->ID_SolRes;
									$dato->save();

								}else{

									$manifiesto = new Manifiesto;
									$manifiesto->ManifNumero = "";
									$manifiesto->ManifiEspName = "";
									$manifiesto->ManifiEspValue = "";
									$manifiesto->ManifObservacion = "manifiesto con observacion generica";
									$manifiesto->ManifSlug = hash('sha256', rand().time());
									$manifiesto->ManifSrc = 'ManifiestoDefault.pdf';
									$manifiesto->ManifNumRm = "M-16";
									$manifiesto->ManifAuthHseq = 0;
									$manifiesto->ManifAuthJl = 0;
									$manifiesto->ManifAuthDp = 0;
									$manifiesto->ManifAuthJo = 0;
									$manifiesto->ManifAnexo = "anexo de manifiesto ".$key->requerimiento->tratamiento->TratName.$key->requerimiento->tratamiento->FK_TratProv;
									$manifiesto->FK_ManifSolser = $id;
									$manifiesto->FK_ManifCliente = $cliente->ID_Cli;
									$manifiesto->FK_ManifGenerSede = $genersede->ID_GSede;
									$manifiesto->FK_ManifGestor = $key->requerimiento->tratamiento->gestor->FK_SedeCli;
									$manifiesto->FK_ManifTrat = $key->requerimiento->tratamiento->ID_Trat;
									if ($SolicitudServicio->SolSerTipo == 'Externo') {
										$manifiesto->FK_ManifTransp = $cliente->ID_Cli;
									}else{
										$manifiesto->FK_ManifTransp = 1;
									}
									$manifiesto->save();

									$dato = new Manifdato;
									$dato->FK_DatoManif = $manifiesto->ID_Manif;
									$dato->FK_DatoManifSolRes = $key->ID_SolRes;
									$dato->save();
								}

								break;

							default:
								return back()->withErrors(['msg' => ['alguno de los residuos no posee tratamiento asignado favor verifica que su asesor comercial la evaluacion de los residuos.']]);
								break;
						}
					}
				}
			}
		}
	}

	/**
	 * muestra el formulario para añadir residuos adicionales al servicio en status Residuo Faltante.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function addRespel($id)
	{
		if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
			$Solicitud = SolicitudServicio::where('SolSerSlug', $id)->first();
			if (!$Solicitud) {
				abort(404);
			}
			if($Solicitud->SolSerStatus !== 'Residuo Faltante'){
				abort(403, 'el servicio no se encuentra en el status correcto para añadir residuos');
			}
			if($Solicitud->SolSerCityTrans <> null){
				$Municipio = Municipio::select('FK_MunCity')->where('ID_Mun', $Solicitud->SolSerCityTrans)->first();
				$Departamento = Departamento::where('ID_Depart', $Municipio->FK_MunCity)->first();
				$Municipios = Municipio::where('FK_MunCity', $Departamento->ID_Depart)->get();
			}
			if($Solicitud->FK_SolSerCollectMun <> null){
				$Municipio2 = Municipio::select('FK_MunCity')->where('ID_Mun', $Solicitud->FK_SolSerCollectMun)->first();
				$Departamento2 = Departamento::where('ID_Depart', $Municipio2->FK_MunCity)->first();
				$Municipios2 = Municipio::where('FK_MunCity', $Departamento2->ID_Depart)->get();
			}
			$Departamentos = Departamento::all();
			$Cliente = Cliente::where('ID_Cli', $Solicitud->FK_SolSerCliente)->first();
            $Requerimientos = RequerimientosCliente::where('FK_RequeClient', $Cliente->ID_Cli)->get();
			$Sedes = Sede::select('SedeSlug','SedeName', 'ID_Sede')->where('FK_SedeCli', $Cliente->ID_Cli)->get();
			$SGeneradors = DB::table('gener_sedes')
				->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
				->join('sedes', 'generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('gener_sedes.GSedeSlug', 'gener_sedes.GSedeName', 'generadors.GenerName')
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
				->select('personals.PersSlug', 'personals.PersFirstName', 'personals.PersLastName', 'personals.PersEmail')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->where('personals.PersDelete', 0)
				->get();
			$KGenviados = DB::table('solicitud_residuos')
				->select('SolResKgEnviado')
				->where('FK_SolResSolSer', $Solicitud->ID_SolSer)
				->get();
			$totalenviado = 0;
			foreach ($KGenviados as $KGenviado) {
				$totalenviado = $totalenviado + $KGenviado->SolResKgEnviado;
			}
			return view('solicitud-serv.addrespel', compact('Solicitud','Cliente','Persona','Personals','Departamentos','SGeneradors', 'Departamento','Municipios', 'Departamento2','Municipios2', 'Sedes', 'totalenviado', 'Requerimientos'));
		}
		else{
			abort(403);
		}
	}

	/**
	 * ingresa los residuos adicionales a la base de datos.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function updateRespel(Request $request, $id)
	{
		// return $request;
		$SolicitudServicio = SolicitudServicio::where('SolSerSlug', $id)->first();
		if (!$SolicitudServicio) {
			abort(404, 'solicitud de servicio no encontrada');
		}

		if(!is_null($request->input('SGenerador'))){
			$this->createSolRes($request, $SolicitudServicio->ID_SolSer);
		}


		$SolicitudServicio->SolSerStatus = 'Notificado';
		$SolicitudServicio->SolSerDescript = $request->input('SolSerDescript');
		$SolicitudServicio->save();


		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="residuos adicionales";
		$log->AuditRegistro=$SolicitudServicio->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=json_encode($request->all());
		$log->save();

		/*se guarda la observacion inicial de la creación del servicio*/
		$Observacion = new Observacion();
		$Observacion->ObsStatus = $SolicitudServicio->SolSerStatus;
		if ($SolicitudServicio->SolSerDescript = "") {
			$Observacion->ObsMensaje = 'Residuos faltantes ya incluidos por el cliente';
		}else{
			$Observacion->ObsMensaje = $SolicitudServicio->SolSerDescript;
		}
		$Observacion->ObsTipo = 'cliente';
		$Observacion->ObsRepeat = 1;
		$Observacion->ObsDate = now();
		$Observacion->ObsUser = Auth::user()->email;
		$Observacion->ObsRol = Auth::user()->UsRol;
		$Observacion->FK_ObsSolSer = $SolicitudServicio->ID_SolSer;
		$Observacion->save();

		$SolicitudServicio['cliente'] = Cliente::where('ID_Cli', $SolicitudServicio->FK_SolSerCliente)->first();
		// se establece la lista de destinatarios
		$destinatarios = ['recepcionpda@prosarc.com.co'];
		$destinatarioscc = [];

		if ($SolicitudServicio['cliente']->CliComercial <> null) {
			$comercial = Personal::where('ID_Pers', $SolicitudServicio['cliente']->CliComercial)->first();
			array_push($destinatarioscc, $comercial->PersEmail);
		}else{
			$comercial = "";
		}

		$SolicitudServicio['comercial'] = $comercial;
		$SolicitudServicio['personalcliente'] = Personal::where('ID_Pers', $SolicitudServicio->FK_SolSerPersona)->first();

		// añadir destinatarios para copia del cliente
		if ($SolicitudServicio->SolServMailCopia !== "null") {
			foreach (json_decode($SolicitudServicio->SolServMailCopia) as $key => $value) {
				array_push($destinatarioscc, $value);
			}
		}

		Mail::to($destinatarios)->cc($destinatarioscc)->send(new SolSerLeftRespel($SolicitudServicio));

		return redirect()->route('serviciosexpress.show', ['id' => $id]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function serviciosCompletados()
	{
		if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
			abort(401, 'no tiene autorización para acceder a esta página');
		}

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
			'Comercial.PersFirstName as ComercialPersFirstName',
			'Comercial.PersLastName as ComercialPersLastName',
			'Comercial.PersSlug as ComercialPersSlug',
			'Comercial.PersEmail as ComercialPersEmail',
			'Comercial.PersCellphone as ComercialPersCellphone')
			->where('solicitud_servicios.SolSerStatus', 'Completado')
			->where('clientes.CliCategoria', 'Cliente')
			->orderBy('created_at', 'desc')
			->get();

		$Cliente = Cliente::select('CliName','ID_Cli', 'CliStatus')->where('ID_Cli',userController::IDClienteSegunUsuario())->first();
		foreach ($Servicios as $servicio) {
			/* validacion para encontrar la fecha de recepción en planta del servicio */
			$fechaRecepcion = SolicitudServicio::find($servicio->ID_SolSer)->programacionesrecibidas()->first();
			if($fechaRecepcion){
				$servicio->recepcion = $fechaRecepcion->ProgVehSalida;
			}else{
				$servicio->recepcion = null;
			}
			$servicio->ultimoRecordatorio = SolicitudServicio::find($servicio->ID_SolSer)->ultimorecordatorio();
			$servicio->fechaCompletado = SolicitudServicio::find($servicio->ID_SolSer)->fechacompletado();
		}

		// return $Servicios;

		return view('solicitud-serv.indexrecordatorios', compact('Servicios', 'Residuos', 'Cliente'));
	}

	public function reversarStatus(Request $request)
	{
		$Solicitud = SolicitudServicio::where('SolSerSlug', $request->input('solserslug'))->first();
		if (!$Solicitud) {
			abort(404);
		}
		if ($Solicitud->SolSerStatus == 'Certificacion') {
			if (!in_array(Auth::user()->UsRol, Permisos::REVERSARADMIN) && !in_array(Auth::user()->UsRol2, Permisos::REVERSARADMIN)) {
				abort(403, 'el servicio ya ha sido certificado y no admite cambios de status');
			}
		}
		switch ($request->input('solserstatus')) {
			case 'Notificado':
			case 'Completado':
			case 'Residuo Faltante':
			case 'Corregido':
			case 'Programado':
			case 'No Conciliado':
			case 'Residuo Faltante':
				if ($Solicitud->SolSerStatus == 'Conciliado'||$Solicitud->SolSerStatus == 'Tratado'||$Solicitud->SolSerStatus == 'Certificacion') {
					$certificadosDelete = Certificado::with('certdato')->where('FK_CertSolser', $Solicitud->ID_SolSer)->get();
					foreach ($certificadosDelete as $key => $value) {
						foreach ($value->certdato as $key2 => $value2) {
							$value2->delete();
						}
						$value->delete();
					}
				}
				break;
		}

		$Solicitud->SolSerStatus = $request->input('solserstatus');
		$Solicitud->SolSerDescript = $request->input('solserdescript');
		$Solicitud->save();

		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="Reversado Status";
		$log->AuditRegistro=$Solicitud->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=[$Solicitud->SolSerStatus, $Solicitud->SolSerDescript];
		$log->save();


		/*se guarda la observacion de la modificacion del servicio*/
		$Observacion = new Observacion();
		$Observacion->ObsStatus = 'Devuelto a status: '.$Solicitud->SolSerStatus;
		$Observacion->ObsMensaje = $Solicitud->SolSerDescript;
		$Observacion->ObsTipo = 'prosarc';
		$Observacion->ObsRepeat = 1;
		$Observacion->ObsDate = now();
		$Observacion->ObsUser = Auth::user()->email;
		$Observacion->ObsRol = Auth::user()->UsRol;
		$Observacion->FK_ObsSolSer = $Solicitud->ID_SolSer;
		$Observacion->save();

		return redirect()->route('serviciosexpress.show', ['id' => $Solicitud->SolSerSlug]);

	}

	public function CancelarServicio(Request $request)
	{
		// return $request;
		$Solicitud = SolicitudServicio::where('SolSerSlug', $request->input('solserslug'))->first();
		if (!$Solicitud) {
			abort(404);
		}

		$statusAllowingCancel = ['Pendiente',
								'Cancelado',
								'Aceptado',
								'Aprobado',
								'Programado',
								'Notificado'];

		if (!in_array($Solicitud->SolSerStatus, $statusAllowingCancel)) {
			abort(403, 'el servicio #'.$Solicitud->ID_SolSer.' no debe ser cancelado, ya que se encuentra en status '.$Solicitud->SolSerStatus);
		}

		// eliminar las programaciones relacionadas con el servicio
		$programacionesDelete = ProgramacionVehiculo::where('FK_ProgServi', $Solicitud->ID_SolSer)
		->where('ProgVehDelete', 0)
		->get();

		foreach ($programacionesDelete as $key => $value) {
			$value->ProgVehDelete = 1;
			$value->save();
		}

		// cabiar el status del servicio
		switch ($request->input('solserstatus')) {
			case 'Aprobado':
				$Solicitud->SolSerStatus = 'Aprobado';
				break;
			case 'Cancelado':
				$Solicitud->SolSerStatus = 'Cancelado';
				break;
		}
		$Solicitud->SolSerDescript = $request->input('solserdescript');
		$Solicitud->save();

		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="Servicio cancelado";
		$log->AuditRegistro=$Solicitud->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=[$Solicitud->SolSerStatus, $Solicitud->SolSerDescript];
		$log->save();


		/*se guarda la observacion de la modificacion del servicio*/
		$Observacion = new Observacion();
		// cabiar el status de la observación
		switch ($request->input('solserstatus')) {
			case 'Aprobado':
				$Observacion->ObsStatus = 'Reactivado';
				break;
			case 'Cancelado':
				$Observacion->ObsStatus = 'Cancelado';
				break;
		}
		$Observacion->ObsMensaje = $Solicitud->SolSerDescript;
		$Observacion->ObsTipo = 'prosarc';
		$Observacion->ObsRepeat = 1;
		$Observacion->ObsDate = now();
		$Observacion->ObsUser = Auth::user()->email;
		$Observacion->ObsRol = Auth::user()->UsRol;
		$Observacion->FK_ObsSolSer = $Solicitud->ID_SolSer;
		$Observacion->save();
		return redirect()->route('serviciosexpress.index');
	}

	    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rutadeldia()
    {
        $ServiciosDelDia = DB::table('solicitud_servicios')
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
			'clientes.ID_Cli',
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
				if(in_array(Auth::user()->UsRol, Permisos::COMERCIALES) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALES)){
					if(!in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
						$query->where('Comercial.ID_Pers', Auth::user()->FK_UserPers);
					}
				}
			})
			->where('CliCategoria', 'ClientePrepago')
			->orderBy('created_at', 'desc')
			->get();
		foreach ($ServiciosDelDia as $servicio) {
			$sedeExpress = Sede::where('FK_SedeCli',$servicio->ID_Cli)->first();
			$servicio->SolSerCollectAddress = $sedeExpress->SedeAddress;
			$servicio->FK_SedeMun = $sedeExpress->FK_SedeMun;
			$servicio->SedeMapLocalidad = $sedeExpress->SedeMapLocalidad;
			$servicio->SedeMapLat = $sedeExpress->SedeMapLat;
			$servicio->SedeMapLong = $sedeExpress->SedeMapLong;


			/* validacion para encontrar la fecha de recepción en planta del servicio */
			$fechaRecepcion = SolicitudServicio::find($servicio->ID_SolSer)->programacionesrecibidas()->first();
			if($fechaRecepcion){
				$servicio->recepcion = $fechaRecepcion->ProgVehSalida;
			}else{
				$servicio->recepcion = null;
			}
		}

		$Servicios = $ServiciosDelDia->filter(function ($value, $key) {
			return date('Y/m/d', strtotime($value->recepcion))  == date('Y/m/d', strtotime(today()));
		});
		return view('serviciosexpress.indexprosarc', compact('Servicios'));
    }

	public function certificarExpress(Request $request)
	{
		// return $request;

		$Solicitud = SolicitudServicio::where('SolSerSlug', $request->input('solserslug'))->first();
		if (!$Solicitud) {
			abort(404);
		}

		$totalrerspel = $Solicitud->SolicitudResiduo()->get('SolResKgConciliado')->sum('SolResKgConciliado');


		if ($totalrerspel <= 0) {
			abort(403, 'debe indicar las cantidades de los residuos antes de poder continuar');
		}

		/* se guarda la firma del cliente */
		$data_uri = $request->input('solserFirma');
		$encoded_image = explode(",", $data_uri)[1];
		$decoded_image = base64_decode($encoded_image);
		$nombreDeFirma = $request->input('solserslug');
		Storage::put('firmasClientes/'.$nombreDeFirma.'.png', $decoded_image, 'public');
		// return Storage::download('firmasClientes/'.$nombreDeFirma.'.png');

		if ($Solicitud->SolSerStatus == 'Certificacion') {
			$certificadosDelete = CertificadoExpress::with('certdato')->where('FK_CertSolser', $Solicitud->ID_SolSer)->get();
			foreach ($certificadosDelete as $key => $value) {
				foreach ($value->certdato as $key2 => $value2) {
					$value2->delete();
				}
				$value->delete();
			}
		}

		/* se generan los registros para certificados y manifiestos */

		$this->solservdocstoreExpress($Solicitud->ID_SolSer);

		/**se cambia el status del servicio a certificado */

		$Solicitud->SolSerStatus = 'Certificacion';
		$Solicitud->SolServCertStatus = 2;
		$Solicitud->SolSerDescript = $request->input('solserdescript');
		$Solicitud->save();
		/** se guarda log en la tabla de auditoria */

		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="certificar Express";
		$log->AuditRegistro=$Solicitud->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=[$Solicitud->SolSerStatus, $Solicitud->SolSerDescript];
		$log->save();

		/*se guarda la observacion de la modificacion del servicio*/
		$Observacion = new Observacion();
		$Observacion->ObsStatus = $Solicitud->SolSerStatus;
		$Observacion->ObsMensaje = $Solicitud->SolSerDescript;
		$Observacion->ObsTipo = 'prosarc';
		$Observacion->ObsRepeat = 1;
		$Observacion->ObsDate = now();
		$Observacion->ObsUser = Auth::user()->email;
		$Observacion->ObsRol = Auth::user()->UsRol;
		$Observacion->FK_ObsSolSer = $Solicitud->ID_SolSer;
		$Observacion->save();

		/* se generan los pdf con los certificados correspondientes */
		/*
			espacio para el codigo de generacion de los pdf de los certificados / manifiestos
		*/
		$certificados = CertificadoExpress::with(['certdato.solres', 'cliente.sedes.Municipios.Departamento', 'sedegenerador.generadors', 'sedegenerador.municipio.Departamento', 'gestor.sedes.Municipios.Departamento', 'tratamiento', 'transportador.sedes.Municipios.Departamento', 'SolicitudServicio' => function ($query){
                    $query->with(['SolicitudResiduo' => function ($query){
                        $query->where('SolResKgConciliado', '>', 0);
                        $query->orWhere('SolResCantiUnidadConciliada', '>', 0);
                        $query->with('generespel.respels');
                        $query->with('requerimiento');
                    }]);
                }])
				->where('FK_CertSolser', $Solicitud->ID_SolSer)
				->get();

		//loop over $certificados
		foreach ($certificados as $certificado) {

			$fecharecepcionenplanta = $certificado->SolicitudServicio->programacionesrecibidas()->first('ProgVehSalida');
			if ($fecharecepcionenplanta != null) {
				$certificado->recepcion = $fecharecepcionenplanta->ProgVehSalida;
			}else{
				$certificado->recepcion = "";
			}

			$Solicitud->nombreDeFirma = 'firmasClientes/'.$nombreDeFirma.'.png';

			$qrCode = new QrCode(route('certificadosexpress.show', ['certificado' => $certificado->CertSlug]));
			$qrCode->setLogoPath(asset('img/LogoQR.png'));
			$qrCode->setLogoSize(60, 60);
			$qrCode->setSize(300);
			$qrCode->setMargin(0);
			$qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_SHRINK);

			switch ($certificado->tratamiento->TratName) {
				case 'TermoDestrucción':
                    $pdf = PDF::setPaper('letter', 'portrait')->loadView('certificadosExpress.topdf', compact(['certificado','Solicitud','qrCode']));
                    Storage::put('certificadoExpress'.'/E-'.sprintf("%07s", $certificado->ID_Cert).'.pdf', $pdf->output(), 'public');

					break;

				default:
					$pdf = PDF::setPaper('letter', 'portrait')->loadView('certificadosExpress.topdfmanifesto', compact(['certificado','Solicitud','qrCode']));
					Storage::put('manifiestosExpress'.'/ME-'.sprintf("%07s", $certificado->CertManifNumero).'.pdf', $pdf->output(), 'public');

					break;
			}

			/**se envia notificacion con los archivos en formato pdf de los certificados */
			$email = DB::table('solicitud_servicios')
				->join('progvehiculos', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
				->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
				->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
				->select('personals.PersEmail', 'solicitud_servicios.*', 'progvehiculos.ProgVehFecha', 'progvehiculos.ProgVehSalida', 'clientes.CliName', 'clientes.CliComercial')
				->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
				->where('progvehiculos.FK_ProgServi', '=', $Solicitud->ID_SolSer)
				->where('progvehiculos.ProgVehDelete', 0)
				->first();

			$comercial = Personal::where('ID_Pers', $email->CliComercial)->first();

			if ($comercial) {
				$destinatarios = [$comercial->PersEmail];
			} else {
				$destinatarios = [];
			}

			$destinatarios = [$comercial->PersEmail];

			if ($Solicitud->SolServMailCopia == "null"||$Solicitud->SolServMailCopia == "") {

			}else{
				foreach (json_decode($Solicitud->SolServMailCopia) as $key => $value) {
					array_push($destinatarios, $value);
				}
			}

			// if ($totalrerspel > 10) {
			// 	//enviar correo avisando que excede la cantidad de 5 kg
			// 	if ($comercial) {
			// 		Mail::to($comercial->PersEmail)->send(new CertExpressRetenidoEmail($email, $pdf, $certificado));
			// 	} else {
			// 		Mail::to('subgerencia@prosarc.com.co')->cc($destinatarios)->send(new CertExpressRetenidoEmail($email, $pdf, $certificado));
			// 	}
			// }else{
			// 	if ($totalrerspel > 0) {
			// 		//enviar certificado al cliente con copia a los destinatarios
			// 		Mail::to($email->PersEmail)->cc($destinatarios)->send(new SolSerExpressEmail($email, $pdf, $certificado));
			// 	}else{
			// 		//enviar correo avisando que la cantidad total es inferior o igual a 0 kg
			// 		if ($comercial) {
			// 			Mail::to($comercial->PersEmail)->send(new CertExpressSinSaldoEmail($email, $pdf, $certificado));
			// 		} else {
			// 			Mail::to('subgerencia@prosarc.com.co')->send(new CertExpressSinSaldoEmail($email, $pdf, $certificado));
			// 		}
			// 	}
			// }

			// if ($totalrerspel > 10) {
			// 	Mail::to('coordinadorse@prosarc.com.co')->send(new CertExpressRetenidoEmail($email, $pdf, $certificado));
			// }else{
			// 	if ($totalrerspel > 0) {
			// 		Mail::to('coordinadorse@prosarc.com.co')->send(new SolSerExpressEmail($email, $pdf, $certificado));
			// 	}else{
			// 		Mail::to('coordinadorse@prosarc.com.co')->send(new CertExpressSinSaldoEmail($email, $pdf, $certificado));
			// 	}
			// }
            Mail::to('coordinadorse@prosarc.com.co')->send(new SolSerExpressEmail($email, $pdf, $certificado));
		}

		return redirect()->route('serviciosexpress.show', ['id' => $Solicitud->SolSerSlug]);

	}

    public function conciliarExpress(Request $request)
	{
		// return $request;

		$Solicitud = SolicitudServicio::where('SolSerSlug', $request->input('solserslug'))->first();
		if (!$Solicitud) {
			abort(404);
		}

		$totalrerspel = $Solicitud->SolicitudResiduo()->get('SolResKgConciliado')->sum('SolResKgConciliado');


		if ($totalrerspel <= 0) {
			abort(403, 'debe indicar las cantidades de los residuos antes de poder continuar');
		}

		/* se guarda la firma del cliente */
		$data_uri = $request->input('solserFirma');
		$encoded_image = explode(",", $data_uri)[1];
		$decoded_image = base64_decode($encoded_image);
		$nombreDeFirma = $request->input('solserslug');
		Storage::put('firmasClientes/'.$nombreDeFirma.'.png', $decoded_image, 'public');
		// return Storage::download('firmasClientes/'.$nombreDeFirma.'.png');

		/**se cambia el status del servicio a conciliado */

		$Solicitud->SolSerStatus = 'Conciliado';
		$Solicitud->SolServCertStatus = 1;
		$Solicitud->SolSerDescript = $request->input('solserdescript');
		$Solicitud->save();

		/** se guarda log en la tabla de auditoria */

		$log = new audit();
		$log->AuditTabla="solicitud_servicios";
		$log->AuditType="conciliado Express";
		$log->AuditRegistro=$Solicitud->ID_SolSer;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=[$Solicitud->SolSerStatus, $Solicitud->SolSerDescript];
		$log->save();

		/*se guarda la observacion de la modificacion del servicio*/
		$Observacion = new Observacion();
		$Observacion->ObsStatus = $Solicitud->SolSerStatus;
		$Observacion->ObsMensaje = $Solicitud->SolSerDescript;
		$Observacion->ObsTipo = 'prosarc';
		$Observacion->ObsRepeat = 1;
		$Observacion->ObsDate = now();
		$Observacion->ObsUser = Auth::user()->email;
		$Observacion->ObsRol = Auth::user()->UsRol;
		$Observacion->FK_ObsSolSer = $Solicitud->ID_SolSer;
		$Observacion->save();

		/* se generan los pdf con los certificados correspondientes */
		/*
			espacio para el codigo de generacion de los pdf de los certificados / manifiestos
		*/

		/**se envia notificacion con los archivos en formato pdf de los certificados */
		$emailData = DB::table('solicitud_servicios')
			->join('progvehiculos', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
			->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
			->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
			->select('personals.PersEmail', 'solicitud_servicios.*', 'progvehiculos.ProgVehFecha', 'progvehiculos.ProgVehSalida', 'clientes.CliName', 'clientes.CliComercial')
			->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
			->where('progvehiculos.FK_ProgServi', '=', $Solicitud->ID_SolSer)
			->where('progvehiculos.ProgVehDelete', 0)
			->first();

		$comercial = Personal::where('ID_Pers', $emailData->CliComercial)->first();

		if ($comercial) {
			$comercialaddress = [$comercial->PersEmail];
		} else {
			$comercialaddress = [];
		}

        Mail::to('coordinadorse@prosarc.com.co')->cc($comercialaddress)->send(new SolSerExpressConciliado($emailData));


		return redirect()->route('serviciosexpress.show', ['id' => $Solicitud->SolSerSlug]);

	}

	public function solservdocstoreExpress($id)
	{

		$SolicitudServicio = SolicitudServicio::where('ID_SolSer', $id)->first();
		$serviciovalidado = $id;
		/*cuenta los diferentes generadores*/
		$generadoresdelasolicitud = GenerSede::whereHas('resgener.solres', function ($query) use ($serviciovalidado) {
			$query->where('solicitud_residuos.FK_SolResSolSer', $serviciovalidado);
		})
		->with(['resgener' => function ($query) use ($serviciovalidado){
			$query->with(['solres' => function ($query) use ($serviciovalidado){
				$query->where('FK_SolResSolSer', $serviciovalidado);
				$query->with(['requerimiento.tratamiento.gestor', 'requerimiento:ID_Req,FK_ReqTrata']);
			}]);
			$query->whereHas('solres', function ($query) use ($serviciovalidado){
				$query->where('FK_SolResSolSer', $serviciovalidado);
			});
		}])
		->get();
		// return $generadoresdelasolicitud;
		/*consulta para el cliente de esta solicitud*/
		$cliente = Cliente::whereHas('sedes.generador', function ($query) use ($generadoresdelasolicitud) {
			$query->where('generadors.ID_Gener', $generadoresdelasolicitud[0]->FK_GSede);
		})->first();
		foreach ($generadoresdelasolicitud as $genersede) {
			foreach ($genersede->resgener as $resgener) {
				foreach ($resgener->solres as $key) {
					if ($key->SolResKgConciliado > 0) {
						switch ($key->requerimiento->tratamiento->TratTipo) {
							case '0':
								// "tratamiento tipo: interno; Certificado";

                                //check CertManifNumero previous counter
                                $manifiestoprevio = CertificadoExpress::where('CertType', 1)->orderBy('ID_Cert','desc')->first();

								$certificadoprevio = CertificadoExpress::where('FK_CertTrat', $key->requerimiento->tratamiento->ID_Trat)
								->where('FK_CertSolser', $id)
								->where('FK_CertGenerSede', $genersede->ID_GSede)
								->first();

								$gestor = Sede::where('ID_Sede', $key->requerimiento->tratamiento->FK_TratProv)->first();

								if ((isset($certificadoprevio))&&($certificadoprevio->FK_CertTrat == $key->requerimiento->tratamiento->ID_Trat)&&($certificadoprevio->FK_CertGenerSede == $genersede->ID_GSede)) {

									$dato = new CertExpressdato;
									$dato->FK_DatoCert = $certificadoprevio->ID_Cert;
									$dato->FK_DatoCertSolRes = $key->ID_SolRes;
									$dato->save();

								}else{

									$certificado = new CertificadoExpress;
									if ($key->requerimiento->tratamiento->TratName == 'TermoDestrucción') {
										$certificado->CertType = 0;
										$certificado->CertObservacion = "certificado Express con observacion generica";
										$certificado->CertAnexo = "anexo de certificado ".$key->requerimiento->tratamiento->TratName.$key->requerimiento->tratamiento->FK_TratProv;
										$certificado->CertManifPrepend = "";
										$certificado->CertManifNumero = 0;
									}else{
										$certificado->CertType = 1;
										$certificado->CertObservacion = "manifiesto Express con observacion generica";
										$certificado->CertAnexo = "anexo de manifiesto ".$key->requerimiento->tratamiento->TratName.$key->requerimiento->tratamiento->FK_TratProv;
										$certificado->CertManifPrepend = "ME-";
                                        if ($manifiestoprevio) {
                                            $certificado->CertManifNumero = $manifiestoprevio->CertManifNumero + 1;
                                        }else{
                                            $certificado->CertManifNumero = 1;
                                        }
									}
									$certificado->CertNumero = "";
									$certificado->CertiEspName = "";
									$certificado->CertiEspValue = "";
									$certificado->CertSlug = hash('sha256', rand().time());
									$certificado->CertSrc = 'CertificadoDefault.pdf';
									// $certificado->CertNumRm = "C-130";
									$certificado->CertAuthHseq = 0;
									$certificado->CertAuthDp = 1;
									$certificado->CertAuthJl = 2;
									$certificado->CertAuthJo = 3;
									$certificado->FK_CertSolser = $id;
									$certificado->FK_CertCliente = $cliente->ID_Cli;
									$certificado->FK_CertGenerSede = $genersede->ID_GSede;
									$certificado->FK_CertGestor = $key->requerimiento->tratamiento->gestor->FK_SedeCli;
									$certificado->FK_CertTrat = $key->requerimiento->tratamiento->ID_Trat;
									if ($SolicitudServicio->SolSerTipo == 'Externo') {
										$certificado->FK_CertTransp = $cliente->ID_Cli;
									}else{
										$certificado->FK_CertTransp = 1;
									}

									$certificado->SolicitudServicio->SolicitudResiduo = $certificado->SolicitudServicio->SolicitudResiduo->map(function ($item) {
										$rm = SolicitudResiduo::where('SolResSlug', $item->SolResSlug)->first('SolResRM');
										$item->SolResRM2 = $rm->SolResRM;
										return $item;
									});
									$certificado->save();

									$dato = new CertExpressdato;
									$dato->FK_DatoCert = $certificado->ID_Cert;
									$dato->FK_DatoCertSolRes = $key->ID_SolRes;
									$dato->save();

								}

								break;

							case '1':
								// "tratamiento tipo: externo ; manifiesto";
								/*se verifica si ya existe un documento con ese tratamiento para esa solicitud de servicio*/
								$manifiestoprevio = Manifiesto::where('FK_ManifTrat', $key->requerimiento->tratamiento->ID_Trat)
								->where('FK_ManifSolser', $id)
								->first();

								if ((isset($manifiestoprevio))&&($manifiestoprevio->FK_ManifTrat == $key->requerimiento->tratamiento->ID_Trat)) {

									$dato = new Manifdato;
									$dato->FK_DatoManif = $manifiestoprevio->ID_Manif;
									$dato->FK_DatoManifSolRes = $key->ID_SolRes;
									$dato->save();

								}else{

									$manifiesto = new Manifiesto;
									$manifiesto->ManifNumero = "";
									$manifiesto->ManifiEspName = "";
									$manifiesto->ManifiEspValue = "";
									$manifiesto->ManifObservacion = "manifiesto con observacion generica";
									$manifiesto->ManifSlug = hash('sha256', rand().time());
									$manifiesto->ManifSrc = 'ManifiestoDefault.pdf';
									$manifiesto->ManifNumRm = "M-16";
									$manifiesto->ManifAuthHseq = 0;
									$manifiesto->ManifAuthDp = 1;
									$manifiesto->ManifAuthJl = 2;
									$manifiesto->ManifAuthJo = 3;
									$manifiesto->ManifAnexo = "anexo de manifiesto ".$key->requerimiento->tratamiento->TratName.$key->requerimiento->tratamiento->FK_TratProv;
									$manifiesto->FK_ManifSolser = $id;
									$manifiesto->FK_ManifCliente = $cliente->ID_Cli;
									$manifiesto->FK_ManifGenerSede = $genersede->ID_GSede;
									$manifiesto->FK_ManifGestor = $key->requerimiento->tratamiento->gestor->FK_SedeCli;
									$manifiesto->FK_ManifTrat = $key->requerimiento->tratamiento->ID_Trat;
									if ($SolicitudServicio->SolSerTipo == 'Externo') {
										$manifiesto->FK_ManifTransp = $cliente->ID_Cli;
									}else{
										$manifiesto->FK_ManifTransp = 1;
									}
									$manifiesto->save();

									$dato = new Manifdato;
									$dato->FK_DatoManif = $manifiesto->ID_Manif;
									$dato->FK_DatoManifSolRes = $key->ID_SolRes;
									$dato->save();
								}

								break;

							default:
								return back()->withErrors(['msg' => ['alguno de los residuos no posee tratamiento asignado favor verifica que su asesor comercial la evaluacion de los residuos.']]);
								break;
						}
					}
				}
			}
		}
	}


	public function pdftest()
	{

		// return view('certificadosExpress.topdf', compact('certificado'));
		// return $certificado;
		$pdf = PDF::setPaper('letter', 'portrait')->loadView('certificadosExpress.topdf', compact('certificado'));

		return $pdf->stream();
	}

    	/*
	*
	* Add all respels into express service
	*
	*/
	public function addAllRespels(SolicitudServicio $SolicitudServicio)
	{
            $Cliente = Cliente::where('ID_Cli', $SolicitudServicio->FK_SolSerCliente)->first();
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

		foreach ($Respels as $Respel) {
				$SolicitudResiduo = new SolicitudResiduo();
				$SolicitudResiduo->SolResKgEnviado = 1;
				$SolicitudResiduo->SolResKgRecibido = 0;
				$SolicitudResiduo->SolResKgConciliado = 0;
				$SolicitudResiduo->SolResKgTratado = 0;
				$SolicitudResiduo->SolResDelete = 0;
				$SolicitudResiduo->SolResSlug = hash('sha256', rand().time().$Respel->RespelSlug);
				$SolicitudResiduo->FK_SolResSolSer =  $SolicitudServicio->ID_SolSer;
                $SolicitudResiduo->SolResEmbalaje = "Sacos/Bolsas";
				$SolicitudResiduo->FK_SolResRg = ResiduosGener::select('ID_SGenerRes')->where('SlugSGenerRes', $Respel->SlugSGenerRes)->first()->ID_SGenerRes;
				/*validar el residuo para saber el tratamiento*/
				$respelref = ResiduosGener::select('FK_Respel')->where('SlugSGenerRes', $Respel->SlugSGenerRes)->first()->FK_Respel;

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

    public function recibotest()
	{
        $recibo = ReciboDePago::find(7);
        $pdf = '';
        $asesor = Personal::find(1);
        $cliente = Cliente::find(276);
        $sede = Sede::find(470);

        return new SolSerExpressRecibo($pdf, $recibo, $asesor, $cliente, $sede);
	}
}
