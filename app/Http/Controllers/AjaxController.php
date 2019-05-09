<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ProgramacionVehiculo;
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
	/*Funcion para cambiar el dia y hora de la programacion de un Vehiculo*/
	public function CambioDeFecha(Request $request, $id){
		if ($request->ajax()) {
			$fecha = date('Y-m-d', strtotime(substr($request->Event, 0, -1)));
			$hora = date('H:i:s', strtotime(substr($request->Event, 0, -1)));
			$eventos = ProgramacionVehiculo::where('ID_ProgVeh', $id)->first();
			$eventos->ProgVehFecha = $fecha;
			$eventos->ProgVehSalida = $fecha." ".$hora;
			$eventos->save();
			$Mensaje = "Se  ha actualizado la programación";
			return $Mensaje;
		}
	}
}