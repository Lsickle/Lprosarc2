<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Vehiculo;
use App\audit;

class VehiculoContactoController extends Controller
{
    public function store(Request $request, $id)
    {
        $Validate = $request->validate([
            'VehicPlaca' => 'required|max:9|min:9|unique:vehiculos,VehicPlaca',
            'VehicTipo' => 'required|max:64|',
            'VehicCapacidad' => 'required|max:64|',
        ]);

        $Cliente = DB::table('clientes')
            ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->where('sedes.SedeSlug', '=', $id)
            ->select('sedes.ID_Sede', 'clientes.CliSlug')
            ->first();

        $Vehiculo = new Vehiculo();
        $Vehiculo->VehicPlaca = $request->input('VehicPlaca');
        $Vehiculo->VehicTipo = $request->input('VehicTipo');
        $Vehiculo->VehicCapacidad = $request->input('VehicCapacidad');
        $Vehiculo->VehicInternExtern = 1;//vehiculo externo
        $Vehiculo->VehicDelete = 0;
        $Vehiculo->FK_VehiSede = $Cliente->ID_Sede;
        $Vehiculo->save();

        $id = $Cliente->CliSlug;
        return redirect()->route('contactos.show', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $Validate = $request->validate([
            'VehicPlaca' => 'required|max:7|min:7|unique:vehiculos,VehicPlaca',
            'VehicTipo' => 'required|max:64',
            'VehicCapacidad' => 'required|max:64',
        ]);

        $Vehiculo = Vehiculo::where('ID_Vehic', $id)->first();

        $Cliente = DB::table('clientes')
            ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->where('sedes.ID_Sede', '=', $Vehiculo->FK_VehiSede)
            ->select('clientes.CliSlug')
            ->first();

        $Vehiculo->fill($request->all());
        $Vehiculo->save();
        
        $log = new audit();
        $log->AuditTabla="vehiculos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Vehiculo->ID_Vehic;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog = json_encode($request->all());
        $log->save();

        $id = $Cliente->CliSlug;
        return redirect()->route('contactos.show', compact('id'));
    }

    public function destroy(Request $request, $id)
    {
        $Vehiculo = Vehiculo::where('ID_Vehic', $id)->first();

        $Cliente = DB::table('clientes')
            ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->where('sedes.ID_Sede', '=', $Vehiculo->FK_VehiSede)
            ->select('clientes.CliSlug')
            ->first();

        if ($Vehiculo->VehicDelete == 0) {
            $Vehiculo->VehicDelete = 1;
        }
        else{
            $Vehiculo->VehicDelete = 0;
        }
        $Vehiculo->save();

        $log = new audit();
        $log->AuditTabla="vehiculos";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$Vehiculo->ID_Vehic;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog = $Vehiculo->VehicDelete;
        $log->save();

        $id = $Cliente->CliSlug;
        return redirect()->route('contactos.show', compact('id'));
    }
}
