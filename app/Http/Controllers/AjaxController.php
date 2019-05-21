<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Sede;


class AjaxController extends Controller
{
	/*Funcion para ver por medio de Ajax los Municipios que le competen a un Departamento*/
	public function MuniDepart(Request $request, $id)
	{
		if ($request->ajax()) {
			$municipio = DB::table('municipios')
				->select('*')
				->where('FK_MunCity', $id)
				->get();
			return response()->json($municipio);
		}
	}

	/*Funcion para ver por medio de Ajax las Areas que le competen a una Sede*/
	public function AreasSedes(Request $request, $id)
	{
		if ($request->ajax()) {
			$Areas = DB::table('areas')
				->select('*')
				->where('FK_AreaSede', $id)
				->where('AreaDelete', '=', 0)
				->get();
			return response()->json($Areas);
		}
	}

	/*Funcion para ver por medio de Ajax los Cargos que le competen a una Area*/
	public function CargosAreas(Request $request, $id)
	{
		if ($request->ajax()) {
			$Cargos = DB::table('cargos')
				->select('*')
				->where('CargArea', $id)
				->where('CargDelete', '=', 0)
				->get();
			return response()->json($Cargos);
		}
	}

	/*Funcion para ver por medio de Ajax los Respels que le competen a una SGenerador*/
	public function SGenerRespel(Request $request, $id)
	{
		if ($request->ajax()) {
			$SGener = DB::table('gener_sedes')
				->join('generadors', 'generadors.ID_Gener', '=', 'FK_GSede')
				->select('generadors.ID_Gener')
				->where('ID_GSede', '=', $id)
				->first();

			$ResSGeners = DB::table('residuos_geners')
				->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
				->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
				->select('respels.ID_Respel')
				->where('FK_SGener', '=', $id)
				->groupBy('FK_Respel')
				->where('RespelDelete', '=', 0)
				->get();
                
			$Respels = DB::table('respels')
				->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
				->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
				->join('generadors', 'generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
				->select('respels.ID_Respel', 'respels.RespelName')
				->where('generadors.ID_Gener', '=', $SGener->ID_Gener)
				->where(function ($query) use ($ResSGeners){
					foreach ($ResSGeners as $ResSGener) {
						$query->where('respels.ID_Respel', '<>', $ResSGener->ID_Respel);
					}
				})
				// ->whereIn('respels.ID_Respel', $ResSGeners)
				// ->whereIn('respels.ID_Respel', [$ResSGeners->ID_Respel])
				->get();
				
			return response()->json($Respels);
		}
	}
	/*Funcion para ver por medio de Ajax los Vehiculos que le competen a un Contacto*/
	// public function VehiculosContacto(Request $request, $id)
	// {
	// 	if ($request->ajax()) {
	// 		$Vehiculo = DB::table('vehiculos')
	// 			->select('*')
	// 			->where('ID_Vehic', $id)
	// 			->where('VehicDelete', '=', 0)
	// 			->get();
	// 		return response()->json($Vehiculo);
	// 	}
	// }
}
