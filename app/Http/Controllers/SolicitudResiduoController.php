<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SolicitudResiduo;
use App\Http\Requests\SolResUpdateRequest;
use App\audit;
use App\Respel;
use App\Recurso;
use App\ResiduosGener;
use App\SolicitudServicio;
use App\Requerimiento;
use App\ProgramacionVehiculo;
use Permisos;

class SolicitudResiduoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//comparte show con recursos
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
			$SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
			if (!$SolRes) {
				abort(404);
			}
			$SolSer = SolicitudServicio::where('ID_SolSer', $SolRes->FK_SolResSolSer)->first();
			$RespelSgener = ResiduosGener::where('ID_SGenerRes', $SolRes->FK_SolResRg)->first();
			$Respel = DB::table('respels')
				->join('residuos_geners', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
				->join('solicitud_residuos', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
				->select('respels.RespelSlug', 'respels.RespelName', 'respels.ID_Respel')
				->where('residuos_geners.ID_SGenerRes', $SolRes->FK_SolResRg)
				->first();
			$Requerimientos = DB::table('requerimientos')
				->where('requerimientos.FK_ReqRespel', $Respel->ID_Respel)
				->where('requerimientos.ofertado', '=', 1)
				->first();
			// return $Requerimientos;
			if($SolSer->SolSerStatus === 'Programado' || $SolSer->SolSerStatus === 'Completado' || $SolSer->SolSerStatus === 'Conciliado' || $SolSer->SolSerStatus === 'Tratado'  || $SolSer->SolSerStatus === 'Certificacion'){
				abort(403);
			}
			$KGenviados = DB::table('solicitud_residuos')
				->select('SolResKgEnviado')
				->where('FK_SolResSolSer', $SolSer->ID_SolSer)
				->where('ID_SolRes', '<>', $SolRes->ID_SolRes)
				->get();
			$totalenviado = 0;
			foreach ($KGenviados as $KGenviado) {
				$totalenviado = $totalenviado + $KGenviado->SolResKgEnviado;
			}
			return view('solicitud-resid.edit', compact('SolRes', 'Respel', 'RespelSgener', 'SolSer', 'Programacion', 'totalenviado', 'Requerimientos'));
		}else{
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
 
	public function updateSolRes(Request $request, $id){
		$SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
		if (!$SolRes) {
			abort(404);
		}
		$SolSer = SolicitudServicio::where('ID_SolSer', $SolRes->FK_SolResSolSer)->first();

		$Validate = $request->validate([
			'SolResKg'  => 'required|numeric|max:50000|nullable',
			'SolResCantiUnidadRecibida'  => 'numeric|max:50000|nullable',
		]);
		switch($SolSer->SolSerStatus){
			case 'Notificado':
			case 'Programado':
			case 'Notificado':
				if($SolRes->SolResTypeUnidad == 'Litros' || $SolRes->SolResTypeUnidad == 'Unidad'){
					$SolRes->SolResCantiUnidadRecibida = $request->input('SolResCantiUnidadRecibida');
					$SolRes->SolResCantiUnidadConciliada = $request->input('SolResCantiUnidadRecibida');
				}
				$SolRes->SolResKgRecibido = $request->input('SolResKg');
				$SolRes->SolResKgConciliado = $request->input('SolResKg');
				break;
			case 'No Conciliado':
			case 'Completado':
				if($SolRes->SolResTypeUnidad == 'Litros' || $SolRes->SolResTypeUnidad == 'Unidad'){
					$SolRes->SolResCantiUnidadConciliada = $request->input('SolResCantiUnidadConciliada');
					$SolRes->SolResKgConciliado = $request->input('SolResKg');
				}else{
					$SolRes->SolResKgConciliado = $request->input('SolResKg');
				}
				break;
			case 'Conciliado':
				if( $request->input('ValorConciliado') == NULL){
					if($SolRes->SolResTypeUnidad == 'Litros' || $SolRes->SolResTypeUnidad == 'Unidad'){
						$SolRes->SolResCantiUnidadTratada = $request->input('SolResCantiUnidadTratada');
						$SolRes->SolResKgTratado = $request->input('SolResKg');
					}else{
						$SolRes->SolResKgTratado = $request->input('SolResKg');
					}
				}else{
					$SolRes->SolResKgTratado = $request->input('ValorConciliado');
				}

				break;
			default:
				abort(500);
				break;
		}
		$SolRes->save();

		if(isset($request['SupportPay'])){
			if($SolSer->SolSerSupport <> null && file_exists(public_path().'/img/SupportPay/'.$SolSer->SolSerSupport)){
				unlink(public_path().'/img/SupportPay/'.$SolSer->SolSerSupport);
			}
			$fileSupport = $request['SupportPay'];
			$nameSupport = hash('sha256', rand().time().$fileSupport->getClientOriginalName()).'.pdf';
			$fileSupport->move(public_path().'\img\SupportPay/',$nameSupport);
			$SolSer->SolSerSupport = $nameSupport;
			$SolSer->save();
		}

		$log = new audit();
		$log->AuditTabla="solicitud_residuos";
		$log->AuditType="Modificado";
		$log->AuditRegistro=$SolRes->ID_SolRes;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=json_encode($request->all());
		$log->save();

		$id = $SolSer->SolSerSlug;

		return redirect()->route('solicitud-servicio.show', compact('id'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	
	public function updateSolResPrice(Request $request, $id){
		$SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
		if (!$SolRes) {
			abort(404);
		}
		$SolSer = SolicitudServicio::where('ID_SolSer', $SolRes->FK_SolResSolSer)->first();

		$Validate = $request->validate([
			'SolResPrecio'  => 'required|numeric|nullable',
		]);
		$SolRes->SolResPrecio = $request->input('SolResPrecio');
		$SolRes->save();

		$log = new audit();
		$log->AuditTabla="solicitud_residuos";
		$log->AuditType="Modificado el precio";
		$log->AuditRegistro=$SolRes->ID_SolRes;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=json_encode($request->all());
		$log->save();

		$idServicio = $SolSer->SolSerSlug;

		return redirect()->route('solicitud-servicio.show', compact('idServicio'));
	}

	public function update(SolResUpdateRequest $request, $id)
	{
		// return $request;
		$SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
		if (!$SolRes) {
			abort(404);
		}
		$Respel = Respel::select('ID_Respel')->where('RespelSlug', $request->input('FK_SolResSolSer'))->first();
		
		$SolRes->SolResTypeUnidad = $request->input('SolResTypeUnidad');
		$SolRes->SolResCantiUnidad = $request->input('SolResCantiUnidad');
		$SolRes->SolResKgEnviado = $request->input('SolResKgEnviado');
		$SolRes->SolResAlto = $request->input('SolResAlto');
		$SolRes->SolResAncho = $request->input('SolResAncho');
		$SolRes->SolResProfundo = $request->input('SolResProfundo');
		/*se verifica el requerimiento actualmente ofertado para el residuo*/
		$respelgener= ResiduosGener::find($SolRes->FK_SolResRg);

		$requerimientoOfertado = Requerimiento::with(['pretratamientosSelected'])
	        ->where('FK_ReqRespel', '=', $respelgener->FK_Respel)
	        ->where('ofertado', '=', 1)
	        ->first();
		if ($requerimientoOfertado->ReqFotoDescargue==0) {
			$SolRes->SolResFotoDescargue_Pesaje = 0;
		}else{
			$SolRes->SolResFotoDescargue_Pesaje = $request->input('SolResFotoDescargue_Pesaje');
		}

		if ($requerimientoOfertado->ReqFotoDestruccion==0) {
			$SolRes->SolResFotoTratamiento = 0;
		}else{
			$SolRes->SolResFotoTratamiento = $request->input('SolResFotoTratamiento');
		}

		if ($requerimientoOfertado->ReqVideoDescargue==0) {
			$SolRes->SolResVideoDescargue_Pesaje = 0;
		}else{
			$SolRes->SolResVideoDescargue_Pesaje = $request->input('SolResVideoDescargue_Pesaje');
		}

		if ($requerimientoOfertado->ReqVideoDestruccion==0) {
			$SolRes->SolResVideoTratamiento = 0;
		}else{
			$SolRes->SolResVideoTratamiento = $request->input('SolResVideoTratamiento');
		}

		if ($requerimientoOfertado->ReqDevolucion==0) {
			$SolRes->SolResDevolucion = 0;
		}else{
			$SolRes->SolResDevolucion = $request->input('SolResDevolucion');
		}

		if ($requerimientoOfertado->ReqAuditoria==0) {
			$SolRes->SolResAuditoria = 0;
		}else{
			$SolRes->SolResAuditoria = $request->input('SolResAuditoria');
		}
		// $SolRes->SolResFotoDescargue_Pesaje = $request->input('SolResFotoDescargue_Pesaje');
		// $SolRes->SolResFotoTratamiento = $request->input('SolResFotoTratamiento');
		// $SolRes->SolResVideoDescargue_Pesaje = $request->input('SolResVideoDescargue_Pesaje');
		// $SolRes->SolResVideoTratamiento = $request->input('SolResVideoTratamiento');
		// $SolRes->SolResDevolucion = $request->input('SolResDevolucion');
		// $SolRes->SolResAuditoria = $request->input('SolResAuditoria');
		$SolRes->SolResTypeUnidad = $request->input('SolResTypeUnidad');

		switch ($request->input('SolResEmbalaje')) {
			case 99:
				$SolRes->SolResEmbalaje = "Sacos/Bolsas";
				break;
			case 98:
				$SolRes->SolResEmbalaje = "Bidones Pequeños";
				break;
			case 97:
				$SolRes->SolResEmbalaje = "Bidones Grandes";
				break;
			case 96:
				$SolRes->SolResEmbalaje = "Estibas";
				break;
			case 95:
				$SolRes->SolResEmbalaje = "Garrafones/Jerricanes";
				break;
			case 94:
				$SolRes->SolResEmbalaje = "Cajas";
				break;
			case 93:
				$SolRes->SolResEmbalaje = "Cuñetes";
				break;
			case 92:
				$SolRes->SolResEmbalaje = "Big Bags";
				break;
			case 91:
				$SolRes->SolResEmbalaje = "Isotanques";
				break;
			case 90:
				$SolRes->SolResEmbalaje = "Tachos";
				break;
			case 89:
				$SolRes->SolResEmbalaje = "Embalajes Compuestos";
				break;
			case 88:
				$SolRes->SolResEmbalaje = "Granel";
				break;
			default:
				abort(500);
		}
		$SolRes->save();

		$log = new audit();
		$log->AuditTabla="solicitud_residuos";
		$log->AuditType="Modificado";
		$log->AuditRegistro=$SolRes->ID_SolRes;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=json_encode($request->all());
		$log->save();

		return redirect()->route('recurso.show', compact('id'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
		if (!$SolRes) {
			abort(404);
		}
		$Recursos = Recurso::where('FK_RecSolRes', $SolRes->ID_SolRes)->get();
		$SolSer = SolicitudServicio::where('ID_SolSer', $SolRes->FK_SolResSolSer)->first();
		
		$log = new audit();
		$log->AuditTabla="solicitud_residuos";
		$log->AuditType="Eliminado";
		$log->AuditRegistro=$SolRes->ID_SolRes;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$SolRes->SolResDelete;
		$log->save();

		if(is_null($Recursos)){
			foreach($Recursos as $Recurso){
				unlink(public_path("img/Recursos/$Recurso->RecSrc")."/$Recurso->RecRmSrc");
			}
			rmdir(public_path("img/Recursos/").$Recursos[0]->RecSrc);
		}

		SolicitudResiduo::destroy($SolRes->ID_SolRes);
		$id = $SolSer->SolSerSlug;

		return redirect()->route('solicitud-servicio.show', compact('id'));
	}
}
