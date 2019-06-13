<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ProgramacionVehiculo;
use App\Sede;
use PDF;


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
			return trans('adminlte_lang::message.progvehceditsuccess');
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
				->where('residuos_geners.DeleteSGenerRes', '=', 0)
				->groupBy('FK_Respel')
				->where('RespelDelete', '=', 0)
				->where('RespelStatus', '=', 'Aprobado')
				->where('RespelStatus', '=', 'Incompleta')
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

	/*Funcion para ver los residuos de una sede de generador*/
	public function RespelGener(Request $request, $slug){
		if ($request->ajax()){
			$Respels = DB::table('residuos_geners')
				->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
				->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
				->select('residuos_geners.SlugSGenerRes', 'respels.RespelName', 'respels.RespelSlug')
				->where('gener_sedes.GSedeSlug', $slug)
				->get();
			return $Respels;
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

	/*Funcion para ver los requerimientos de un residuo sengun su tratamiento*/
	public function RequeRespel(Request $request, $slug){
		if($request->ajax()){
			$Requerimientos = DB::table('requerimientos')
				->join('respels', 'requerimientos.FK_ReqRespel', '=', 'respels.ID_Respel')
				->select('requerimientos.ReqFotoDescargue', 'requerimientos.ReqFotoDestruccion', 'requerimientos.ReqVideoDescargue', 'requerimientos.ReqVideoDestruccion')
				->where('respels.RespelSlug', $slug)
				->get();
			return $Requerimientos;
		}
	}

	public function generatePDF()

	    {

	        $data = ['title' => 'Welcome to HDTuto.com'];

	        $pdf = PDF::loadView('layouts.partials.myPDF', $data);
	        $title = 'prueba.pdf';
	  		return view('layouts.partials.myPDF', compact('title'));
	        // return $pdf->download('Prueba.pdf');

	    }
}
