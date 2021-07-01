<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use Illuminate\Validation\Rule;
use App\AuditRequest;
use App\Permisos;
use App\Cliente;
use App\Departamento;
use App\Municipio;
use App\Sede;

class ClienteController extends Controller
{
    public function show($slug)
    {
        $cliente = Cliente::with('clientetarifa.rangos')->where('CliSlug', $slug)->first();
        if (!$cliente) {
            abort(404);
        }
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

        $SedeSlug = userController::IDSedeSegunUsuario();

        return view('clientes.show', compact('cliente', 'Sedes', 'SedeSlug'));
    }

    public function edit($slug)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PersInter1)){
            $cliente = Cliente::where('CliSlug', $slug)->first();
            if (!$cliente) {
                abort(404);
            }
            return view('clientes.edit', compact('cliente'));
        }else{
            abort(403);
        }
    }

    public function updateCliStatus($slug)
    {
        $cliente = Cliente::where('CliSlug', $slug)->first();
        if (!$cliente) {
            abort(404);
        }
        $cliente->CliStatus = "Autorizado";
        $cliente->save();

        return redirect()->route('cliente-show', [$cliente->CliSlug]);
    }

    public function negarCliStatus($slug)
    {
        $cliente = Cliente::where('CliSlug', $slug)->first();
        if (!$cliente) {
            abort(404);
        }
        $cliente->CliStatus = "Bloqueado";
        $cliente->save();

        return redirect()->route('cliente-show', [$cliente->CliSlug]);
    }

    public function facturacionContado($slug)
    {
        $cliente = Cliente::where('CliSlug', $slug)->first();
        if (!$cliente) {
            abort(404);
        }
        $cliente->TipoFacturacion = "Contado";
        $cliente->save();

        return redirect()->route('cliente-show', [$cliente->CliSlug]);
    }

    public function facturacionCredito($slug)
    {
        $cliente = Cliente::where('CliSlug', $slug)->first();
        if (!$cliente) {
            abort(404);
        }
        $cliente->TipoFacturacion = "Credito";
        $cliente->save();

        return redirect()->route('cliente-show', [$cliente->CliSlug]);
    }

    public function update(Request $request, $slug)
    {
        $cliente = Cliente::where('CliSlug', $slug)->first();
        if (!$cliente) {
            abort(404);
        }
        $validate = $request->validate([
            'CliNit'        => ['required','min:13','max:13',Rule::unique('clientes')->ignore($cliente->CliNit, 'CliNit')],
            'CliName'       => 'required|max:255|min:1',
            'CliShortname'  => 'alpha_num|max:255|min:1',
            'CliRut'        => 'mimes:pdf|max:5120|sometimes',
            'CliCamaraComercio'         => 'mimes:pdf|max:5120|sometimes',
            'CliRepresentanteLegal'     => 'mimes:pdf|max:5120|sometimes',
            'CliCertificaionBancaria'   => 'mimes:pdf|max:5120|sometimes',
            'CliCertificaionComercial'  => 'mimes:pdf|max:5120|sometimes',
            'CliCertificaionComercial2' => 'mimes:pdf|max:5120|sometimes',
        ]);
        $cliente->fill($request->except('CliRut', 'CliCamaraComercio', 'CliRepresentanteLegal', 'CliCertificaionComercial', 'CliCertificaionBancaria'));
        $Folder = $cliente->CliShortname;
        if ($request->hasfile('CliRut')){
            if(isset($cliente->CliRut)  && file_exists(public_path().'/img/DatosClientes/'.$cliente->CliRut)){
                unlink(public_path()."/img/DatosClientes/".$cliente->CliRut);
            }
            $Rut = 'Rut - '.date('j-m-y').hash('sha256', rand().time().$request->CliRut->getClientOriginalName()).'.'.$request->CliRut->extension();
            $request->CliRut->move(public_path('/img/DatosClientes/').$Folder,$Rut);
            $cliente->CliRut = $Folder.'/'.$Rut;
        }
        if ($request->hasfile('CliCamaraComercio')){
            if(isset($cliente->CliCamaraComercio) && file_exists(public_path().'/img/DatosClientes/'.$cliente->CliCamaraComercio)){
                unlink(public_path("img/DatosClientes/$cliente->CliCamaraComercio"));
            }
            $CamaraComercio = 'Camara de Comercio - '.date('j-m-y').hash('sha256', rand().time().$request->CliCamaraComercio->getClientOriginalName()).'.'.$request->CliCamaraComercio->extension();
            $request->CliCamaraComercio->move(public_path('/img/DatosClientes/').$Folder,$CamaraComercio);
            $cliente->CliCamaraComercio = $Folder.'/'.$CamaraComercio;
        }
        if ($request->hasfile('CliRepresentanteLegal')){
            if(isset($cliente->CliRepresentanteLegal)  && file_exists(public_path().'/img/DatosClientes/'.$cliente->CliRepresentanteLegal)) {
                unlink(public_path("img/DatosClientes/$cliente->CliRepresentanteLegal"));
            }
            $RepresentanteLegal = 'Representante Legal - '.date('j-m-y').hash('sha256', rand().time().$request->CliRepresentanteLegal->getClientOriginalName()).'.'.$request->CliRepresentanteLegal->extension();
            $request->CliRepresentanteLegal->move(public_path('/img/DatosClientes/').$Folder,$RepresentanteLegal);
            $cliente->CliRepresentanteLegal = $Folder.'/'.$RepresentanteLegal;
        }
        if ($request->hasfile('CliCertificaionComercial')){
            if(isset($cliente->CliCertificaionComercial) && file_exists(public_path().'/img/DatosClientes/'.$cliente->CliCertificaionComercial)){
                unlink(public_path("img/DatosClientes/$cliente->CliCertificaionComercial"));
            }
            $CertificacionComercial = 'Certificacion Comercial - '.date('j-m-y').hash('sha256', rand().time().$request->CliCertificaionComercial->getClientOriginalName()).'.'.$request->CliCertificaionComercial->extension();
            $request->CliCertificaionComercial->move(public_path('/img/DatosClientes/').$Folder,$CertificacionComercial);
            $cliente->CliCertificaionComercial = $Folder.'/'.$CertificacionComercial;
        }
        if ($request->hasfile('CliCertificaionComercial2')){
            if(isset($cliente->CliCertificaionComercial2) && file_exists(public_path().'/img/DatosClientes/'.$cliente->CliCertificaionComercial2)){
                unlink(public_path("img/DatosClientes/$cliente->CliCertificaionComercial2"));
            }
            $CertificacionComercial2 = 'Certificacion Comercial - '.date('j-m-y').hash('sha256', rand().time().$request->CliCertificaionComercial2->getClientOriginalName()).'.'.$request->CliCertificaionComercial2->extension();
            $request->CliCertificaionComercial2->move(public_path('/img/DatosClientes/').$Folder,$CertificacionComercial2);
            $cliente->CliCertificaionComercial2 = $Folder.'/'.$CertificacionComercial2;
        }
        if ($request->hasfile('CliCertificaionBancaria')){
            if(isset($cliente->CliCertificaionBancaria) && file_exists(public_path().'/img/DatosClientes/'.$cliente->CliCertificaionBancaria)){
                unlink(public_path("img/DatosClientes/$cliente->CliCertificaionBancaria"));
            }
            $CertificacionBancaria = 'Certificacion Bancaria - '.date('j-m-y').hash('sha256', rand().time().$request->CliCertificaionBancaria->getClientOriginalName()).'.'.$request->CliCertificaionBancaria->extension();
            $request->CliCertificaionBancaria->move(public_path('/img/DatosClientes/').$Folder,$CertificacionBancaria);
            $cliente->CliCertificaionBancaria = $Folder.'/'.$CertificacionBancaria;
        }
        $cliente->save();

        AuditRequest::auditUpdate('clientes', $cliente->ID_Cli, json_encode($request->all()));
        return redirect()->route('cliente-show', [$cliente->CliSlug]);
    }
}
