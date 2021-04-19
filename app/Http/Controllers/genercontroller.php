<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\GeneradoresStoreRequest;
use App\Http\Controllers\auditController;
use App\Http\Controllers\userController;
use App\AuditRequest;
use App\audit;
use App\Cliente;
use App\GenerSede;
use App\generador;
use App\Sede;
use App\Departamento;
use App\Municipio;
use App\ResiduosGener;
use App\Permisos;
use App\Respel;



class genercontroller extends Controller
{
    public function __construct()
    {
        $this->tableGener = 'generadors';
        $this->tableSedeGener = 'gener_sedes';
        $this->tableRespelSedeGener = 'residuos_geners';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ID_Cli = userController::IDClienteSegunUsuario();
        $Generadors = DB::table('generadors')
        ->join('sedes', 'generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
        ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
        ->select('generadors.*', 'sedes.SedeName','clientes.CliName')
        ->where(function($query)use($ID_Cli){
            if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC)){
                if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
                    // $query->where('ID_Cli', '<>', $ID_Cli);
                }else{
                    $query->where('GenerDelete', 0);
                    $query->where('ID_Cli', '<>', $ID_Cli);  
                }
            }
            if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
                $query->where('FK_SedeCli', $ID_Cli);
                $query->where('GenerDelete', 0);
            }
        })
        ->get();
        
        // para saber si no se debe mostrar el boton soy gener
        $Cliente = Cliente::select('CliNit')->where('ID_Cli', $ID_Cli)->first();
        $Gener = Generador::select('GenerNit')->where('GenerNit', $Cliente->CliNit)->where('GenerDelete', 0)->first();
        
        return view('generadores.index', compact('Generadors', 'Gener'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)||in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
            $ID_Cli = userController::IDClienteSegunUsuario();
            $Sedes = Sede::select('SedeName', 'SedeSlug')
                ->where('FK_SedeCli', $ID_Cli)
                ->where('SedeDelete', 0)
                ->get();
            $Cliente = Sede::where('SedeDelete', 0)->get();
            $Departamentos = Departamento::all();            
            
            $Respels = DB::table('respels')
                ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
                ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
                ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                ->where('clientes.ID_Cli', '=', $ID_Cli)
                ->whereIn('respels.RespelStatus', ['Aprobado', 'Revisado', 'Falta TDE', 'TDE actualizada'])
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
        $Sede = Sede::select('ID_Sede')->where('SedeSlug', $request->input('FK_GenerCli'))->first();
        
        $Gener = new generador();
        $Gener->GenerNit = $request->input('GenerNit');
        $Gener->GenerName = $request->input('GenerName');
        // $Gener->GenerShortname = $request->input('GenerShortname');
        $Gener->GenerSlug = hash('sha256', rand().time().$Gener->GenerName);
        $Gener->FK_GenerCli = $Sede->ID_Sede;
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
        $SGener->GSedeSlug = hash('sha256', rand().time().$SGener->GSedeName);
        $SGener->FK_GSede = $Gener->ID_Gener;
        $SGener->FK_GSedeMun = $request->input('FK_GSedeMun');
        $SGener->GSedeDelete = 0;
        $SGener->save();

        if($request->input('FK_Respel') !== null){
            foreach($request->FK_Respel as $Respel1){ 
                $Respel2 = Respel::select('ID_Respel')->where('RespelSlug', $Respel1)->first();
                $ResiduoSedeGener = new ResiduosGener();
                $ResiduoSedeGener->FK_SGener = $SGener->ID_GSede;
                $ResiduoSedeGener->FK_Respel = $Respel2->ID_Respel;
                $ResiduoSedeGener->DeleteSGenerRes = 0;
                $ResiduoSedeGener->SlugSGenerRes = hash('sha256', rand().time().$ResiduoSedeGener->FK_Respel);
                $ResiduoSedeGener->save();
            }
        }
    
        return redirect()->route('generadores.show', [$Gener->GenerSlug]);
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
        $Cliente = Cliente::where('ID_Cli', $ID_Cli)->first();

        $Sedes = DB::table('sedes')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('sedes.*')
            ->where('FK_SedeCli', '=', $ID_Cli)
            ->where('SedeDelete', '=', 0)
            ->oldest()
            ->get();

        $Gener = new generador();
        $Gener->GenerNit = $Cliente->CliNit;
        $Gener->GenerName = $Cliente->CliName;
        // $Gener->GenerShortname = $Cliente->CliShortname;
        $Gener->GenerSlug = hash('sha256', rand().time().$Gener->GenerName);
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
            $SGener->GSedeSlug = hash('sha256', rand().time().$SGener->GSedeName);
            $SGener->FK_GSede = $Gener->ID_Gener;
            $SGener->FK_GSedeMun = $Sede->FK_SedeMun;
            $SGener->GSedeDelete = $Sede->SedeDelete;
            $SGener->save();
        }

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
        $Generador = Generador::where('GenerSlug',$id)->first();
        $Sede = Sede::where('ID_Sede', $Generador->FK_GenerCli)->first();
        $Cliente = Cliente::select('clientes.CliName', 'clientes.ID_Cli')->where('ID_Cli', $Sede->FK_SedeCli)->first();
        $GenerSedes = DB::table('gener_sedes')
            ->join('generadors', 'generadors.ID_Gener', 'gener_sedes.FK_GSede')
            ->join('municipios', 'municipios.ID_Mun', 'gener_sedes.FK_GSedeMun')
            ->join('departamentos', 'departamentos.ID_Depart', 'municipios.FK_MunCity')
            ->where('gener_sedes.FK_GSede', $Generador->ID_Gener)
            ->where(function($query){
                if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
                }else{
                    $query->where('GSedeDelete', 0);
                }
            })
            ->select('gener_sedes.GSedeName', 'gener_sedes.ID_GSede', 'gener_sedes.GSedeSlug', 'gener_sedes.GSedeAddress', 'gener_sedes.GSedeDelete', 'municipios.MunName', 'departamentos.DepartName')
            ->get();

        $Respels = DB::table('residuos_geners')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
            ->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->select('respels.RespelSlug', 'respels.RespelName', 'residuos_geners.ID_SGenerRes', 'residuos_geners.SlugSGenerRes', 'gener_sedes.GSedeName', 'residuos_geners.FK_Respel')
            ->where('gener_sedes.FK_GSede', '=', $Generador->ID_Gener)
            ->where('gener_sedes.GSedeDelete', '=', 0)
            ->where('respels.RespelDelete', '=', 0)
            ->whereIn('respels.RespelStatus', ['Aprobado', 'Revisado', 'Falta TDE', 'TDE actualizada'])
            ->where('residuos_geners.DeleteSGenerRes', '=', 0)
            ->groupBy('respels.ID_Respel')
            ->get();

        return view('generadores.show', compact('Generador', 'Sede', 'Cliente', 'Respels', 'GenerSedes', 'Residuos', 'old'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)||in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
            $ID_Cli = userController::IDClienteSegunUsuario();
            $Sedes = Sede::select('SedeName', 'ID_Sede', 'SedeSlug')->where('FK_SedeCli', $ID_Cli)->where('SedeDelete', 0)->get();
            $Generador = Generador::where('GenerSlug',$id)->first();
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
            // 'GenerShortname'=> 'required|max:64',
            'GenerCode'     => 'max:32|nullable',  
            'FK_GenerCli'   => 'required',
        ]);
        $Sede = Sede::select('ID_Sede')->where('SedeSlug',$request->input('FK_GenerCli'))->first();
        $Generador = Generador::where('GenerSlug',$id)->first();
        $Generador->fill($request->except('FK_GenerCli'));
        $Generador->FK_GenerCli = $Sede->ID_Sede;
        $Generador->save();

        /*codigo para incluir la actualizacion en la tabla de auditoria*/
        AuditRequest::auditUpdate($this->tableGener, $Generador->ID_Gener, json_encode($request->all()));

        return redirect()->route('generadores.show', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $Generador = Generador::where('GenerSlug', $slug)->first();
        $SedesGeners = GenerSede::where('FK_GSede', $Generador->ID_Gener)->get();
        $ResiduosSedesGeners = DB::table('residuos_geners')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
            ->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->where('gener_sedes.FK_GSede', '=', $Generador->ID_Gener)
            ->whereIn('respels.RespelStatus', ['Aprobado', 'Revisado', 'Falta TDE', 'TDE actualizada'])
            ->select('residuos_geners.DeleteSGenerRes', 'residuos_geners.ID_SGenerRes')
            ->get();

        if ($Generador->GenerDelete == 0) {
            $Generador->GenerDelete = 1;
            $Generador->save();

            AuditRequest::auditDelete($this->tableGener, $Generador->ID_Gener, $Generador->GenerDelete);

            foreach($SedesGeners as $SedeGener){
                $SedeGener->GSedeDelete = 1;
                $SedeGener->save();

                AuditRequest::auditDelete($this->tableSedeGener, $SedeGener->ID_GSede, $SedeGener->GSedeDelete);
            }

            foreach($ResiduosSedesGeners as $ResiduoSGener){
                DB::table('residuos_geners')
                ->where('residuos_geners.ID_SGenerRes', '=', $ResiduoSGener->ID_SGenerRes)
                ->select('residuos_geners.DeleteSGenerRes')
                ->update(['DeleteSGenerRes' => 1]);

                AuditRequest::auditDelete($this->tableRespelSedeGener, $ResiduoSGener->ID_SGenerRes, 1);
            }
                
            return redirect()->route('generadores.index');

        }else{
            $Generador->GenerDelete = 0;
            $Generador->save();

            AuditRequest::auditRestored($this->tableGener, $Generador->ID_Gener, $Generador->GenerDelete);
            
            foreach($SedesGeners as $SedeGener){
                $SedeGener->GSedeDelete = 0;
                $SedeGener->save();
                
                AuditRequest::auditRestored($this->tableSedeGener, $SedeGener->ID_GSede, $SedeGener->GSedeDelete);
            }
            return redirect()->route('generadores.show', [$Generador->GenerSlug]);
        }
    }
}
