<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Http\Requests\SedeRequest;
use App\AuditRequest;
use App\Sede;
use App\cliente;
use App\Permisos;
use App\audit;
use App\Municipio;
use App\Departamento;

class SedesAllController extends Controller
{
    public function __construct()
    {
        $this->table = 'sedes';
    }

    public function edit($slug)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) {
            $Sede = Sede::where('SedeSlug',$slug)->first();
            if (!$Sede) {
                abort(404);
            }
            $Municipio = Municipio::where('ID_Mun', $Sede->FK_SedeMun)->first();
            $Municipios = Municipio::where('FK_MunCity', $Municipio->FK_MunCity)->get();
            $Departamentos = Departamento::all();
            return view('sclientes.edit', compact('Sede', 'Clientes', 'Cliente', 'Departamentos', 'Municipios', 'Municipio'));
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

        AuditRequest::auditUpdate($this->table, $Sede->ID_Sede, $request->all());
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

            AuditRequest::auditDelete($this->table, $Sede->ID_Sede, $Sede->SedeDelete);
            return redirect()->route('cliente-show', [$Cliente->CliSlug]);
        }else{
            abort(403);
        }
    }
}
