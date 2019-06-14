<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Http\Requests\SedeGenerRequest;
use App\audit;
use App\generador;
use App\GenerSede;
use App\Sede;
use App\Cliente;
use App\Departamento;
use App\Municipio;
use App\ResiduosGener;

class sgenercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            $Gsedes = DB::table('gener_sedes')
                ->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
                ->join('sedes', 'sedes.ID_Sede', 'generadors.FK_GenerCli')
                ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                ->join('municipios', 'gener_sedes.FK_GSedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('gener_sedes.GSedeName','gener_sedes.GSedeAddress', 'gener_sedes.GSedeEmail', 'gener_sedes.GSedeCelular', 'gener_sedes.GSedeDelete', 'gener_sedes.GSedeSlug',  'generadors.GenerShortname','municipios.MunName', 'departamentos.DepartName', 'clientes.CliShortname')
                ->where(function($query){
                    $id = userController::IDClienteSegunUsuario();
                    if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
                        $query->where('gener_sedes.GSedeDelete',0);
                    }
                    if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
                        $query->where('gener_sedes.GSedeDelete',0);
                        $query->where('Sedes.FK_SedeCli', $id);
                    }
                })
                ->get();
            return view('sgeneradores.index', compact('Gsedes'));
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
            $Departamentos = Departamento::all();
            $Generadores = DB::table('generadors')
                ->join('sedes', 'sedes.ID_Sede', 'generadors.FK_GenerCli')
                ->select('generadors.ID_Gener', 'generadors.GenerName')
                ->where('generadors.GenerDelete',0)
                ->where('Sedes.FK_SedeCli', $id)
                ->get();
            $Respels = DB::table('respels')
                ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
                ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
                ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                ->where('clientes.ID_Cli', '=', $id)
                ->where('respels.RespelDelete', '=', 0)
                ->whereIn('respels.RespelStatus', ['Aprobado', 'Incompleta'])
                ->get();
            if (old('FK_GSedeMun') !== null){
                $Municipios = Municipio::where('FK_MunCity', old('departamento'))->get();
            }
            return view('sgeneradores.create', compact('Generadores', 'Departamentos', 'Municipios', 'Respels'));
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
    public function store(SedeGenerRequest $request)
    {
        $GenerSede = new GenerSede();
        $GenerSede->GSedeName = $request->input('GSedeName');
        $GenerSede->GSedeAddress = $request->input('GSedeAddress');

        if($request->input('GSedePhone1') === null && $request->input('GSedePhone2') !== null){
            $GenerSede->GSedePhone1 = $request->input('GSedePhone2');
            $GenerSede->GSedeExt1 =  $request->input('GSedeExt2');
        }else{
            if($request->input('GSedePhone1') === null){
                $GenerSede->GSedeExt1 = null;
            }else{
                $GenerSede->GSedePhone1 = $request->input('GSedePhone1');
                $GenerSede->GSedeExt1 = $request->input('GSedeExt1');
            }
            if($request->input('GSedePhone2') === null){
                $GenerSede->GSedeExt2 = null;
            }else{
                $GenerSede->GSedePhone2 = $request->input('GSedePhone2');
                $GenerSede->GSedeExt2 =  $request->input('GSedeExt2');
            }
        }
        $GenerSede->GSedeEmail = $request->input('GSedeEmail');
        $GenerSede->GSedeCelular = $request->input('GSedeCelular');
        $GenerSede->GSedeSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $GenerSede->FK_GSede = $request->input('FK_GSede');
        $GenerSede->FK_GSedeMun = $request->input('FK_GSedeMun');
        $GenerSede->GSedeDelete = 0;
        $GenerSede->save();

        if($request->input('FK_Respel') !== null){
            foreach($request->FK_Respel as $Respel){ 

                $ResiduoSedeGener = new ResiduosGener();
                $ResiduoSedeGener->FK_SGener = $GenerSede->ID_GSede;
                $ResiduoSedeGener->FK_Respel = $Respel;
                $ResiduoSedeGener->DeleteSGenerRes = 0;
                $ResiduoSedeGener->SlugSGenerRes = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
                $ResiduoSedeGener->save();
            }
        }

        return redirect()->route('sgeneradores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            $SedeGener = GenerSede::where('GSedeSlug',$id)->first();
            $Generador = generador::where('ID_Gener',$SedeGener->FK_GSede)->first();
            $Municipio = Municipio::where('ID_Mun', $SedeGener->FK_GSedeMun)->first();
            $Departamento = Departamento::where('ID_Depart', $Municipio->FK_MunCity)->first();
            $Cliente = Cliente::select('clientes.CliShortname', 'clientes.ID_Cli')->where('ID_Cli', userController::IDClienteSegunUsuario())->first();

            $Respels = DB::table('residuos_geners')
                ->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
                ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
                ->select('respels.RespelName', 'respels.RespelSlug', 'respels.ID_Respel', 'residuos_geners.ID_SGenerRes', 'residuos_geners.SlugSGenerRes') 
                ->where('residuos_geners.FK_SGener', $SedeGener->ID_GSede)
                ->where('residuos_geners.DeleteSGenerRes', '=', 0)
                ->whereIn('respels.RespelStatus', ['Aprobado', 'Incompleta'])
                ->where('respels.RespelDelete', '=', 0)
                ->get();

            $Residuos = DB::table('respels')
                ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
                ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
                ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                ->select('respels.ID_Respel', 'respels.RespelName')
                ->where('clientes.ID_Cli', '=', $Cliente->ID_Cli)
                ->whereIn('respels.RespelStatus', ['Aprobado', 'Incompleta'])
                ->where('respels.RespelDelete', '=', 0)
                ->where(function ($query) use ($Respels){
                    foreach ($Respels as $Respel) {
                        $query->where('respels.ID_Respel', '<>', $Respel->ID_Respel);
                    }
                })
                ->get();
        }else{
            abort(403);
        }

        return view('sgeneradores.show', compact('SedeGener', 'Generador', 'Cliente', 'Respels', 'Residuos', 'Municipio', 'Departamento'));
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
            $Generadores = DB::table('generadors')
                ->join('sedes', 'sedes.ID_Sede', '=', 'generadors.FK_GenerCli')
                ->where('FK_SedeCli', '=', $ID_Cli)
                ->where('SedeDelete', '=', 0)
                ->get();

            $GSede = GenerSede::where('GSedeSlug',$id)->first();

            $Municipio = Municipio::where('ID_Mun', $GSede->FK_GSedeMun)->first();
            $Municipios = Municipio::where('FK_MunCity', $Municipio->FK_MunCity)->get();
            $Departamentos = Departamento::all();
        }else{
            abort(403);
        }

        return view('sgeneradores.edit', compact('GSede', 'Generadores', 'Departamentos', 'Municipios', 'Municipio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SedeGenerRequest $request, $id)
    {
        $GSede = GenerSede::where('GSedeSlug',$id)->first();
        $GSede->fill($request->except('created_at'));
        $GSede->save();

        $log = new audit();
        $log->AuditTabla = "gener_sedes";
        $log->AuditType = "Modificado";
        $log->AuditRegistro = $GSede->ID_GSede;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        
        $id = $GSede->GSedeSlug;
        return redirect()->route('sgeneradores.show', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Gsede = GenerSede::where('GSedeSlug', $id)->first();

        
        if ($Gsede->GSedeDelete == 0) {
            $Gsede->GSedeDelete = 1;
            $Gsede->save();          

            $ResiduosSGeners = DB::table('residuos_geners')
                ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
                ->where('gener_sedes.ID_GSede', '=', $Gsede->ID_GSede)
                ->select('residuos_geners.ID_SGenerRes', 'residuos_geners.DeleteSGenerRes')
                ->update(['DeleteSGenerRes' => 1]);
            
            $ResiduosSGeners = DB::table('residuos_geners')
                ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
                ->where('gener_sedes.ID_GSede', '=', $Gsede->ID_GSede)
                ->select('residuos_geners.ID_SGenerRes')
                ->select('residuos_geners.ID_SGenerRes', 'residuos_geners.DeleteSGenerRes')
                ->get();

            foreach($ResiduosSGeners as $ResiduoSGener){

                $log = new audit();
                $log->AuditTabla="residuos_geners";
                $log->AuditType="Eliminado";
                $log->AuditRegistro=$ResiduoSGener->ID_SGenerRes;
                $log->AuditUser=Auth::user()->email;
                $log->Auditlog = $ResiduoSGener->DeleteSGenerRes;
                $log->save();
            }

            $log = new audit();
            $log->AuditTabla="gener_sedes";
            $log->AuditType="Eliminado";
            $log->AuditRegistro=$Gsede->ID_GSede;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog = $Gsede->GSedeDelete;
            $log->save();

            return redirect()->route('sgeneradores.index');
        }
        else{
            $Gsede->GSedeDelete = 0;
            $Gsede->save();    
            
            $log = new audit();
            $log->AuditTabla="gener_sedes";
            $log->AuditType="Restaurado";
            $log->AuditRegistro=$Gsede->ID_GSede;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog = $Gsede->GSedeDelete;
            $log->save();
            
            $ResiduosSGeners = DB::table('residuos_geners')
                ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
                ->where('gener_sedes.ID_GSede', '=', $Gsede->ID_GSede)
                ->select('residuos_geners.ID_SGenerRes', 'residuos_geners.DeleteSGenerRes')
                ->update(['DeleteSGenerRes' => 0]);
            
            $ResiduosSGeners = DB::table('residuos_geners')
                ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
                ->where('gener_sedes.ID_GSede', '=', $Gsede->ID_GSede)
                ->select('residuos_geners.ID_SGenerRes', 'residuos_geners.DeleteSGenerRes')
                ->get();

            foreach($ResiduosSGeners as $ResiduoSGener){

                $log = new audit();
                $log->AuditTabla="residuos_geners";
                $log->AuditType="Eliminado";
                $log->AuditRegistro=$ResiduoSGener->ID_SGenerRes;
                $log->AuditUser=Auth::user()->email;
                $log->Auditlog = $ResiduoSGener->DeleteSGenerRes;
                $log->save();
            }

            $id = $Gsede->GSedeSlug;

            return redirect()->route('sgeneradores.show', compact('id'));
        }
    }
}
