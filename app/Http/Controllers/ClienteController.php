<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use Illuminate\Validation\Rule;
use App\Permisos;
use App\Cliente;
use App\Departamento;
use App\Municipio;
use App\Sede;

class ClienteController extends Controller
{
    public function show($slug)
    {
        $cliente = Cliente::where('CliSlug', $slug)->first();
        $Sedes = DB::table('sedes')
            ->join('municipios', 'municipios.ID_Mun', '=', 'sedes.FK_SedeMun')
            ->join('departamentos', 'departamentos.ID_Depart', '=', 'municipios.FK_MunCity')
            ->select('sedes.*', 'municipios.MunName', 'departamentos.DepartName')
            ->where('sedes.FK_SedeCli', $cliente->ID_Cli)
            ->where(function($query){
                if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR)) {
                }else{
                    $query->where('sedes.SedeDelete', '=', 0);
                }
            })
            ->get();

        return view('clientes.show', compact('cliente', 'Sedes'));
    }

    public function edit($slug)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PersInter1)){
            $cliente = Cliente::where('CliSlug', $slug)->first();
            return view('clientes.edit', compact('cliente'));
        }else{
            abort(403);
        }
    }

    public function update(Request $request, $slug)
    {
        $cliente = cliente::where('CliSlug', $slug)->first();
        $validate = $request->validate([
            'CliNit'        => ['required','min:13','max:13',Rule::unique('clientes')->ignore($cliente->CliNit, 'CliNit')],
            'CliName'       => 'required|max:255|min:1',
            'CliShortname'  => 'required|max:255|min:1',
        ]);
            
        $cliente->fill($request->all());
        $cliente->save();
        $slug = $cliente->CliSlug;
        return redirect()->route('cliente-show', compact('slug'));
    }
}
