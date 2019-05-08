<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\userController;
use App\Http\Requests\GeneradoresStoreRequest;
use App\Cliente;
use App\GenerSede;
use App\generador;
use App\audit;
use App\Sede;
use App\Departamento;
use App\Municipio;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\auditController;


class genercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
            $Generadors = DB::table('generadors')
            ->join('sedes', 'generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('generadors.*', 'sedes.ID_Sede', 'sedes.SedeName', 'sedes.FK_SedeCli', 'clientes.CliShortname', 'clientes.ID_Cli')
            ->where(function($query){
                $id = userController::IDClienteSegunUsuario();
                if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
                    $query->where('GenerDelete',0);
                    $query->where('ID_Cli', '<>', $id);
                }
                if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
                    $query->where('FK_SedeCli', $id);
                    $query->where('GenerDelete', 0);
                }
            })
            ->get();
            return view('generadores.index', compact('Generadors'));

        }else{
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
            $id = userController::IDClienteSegunUsuario();
            $Sedes = Sede::select('SedeName', 'ID_Sede')->where('FK_SedeCli', $id)->where('SedeDelete', 0)->get();
            $Departamentos = Departamento::all();            
            
            if (old('FK_GSedeMun') !== null){
                $Municipios = Municipio::where('FK_MunCity', old('departamento'))->get();
            }
            return view('generadores.create', compact('Sedes', 'Clientes', 'Departamentos', 'Municipios'));
        }else{
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeneradoresStoreRequest $request)
    {
        $Gener = new generador();
        $Gener->GenerNit = $request->input('GenerNit');
        $Gener->GenerName = $request->input('GenerName');
        $Gener->GenerShortname = $request->input('GenerShortname');
        $Gener->GenerSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Gener->FK_GenerCli = $request->input('FK_GenerCli');
        $Gener->GenerDelete = 0;
        $Gener->save();

        $SGener = new GenerSede();
        $SGener->GSedeName = $request->input('GSedeName');
        $SGener->GSedeAddress = $request->input('GSedeAddress');

        if($request->input('GSedePhone1') === null && $request->input('GSedePhone2') !== null){
            $SGener->GSedePhone1 = $request->input('GSedePhone2');
            $SGener->GSedeExt1 =  $request->input('GSedeExt2');
        }else{
            if($request->input('GSedePhone1') === null){
                $SGener->GSedeExt1 = null;
            }else{
                $SGener->GSedePhone1 = $request->input('GSedePhone1');
                $SGener->GSedeExt1 = $request->input('GSedeExt1');
            }
            if($request->input('GSedePhone2') === null){
                $SGener->GSedeExt2 = null;
            }else{
                $SGener->GSedePhone2 = $request->input('GSedePhone2');
                $SGener->GSedeExt2 =  $request->input('GSedeExt2');
            }
        }

        $SGener->GSedeEmail = $request->input('GSedeEmail');
        $SGener->GSedeCelular = $request->input('GSedeCelular');
        $SGener->GSedeSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $SGener->FK_GSede = $Gener->ID_Gener;
        $SGener->FK_GSedeMun = $request->input('GenerDelete');
        $SGener->GSedeDelete = 0;
        $SGener->save();
    
        return redirect()->route('generadores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Generador = generador::where('GenerSlug',$id)->first();
        $Sede = Sede::where('ID_Sede', $Generador->FK_GenerCli)->first();
        $Cliente = Cliente::where('ID_Cli', $Sede->FK_SedeCli)->first();

        $Respels = DB::table('residuos_geners')
            ->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
            ->where('FK_GSede', '=', $Generador->ID_Gener)
            ->get();

            return view('generadores.show', compact('Generador', 'Sede', 'Cliente', 'Respels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
            $ID_Cli = userController::IDClienteSegunUsuario();
            $Sedes = Sede::select('SedeName', 'ID_Sede')->where('FK_SedeCli', $ID_Cli)->where('SedeDelete', 0)->get();
            $Generador = generador::where('GenerSlug',$id)->first();
            
            return view('generadores.edit', compact('Sedes', 'Generador'));
        }else{
            abot(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Validate = $request->validate([
            'GenerNit'      => ['required', 'min:13', 'max:13', Rule::unique('generadors')->where(function ($query) use ($request, $id){
                $ID_Cli = userController::IDClienteSegunUsuario();
                $Sede = DB::table('sedes')
                    ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                    ->join('generadors', 'sedes.ID_Sede', 'generadors.FK_GenerCli')
                    ->select('generadors.GenerNit', 'generadors.GenerSlug')
                    ->where('ID_Cli', $ID_Cli)
                    ->where('GenerNit', $request->input('GenerNit'))
                    ->where('GenerDelete', 0)
                    ->first();
                    
                    if(isset($Sede)){
                        if($Sede->GenerSlug == $id){
                            $query->where('generadors.GenerNit','=', null);
                        }else{
                            $query->where('generadors.GenerNit','=', $Sede->GenerNit);
                        }
                    }else{
                        $query->where('generadors.GenerNit','=', null);
                    }
            })],
            'GenerName'     => 'required|max:255',
            'GenerShortname'=> 'required|max:64',
            'FK_GenerCli'   => 'required',   
        ]);
        $Generador = generador::where('GenerSlug',$id)->first();
        $Generador->fill($request->all());
        $Generador->save();

        /*codigo para incluir la actualizacion en la tabla de auditoria*/
        $log = new audit();
        $log->AuditTabla="generadors";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Generador->ID_Gener;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('generadores.show', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $generador = generador::where('GenerSlug', $id)->first();
            if ($generador->GenerDelete == 0) {
                $generador->GenerDelete = 1;
            }
            else{
                $generador->GenerDelete = 0;
            }
        $generador->save();

        $log = new audit();
        $log->AuditTabla="generadors";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$generador->ID_Gener;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog = $generador->GenerDelete;
        $log->save();

        return redirect()->route('generadores.index');
    }
}
