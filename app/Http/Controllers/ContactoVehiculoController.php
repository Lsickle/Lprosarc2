<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Vehiculo;
use App\Sede;

class ContactoVehiculoController extends Controller
{
    public function store(Request $request, $id){

        // return 'Hola';
        // $Sede = Sede::where('SedeSlug', $id)->first();
        $Cliente = DB::table('vehiculos')
            ->join('sedes', 'sedes.ID_Sede', 'vehiculos.FK_VehiSede')
            ->join('clientes', 'clientes.ID_Cli', 'sedes.FK_SedeCli')
            ->where('sedes.SedeSlug', $id)
            ->select('sedes.ID_Sede', 'clientes.CliSlug')
            ->first();

        $Vehiculo = new Vehiculo();
        $Vehiculo->VehicPlaca = $request->input('VehicPlaca');
        $Vehiculo->VehicTipo = $request->input('VehicTipo');
        $Vehiculo->VehicCapacidad = $request->input('VehicCapacidad');
        $Vehiculo->VehicInternExtern = 1;
        $Vehiculo->VehicDelete = 0;
        $Vehiculo->FK_VehiSede = $Cliente->ID_Sede;
        $Vehiculo->save();

        $id = $Cliente->CliSlug;
        return redirect()->route('contactos.show', compact('id'));
    }
    public function update(Request $request, $id){
        // $Vehiculo = new Vehiculo();

    }
    public function destroy($id){
        // $Vehiculo = new Vehiculo();

    }
}
