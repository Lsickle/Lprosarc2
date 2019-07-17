<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\SolicitudServicio;
use App\Vehiculo;
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
        $Vehiculos = Vehiculo::select('VehicPlaca', 'ID_Vehic', 'VehicKmActual')->where('FK_VehiSede', 1)->get();

        $SolicitudServicios = SolicitudServicio::select('SolSerStatus')->get();
        $Pendientes = 0;
        $Aprobadas = 0;
        $Programadas = 0;
        $Recibidas = 0;
        $Concialiadas = 0;
        $Tratadas = 0;
        $Certificadas = 0;
        foreach($SolicitudServicios as $SolicitudServicio){
            switch ($SolicitudServicio->SolSerStatus) {
                case 'Pendiente':
                    $Pendientes++;
                    break;
                case 'Aprobado':
                    $Aprobadas++;
                    break;
                case 'Programado':
                    $Programadas++;
                    break;
                case 'Completado':
                    $Recibidas++;
                    break;
                case 'Conciliado':
                    $Concialiadas++;
                    break;
                case 'Tratado':
                    $Tratadas++;
                    break;
                case 'Certificacion':
                    $Certificadas++;
                    break;
            }
        }
        if(Auth::user()->UsRol === "Cliente"){
            if(Auth::user()->FK_UserPers === NULL){
                return redirect()->route('clientes.create');
            }else{
                return view('home', compact('Pendientes','Aprobadas','Programadas','Recibidas','Concialiadas','Tratadas','Certificadas'));
            }
        }else{
            return view('home', compact('Pendientes','Aprobadas','Programadas','Recibidas','Concialiadas','Tratadas','Certificadas', 'Vehiculos'));
        }
    }
}