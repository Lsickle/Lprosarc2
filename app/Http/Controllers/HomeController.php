<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $Km = DB::table('progvehiculos')
            ->select('FK_ProgVehiculo', 'progVehKm', 'ProgVehFecha')
            ->where('ProgVehDelete', 0)
            ->where('progVehKm', '<>', null)
            ->where('FK_ProgVehiculo', 1)
            ->whereBetween('ProgVehFecha', [date('Y-m-d', strtotime("first day of last month")), date('Y-m-d', strtotime("last day of last month"))])
            ->get();
            // date('m', strtotime('2019-07-31'."+1 day"))
        // return $Km;
        // return date('Y-m-d', strtotime("first day of last month"))." - ".date('Y-m-d', strtotime("last day of last month"));
        if(Auth::user()->UsRol === "Conductor"){
            return redirect()->route('vehicle-programacion.index');
        }
        $Vehiculos = Vehiculo::where('FK_VehiSede', 1)->get();
        if(Auth::user()->UsRol === "Cliente"){
            if(Auth::user()->FK_UserPers === NULL){
                return redirect()->route('clientes.create');
            }else{
                return view('home', compact('Vehiculos'));
            }
        }else{
            return view('home', compact('Vehiculos'));
        }
    }
}