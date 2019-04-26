<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
				->get();
			return response()->json($Cargos);
		}
	}
	/*Funcion para ver por medio de Ajax si una Persona ya se encuentra registrada*/
	public function VerifDocumentPersonal(Request $request, $id)
	{
		if ($request->ajax()) {
			$Verif = DB::table('personals')
				->select('ID_Pers')
				->where('PersDocNumber', $id)
				->get();
			// return response()->json($Verif);
			if(count($Verif) > 0){
				return !http_response_code(200);
			}
			else{
				return http_response_code(200);
			}
		}
	}
}
