<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Http\Requests\SedeRequest;
use App\Sede;
use App\cliente;
use App\Permisos;
use App\audit;
use App\Municipio;
use App\Departamento;

class auditApp
{
    static public function audit($AuditTabla, $AuditType, $AuditRegistro, $Auditlog){
        $log = new audit();
        $log->AuditTabla = $AuditTabla;
        $log->AuditType = $AuditType;
        $log->AuditRegistro = $AuditRegistro;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $Auditlog;
        $log->save();
    }
}

class SedesAllController extends Controller
{
    public function edit($slug)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) {
            $Sede = Sede::where('SedeSlug',$slug)->first();
            if (!$Sede) {
                abort(404);
            }
            if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
                $Clientes = Cliente::select('ID_Cli','CliShortname')->get();
                $Cliente = Cliente::where('ID_Cli', $Sede->FK_SedeCli)->first();
            }
            $Municipio = Municipio::where('ID_Mun', $Sede->FK_SedeMun)->first();
            $Municipios = Municipio::where('FK_MunCity', $Municipio->FK_MunCity)->get();
            $Departamentos = Departamento::all();
            return view('sclientes.edit', compact('Sede', 'Clientes', 'Cliente', 'Departamentos', 'Municipios', 'Municipio'));
            // return redirect()->route('sclientes.edit', $slug);
        }else{
            abort(403);
        }
    }

    public function update(SedeRequest $request, $slug)
    {
        $Sede = Sede::where('SedeSlug',$slug)->first();
        $Cliente = cliente::select('ID_Cli', 'CliSlug')->where('ID_Cli', $Sede->FK_SedeCli)->first();
        if (!$Sede) {
            abort(404);
        }
        
        $Sede->fill($request->all());
        $Sede->save();

        auditApp::audit("Sedes", "Modificado", $Sede->ID_Sede, $request->all());
        return redirect()->route('cliente-show', [$Cliente->CliSlug]);
    }

    public function destroy($slug)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) {
            $Sede = Sede::where('SedeSlug', $slug)->first();
            $Cliente = cliente::select('ID_Cli', 'CliSlug')->where('ID_Cli', $Sede->FK_SedeCli)->first();
            if (!$Sede) {
                abort(404);
            }
            if ($Sede->SedeDelete == 0) {
                $Sede->SedeDelete = 1;
                $Sede->save();
            }else{
                $Sede->SedeDelete = 0;
                $Sede->save();
            }

            auditApp::audit("sedes", "Eliminado", $Sede->ID_Sede, $Sede->SedeDelete);
            return redirect()->route('clientes.show', [$Cliente->CliSlug]);
        }else{
            abort(403);
        }
    }
}
