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