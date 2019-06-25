<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use Illuminate\Validation\Rule;

use App\Cliente;

class ClienteController extends Controller
{
    public function show($slug)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
            $cliente = Cliente::where('CliSlug', $slug)->first();
            return view('clientes.show', compact('cliente'));
        }else{
            abort(403);
        }
    }

    public function edit($slug)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
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
