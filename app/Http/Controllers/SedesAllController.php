<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Sede;
use App\cliente;
use App\Departamento;
use App\Municipio;
use App\Permisos;

class SedesAllController extends Controller
{
    public function index()
    {
        /*en  consultan todas las sedes que no pertenecen a prosarc*/
        if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) || in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC)){
            $Sedes = DB::table('sedes')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('sedes.*', 'clientes.ID_Cli', 'clientes.CliShortname','municipios.MunName', 'departamentos.DepartName')
                ->where(function($query){
                    $id = userController::IDClienteSegunUsuario();
                    if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
                        $query->where('sedes.FK_SedeCli',  '<>', $id);
                    }else{
                        $query->where('sedes.SedeDelete',  '=', 0);
                        $query->where('sedes.FK_SedeCli',  '<>', $id);
                    }
                })
                ->get();
                return view('sclientes.sedes.index', compact('Sedes'));
        }else{
            abort(403);
        }
    }
    public function show($id)
    {
        $Sede = Sede::where('SedeSlug',$id)->first();
        $Cliente = Cliente::where('ID_Cli', $Sede->FK_SedeCli)->first();
        $Municipio = Municipio::where('ID_Mun', $Sede->FK_SedeMun)->first();
        $Departamento = Departamento::where('ID_Depart', $Municipio->FK_MunCity)->first();

        return view('sclientes.sedes.show', compact('Sede', 'Cliente','Municipio', 'Departamento'));
    }
}
