<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\ProgramacionVehiculo;
use App\Http\Requests\CambiodefechaStoreRequest;
use App\Sede;
use App\Area;
use App\Tratamiento;
use App\Pretratamientos;
use App\GenerSede;

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
				->select('residuos_geners.SlugSGenerRes', 'respels.RespelName', 'respels.RespelSlug')
				->where('respels.RespelDelete', 0)
				->where('gener_sedes.GSedeSlug', $slug)
				->where('residuos_geners.DeleteSGenerRes', '=', 0)
				->get();
				return response()->json($Respels);
		}
	}
	
	/*Funcion para ver los requerimientos de un residuo sengun su tratamiento*/
	public function RequeRespel(Request $request, $slug){
		if($request->ajax()){
			$Requerimientos = DB::table('requerimientos')
				->join('respels', 'requerimientos.FK_ReqRespel', '=', 'respels.ID_Respel')
				->join('tarifas', 'requerimientos.ID_Req', '=', 'tarifas.FK_TarifaReq')
				->select('ReqFotoDescargue', 'ReqFotoDestruccion', 'ReqVideoDescargue', 'ReqVideoDestruccion', 'ReqDevolucion', 'ReqDevolucionTipo', 'tarifas.Tarifatipo', 'ReqAuditoria')
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


}
