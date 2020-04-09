<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SolicitudServicio;
use App\Vehiculo;
use App\Permisos;
use Carbon\Carbon;
use App\ProgramacionVehiculo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $Km = DB::table('progvehiculos')
        //     ->select('FK_ProgVehiculo', 'progVehKm', 'ProgVehFecha')
        //     ->where('ProgVehDelete', 0)
        //     ->where('progVehKm', '<>', null)
        //     ->where('FK_ProgVehiculo', 1)
        //     ->whereBetween('ProgVehFecha', [date('Y-m-d', strtotime("first day of last month")), date('Y-m-d', strtotime("last day of last month"))])
        //     ->get();
        
        // date('m', strtotime('2019-07-31'."+1 day"))
        // return $Km;
        // return date('Y-m-d', strtotime("first day of last month"))." - ".date('Y-m-d', strtotime("last day of last month"));

        $Vehiculos = Vehiculo::where('FK_VehiSede', 1)->get();
      

        switch (Auth::user()->UsRol) {

            case 'Cliente':
                if(Auth::user()->FK_UserPers === NULL){
                    return redirect()->route('clientes.create');
                }else{
                    return view('home', compact('Vehiculos'));
                }
                break;
            
            case 'AsistenteLogistica':
                $SolicitudServicios = DB::table('solicitud_servicios')
                    ->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
                    ->where('SolSerDelete', 0)
                    ->get();
                $Recibidas = count($SolicitudServicios->where('SolSerStatus', 'Completado'));
                $Concialiadas = count($SolicitudServicios->where('SolSerStatus', 'Conciliado'));

                $serviciosnoconciliados = DB::table('solicitud_servicios')
                    ->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
                    ->where('SolSerDelete', 0)
                    ->where('SolSerStatus', 'No Conciliado')
                    ->orderBy('solicitud_servicios.updated_at', 'asc')
                    ->limit(5)
                    ->get();
                    
                // $Km = DB::table('progvehiculos')
                //     ->select('FK_ProgVehiculo', 'progVehKm', 'ProgVehFecha')
                //     ->where('ProgVehDelete', 0)
                //     ->where('progVehKm', '<>', null)
                //     ->whereBetween('ProgVehFecha', [date('Y-m-d', strtotime("first day of last month")), date('Y-m-d', strtotime("last day of last month"))])
                //     ->orderBy('ProgVehFecha', 'asc')
                //     ->get();
                setlocale(LC_ALL, "es_CO.UTF-8");

                $serviciosnoprocesados = DB::table('solicitud_servicios')
                    ->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
                    ->where('SolSerDelete', 0)
                    ->where('SolSerStatus', 'Completado')
                    ->orderBy('solicitud_servicios.updated_at', 'asc')
                    ->limit(5)
                    ->get();
                
                return view('home', compact('Vehiculos', 'serviciosnoprocesados', 'Km', 'serviciosnoconciliados', 'Concialiadas', 'Recibidas', 'SolicitudServicios'));

                break;

            case 'Conductor':
                return redirect()->route('vehicle-programacion.index');
                break;

            case 'JefeLogistica':
                $SolicitudServicios = DB::table('solicitud_servicios')
                    ->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
                    ->where('SolSerDelete', 0)
                    ->get();

                $SolicitudServiciosProg = DB::table('solicitud_servicios')
                    ->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
                    ->join('progvehiculos', 'solicitud_servicios.ID_SolSer', '=', 'progvehiculos.FK_ProgServi')
                    ->select('solicitud_servicios.SolSerSlug','solicitud_servicios.ID_SolSer','solicitud_servicios.updated_at','clientes.CliShortname', 'progvehiculos.ProgVehFecha')
                    ->where('SolSerDelete', 0)
                    ->where('ProgVehDelete', 0)
                    ->where('ProgVehEntrada', null)
                    ->get();

                $Km = DB::table('progvehiculos')
                    ->select('FK_ProgVehiculo', 'progVehKm', 'ProgVehFecha')
                    ->where('ProgVehDelete', 0)
                    ->where('progVehKm', '<>', null)
                    ->whereBetween('ProgVehFecha', [date('Y-m-d', strtotime("first day of last month")), date('Y-m-d', strtotime("last day of last month"))])
                    ->orderBy('ProgVehFecha', 'asc')
                    ->get();
                setlocale(LC_ALL, "es_CO.UTF-8");

                $Pendientes = count($SolicitudServicios->where('SolSerStatus', 'Pendiente'));
                $Aprobadas = count($SolicitudServicios->where('SolSerStatus', 'Aprobado'));
                $Programadas = count($SolicitudServicios->where('SolSerStatus', 'Programado'));
                $Recibidas = count($SolicitudServicios->where('SolSerStatus', 'Completado'));
                $Concialiadas = count($SolicitudServicios->where('SolSerStatus', 'Conciliado'));
                $Tratadas = count($SolicitudServicios->where('SolSerStatus', 'Tratado'));
                $Certificadas = count($SolicitudServicios->where('SolSerStatus', 'Certificacion'));


                $ProgramacionesHoy = $SolicitudServiciosProg->where('ProgVehFecha', '=', date('Y-m-d', strtotime(now())));
                $ProgramacionesMañana = $SolicitudServiciosProg->where('ProgVehFecha', '=', date('Y-m-d', strtotime(now()."+1 day")));

                $serviciosnoprogramados = DB::table('solicitud_servicios')
                    ->join('clientes', 'solicitud_servicios.FK_SolSerCliente', '=', 'clientes.ID_Cli')
                    ->where('SolSerDelete', 0)
                    ->where('SolSerStatus', 'Aprobado')
                    ->orderBy('solicitud_servicios.updated_at', 'asc')
                    ->limit(5)
                    ->get();
                return view('home', compact('SolicitudServicios', 'SolicitudServiciosProg', 'Km', 'Pendientes', 'Aprobadas', 'Programadas', 'Recibidas', 'Concialiadas', 'Tratadas', 'Certificadas', 'ProgramacionesHoy', 'ProgramacionesMañana', 'serviciosnoprogramados', 'Vehiculos'));
                break;

            case 'Supervisor':
                $programacions = DB::table('progvehiculos')
				->join('solicitud_servicios', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
				->join('clientes', 'solicitud_servicios.FK_SolSerCliente', 'clientes.ID_Cli')
				->select('progvehiculos.*', 'solicitud_servicios.ID_SolSer', 'solicitud_servicios.SolSerSlug', 'solicitud_servicios.SolSerVehiculo', 'solicitud_servicios.SolSerConductor', 'clientes.CliName')
				->whereIn('progvehiculos.ProgVehFecha', [today(), Carbon::tomorrow()])
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
                return view('home', compact('programacions', 'personals', 'vehiculos'));
                break;

            case 'value':
                # code...
                break;

            case 'value':
                # code...
                break;

            default:
                return view('home', compact('Vehiculos'));
                break;
        }
    }
}