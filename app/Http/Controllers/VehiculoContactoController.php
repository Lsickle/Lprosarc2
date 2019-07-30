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
        $rule = [
            'CreateVehicPlaca'     => 'required|max:7|min:7|unique:vehiculos,VehicPlaca',
            'CreateVehicTipo'      => 'required|max:64',
            'CreateVehicCapacidad' => 'required|numeric|max:999999999999999',
        ];
        $messages = [
            'CreateVehicCapacidad.max' => 'El campo :attribute no debe contener más de 15 caracteres.',
        ];
        $this->validate($request, $rule, $messages);

        $Cliente = DB::table('clientes')
            ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->where('sedes.SedeSlug', '=', $id)
            ->select('sedes.ID_Sede', 'clientes.CliSlug')
            ->first();
        if (!$Cliente) {
            abort(404);
        }

        $Vehiculo = new Vehiculo();
        $Vehiculo->VehicPlaca = $request->input('CreateVehicPlaca');
        $Vehiculo->VehicTipo = $request->input('CreateVehicTipo');
        $Vehiculo->VehicCapacidad = $request->input('CreateVehicCapacidad');
        $Vehiculo->VehicInternExtern = 0;
        $Vehiculo->VehicDelete = 0;
        $Vehiculo->FK_VehiSede = $Cliente->ID_Sede;
        $Vehiculo->save();

        $id = $Cliente->CliSlug;
        return redirect()->route('contactos.show', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $Vehiculo = Vehiculo::where('ID_Vehic', $id)->first();
        if (!$Vehiculo) {
            abort(404);
        }
        $rule = [
            'VehicPlaca'     => 'required|max:7|min:7|unique:vehiculos,VehicPlaca,'.$Vehiculo->VehicPlaca.',VehicPlaca',
            'VehicTipo'      => 'required|max:64',
            'VehicCapacidad' => 'required|numeric|max:999999999999999',
        ];
        $messages = [
            'VehicCapacidad.max' => 'El campo :attribute no debe contener más de 15 caracteres.',
        ];
        $this->validate($request, $rule, $messages);

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
        if (!$Vehiculo) {
            abort(404);
        }
        $Cliente = DB::table('clientes')
            ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->where('sedes.ID_Sede', '=', $Vehiculo->FK_VehiSede)
            ->select('clientes.CliSlug')
            ->first();

        if ($Vehiculo->VehicDelete == 0) {
            $Vehiculo->VehicDelete = 1;
        }else{
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
