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
use App\ResiduosGener;
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
            $id = userController::IDClienteSegunUsuario();
            $Generadors = DB::table('generadors')
            ->join('sedes', 'generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('generadors.*', 'sedes.ID_Sede', 'sedes.SedeName', 'sedes.FK_SedeCli', 'clientes.CliShortname', 'clientes.ID_Cli')
            ->where(function($query)use($id){
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
            $Cliente = cliente::select('CliNit')->where('ID_Cli', $id)->first();
            $Gener = generador::select('GenerNit')->where('GenerNit', $Cliente->CliNit)->where('GenerDelete', 0)->first();
            
            return view('generadores.index', compact('Generadors', 'Gener'));

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
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            $id = userController::IDClienteSegunUsuario();
            $Sedes = Sede::select('SedeName', 'ID_Sede')->where('FK_SedeCli', $id)->where('SedeDelete', 0)->get();
            $Cliente = Sede::where('SedeDelete', 0)->get();
            $Departamentos = Departamento::all();            
            
            $Respels = DB::table('respels')
                ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
                ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
                ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                ->where('clientes.ID_Cli', '=', $id)
                ->where('respels.RespelDelete', '=', 0)
                ->get();
            
            if (old('FK_GSedeMun') !== null){
                $Municipios = Municipio::where('FK_MunCity', old('departamento'))->get();
            }
            return view('generadores.create', compact('Sedes', 'Clientes', 'Departamentos', 'Municipios', 'Respels'));
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
        $Gener->GenerCode = $request->input('GenerCode');
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
        $SGener->FK_GSedeMun = $request->input('FK_GSedeMun');
        $SGener->GSedeDelete = 0;
        $SGener->save();

        if($request->input('FK_Respel') !== null){
            foreach($request->FK_Respel as $Respel){ 

                $ResiduoSedeGener = new ResiduosGener();
                $ResiduoSedeGener->FK_SGener = $SGener->ID_GSede;
                $ResiduoSedeGener->FK_Respel = $Respel;
                $ResiduoSedeGener->save();
            }
        }
    
        return redirect()->route('generadores.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSoyGenerador($id)
    {
        $ID_Cli = userController::IDClienteSegunUsuario();
        $Cliente = cliente::where('ID_Cli', $ID_Cli)->first();

        $Sedes = DB::table('sedes')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('sedes.*')
            ->where('FK_SedeCli', '=', $ID_Cli)
            ->where('SedeDelete', '=', 0)
            ->get();

        $Gener = new generador();
        $Gener->GenerNit = $Cliente->CliNit;
        $Gener->GenerName = $Cliente->CliName;
        $Gener->GenerShortname = $Cliente->CliShortname;
        $Gener->GenerSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Gener->FK_GenerCli = $Sedes[0]->ID_Sede;
        $Gener->GenerDelete = $Cliente->CliDelete;
        $Gener->save();

        foreach($Sedes as $Sede){
            $SGener = new GenerSede();
            $SGener->GSedeName = $Sede->SedeName;
            $SGener->GSedeAddress = $Sede->SedeAddress;
            $SGener->GSedePhone1 = $Sede->SedePhone1;
            $SGener->GSedeExt1 = $Sede->SedeExt1;
            $SGener->GSedePhone2 = $Sede->SedePhone2;
            $SGener->GSedeExt2 =  $Sede->SedeExt2;
            $SGener->GSedeEmail = $Sede->SedeEmail;
            $SGener->GSedeCelular = $Sede->SedeCelular;
            $SGener->GSedeSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
            $SGener->FK_GSede = $Gener->ID_Gener;
            $SGener->FK_GSedeMun = $Sede->FK_SedeMun;
            $SGener->GSedeDelete = $Sede->SedeDelete;
            $SGener->save();
        }

        // $id = $Gener->GenerSlug;
        // return redirect()->route('generadores.show', compact('id'));
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
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){

            $Generador = generador::where('GenerSlug',$id)->first();
            $Sede = Sede::where('ID_Sede', $Generador->FK_GenerCli)->first();
            $Cliente = Cliente::where('ID_Cli', $Sede->FK_SedeCli)->first();

            $GenerSedes = DB::table('gener_sedes')
                ->join('generadors', 'generadors.ID_Gener', 'gener_sedes.FK_GSede')
                ->where('FK_GSede', $Generador->ID_Gener)
                ->where('GSedeDelete', 0)
                ->select('gener_sedes.GSedeName', 'gener_sedes.ID_GSede', 'gener_sedes.GSedeSlug', 'gener_sedes.GSedeAddress')
                ->get();

            $Respels = DB::table('residuos_geners')
                ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
                ->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
                ->select('respels.RespelSlug', 'respels.RespelName', 'residuos_geners.ID_SGenerRes', 'gener_sedes.GSedeName', 'residuos_geners.FK_Respel')
                ->where('FK_GSede', '=', $Generador->ID_Gener)
                ->groupBy('respels.ID_Respel')
                ->get();

            $old = old('FK_Respel');
            if (is_array($old)) {
                $Residuos = DB::table('respels')
                    ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
                    ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
                    ->join('generadors', 'generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
                    ->select('respels.ID_Respel', 'respels.RespelName')
                    ->where('generadors.ID_Gener', '=', $Generador->ID_Gener)
                    ->where('RespelDelete', 0)
                    ->groupBy('respels.ID_Respel')
                    ->get();
            }
            return view('generadores.show', compact('Generador', 'Sede', 'Cliente', 'Respels', 'GenerSedes', 'Residuos', 'old'));
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
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
            'GenerCode'     => 'max:32|nullable',  
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
        $Generador = generador::where('GenerSlug', $id)->first();
        $SedesGeners = GenerSede::where('FK_GSede', $Generador->ID_Gener)->get();
        if ($Generador->GenerDelete == 0) {
            $Generador->GenerDelete = 1;
            foreach($SedesGeners as $SedeGener){
                $SedeGener->GSedeDelete = 1;
                $SedeGener->save();

                $log = new audit();
                $log->AuditTabla="gener_sedes";
                $log->AuditType="Eliminado";
                $log->AuditRegistro=$SedeGener->ID_GSede;
                $log->AuditUser=Auth::user()->email;
                $log->Auditlog = $SedeGener->GSedeDelete;
                $log->save();
            }
            $Generador->save();

            $log = new audit();
                $log->AuditTabla="generadors";
                $log->AuditType="Eliminado";
                $log->AuditRegistro=$Generador->ID_Gener;
                $log->AuditUser=Auth::user()->email;
                $log->Auditlog = $Generador->GenerDelete;
                $log->save();
                
                return redirect()->route('generadores.index');
        }
        else{
            $Generador->GenerDelete = 0;
            foreach($SedesGeners as $SedeGener){
                $SedeGener->GSedeDelete = 0;
                $SedeGener->save();

                $log = new audit();
                $log->AuditTabla="gener_sedes";
                $log->AuditType="Restaurado";
                $log->AuditRegistro=$SedeGener->ID_GSede;
                $log->AuditUser=Auth::user()->email;
                $log->Auditlog = $SedeGener->GSedeDelete;
                $log->save();
            }
            $Generador->save();

            $log = new audit();
                $log->AuditTabla="generadors";
                $log->AuditType="Restaurado";
                $log->AuditRegistro=$Generador->ID_Gener;
                $log->AuditUser=Auth::user()->email;
                $log->Auditlog = $Generador->GenerDelete;
                $log->save();

            $id = $Generador->GenerSlug;
            return redirect()->route('generadores.show', compact('id'));
        }
    }
}
