<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\userController;
use App\Http\Requests\SedeGenerRequest;
use App\AuditRequest;
use App\Generador;
use App\GenerSede;
use App\Sede;
use App\Cliente;
use App\Departamento;
use App\Municipio;
use App\ResiduosGener;
use App\Permisos;
use App\Respel;

class sgenercontroller extends Controller
{
    public function __construct()
    {
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)||in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
            $Departamentos = Departamento::all();
            $ID_Cli = userController::IDClienteSegunUsuario();
            $Generadores = DB::table('generadors')
                ->join('sedes', 'sedes.ID_Sede', 'generadors.FK_GenerCli')
                ->join('clientes', 'clientes.ID_Cli', 'sedes.FK_SedeCli')
                ->select('generadors.ID_Gener', 'generadors.GenerName', 'generadors.GenerSlug')
                ->where('generadors.GenerDelete',0)
                ->where('clientes.ID_Cli', $ID_Cli)
                ->get();

            $Respels = DB::table('respels')
                ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
                ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
                ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                ->where('clientes.ID_Cli', '=', $ID_Cli)
                ->where('respels.RespelDelete', '=', 0)
                ->whereIn('respels.RespelStatus', ['Aprobado', 'Revisado', 'Falta TDE', 'TDE actualizada'])
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
        $Generador = Generador::select('ID_Gener', 'GenerSlug')->where('GenerSlug', $request->input('FK_GSede'))->first();
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
        $GenerSede->GSedeSlug = hash('sha256', rand().time().$GenerSede->GSedeName);
        $GenerSede->FK_GSede = $Generador->ID_Gener;
        $GenerSede->FK_GSedeMun = $request->input('FK_GSedeMun');
        $GenerSede->GSedeDelete = 0;
        $GenerSede->save();

        if($request->input('FK_Respel') !== null){
            foreach($request->FK_Respel as $Respel){ 
                $Respel2 = Respel::select('ID_Respel')->where('RespelSlug', $Respel)->first();

                $ResiduoSedeGener = new ResiduosGener();
                $ResiduoSedeGener->FK_SGener = $GenerSede->ID_GSede;
                $ResiduoSedeGener->FK_Respel = $Respel2->ID_Respel;
                $ResiduoSedeGener->DeleteSGenerRes = 0;
                $ResiduoSedeGener->SlugSGenerRes = hash('sha256', rand().time().$ResiduoSedeGener->FK_Respel);
                $ResiduoSedeGener->save();
            }
        }
        
        return redirect()->route('generadores.show', [$Generador->GenerSlug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $SedeGener = GenerSede::where('GSedeSlug', $id)->first();
        if (!$SedeGener) {
            abort(404);
        }
        $Generador = Generador::where('ID_Gener', $SedeGener->FK_GSede)->first();
        // Cuantas sedes tiene el generador para saber si aparece el boton de eliminan
        $CountSedeGener = GenerSede::where('FK_GSede', $Generador->ID_Gener)->where('GSedeDelete', 0)->get();

        $Municipio = Municipio::where('ID_Mun', $SedeGener->FK_GSedeMun)->first();
        $Departamento = Departamento::where('ID_Depart', $Municipio->FK_MunCity)->first();
        $Cliente = DB::table('gener_sedes')
            ->join('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            ->join('sedes', 'sedes.ID_Sede', '=', 'generadors.FK_GenerCli')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('clientes.CliName', 'clientes.ID_Cli')
            ->where('GSedeSlug', $id)
            ->first();

        $Respels = DB::table('residuos_geners')
            ->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
            ->select('respels.RespelName', 'respels.RespelSlug', 'respels.ID_Respel', 'residuos_geners.ID_SGenerRes', 'residuos_geners.SlugSGenerRes') 
            ->where('residuos_geners.FK_SGener', $SedeGener->ID_GSede)
            ->where('residuos_geners.DeleteSGenerRes', '=', 0)
            ->whereIn('respels.RespelStatus', ['Aprobado', 'Revisado', 'FaltaTDE', 'TDE actualizada'])
            ->where('respels.RespelDelete', '=', 0)
            ->get();

        $Residuos = DB::table('respels')
            ->join('cotizacions', 'cotizacions.ID_Coti', '=', 'respels.FK_RespelCoti')
            ->join('sedes', 'sedes.ID_Sede', '=', 'cotizacions.FK_CotiSede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('respels.ID_Respel', 'respels.RespelName','respels.RespelSlug')
            ->where('clientes.ID_Cli', '=', $Cliente->ID_Cli)
            ->whereIn('respels.RespelStatus', ['Aprobado', 'Revisado', 'Falta TDE', 'TDE actualizada'])
            ->where('cotizacions.CotiStatus', '=', 'Aprobada')
            ->where('respels.RespelDelete', '=', 0)
            ->where(function ($query) use ($Respels){
                foreach ($Respels as $Respel) {
                    $query->where('respels.ID_Respel', '<>', $Respel->ID_Respel);
                }
            })
            ->get();
        return view('sgeneradores.show', compact('SedeGener', 'Generador', 'Cliente', 'Respels', 'Residuos', 'Municipio', 'Departamento', 'CountSedeGener'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)||in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
            $Generadores = DB::table('generadors')
                ->join('sedes', 'sedes.ID_Sede', '=', 'generadors.FK_GenerCli')
                ->join('gener_sedes', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
                ->where('gener_sedes.GSedeSlug', '=', $slug)
                ->where('SedeDelete', '=', 0)
                ->get();

            $GSede = GenerSede::where('GSedeSlug',$slug)->first();
            if (!$GSede) {
                abort(404);
            }
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
    public function update(SedeGenerRequest $request, $slug)
    {
        $GSede = GenerSede::where('GSedeSlug', $slug)->first();
        if (!$GSede) {
            abort(404);
        }
        $Generador = Generador::select('ID_Gener')->where('GenerSlug', $request->input('FK_GSede'))->first();
        $GSede->fill($request->except('FK_GSede'));
        $GSede->FK_GSede = $Generador->ID_Gener;
        $GSede->save();

        AuditRequest::auditUpdate($this->tableSedeGener, $GSede->ID_GSede, json_encode($request->all()));
        
        return redirect()->route('sgeneradores.show', [$GSede->GSedeSlug]);
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
        $Generador = Generador::where('ID_Gener', $Gsede->FK_GSede)->first();
        
        if ($Gsede->GSedeDelete == 0) {
            $Gsede->GSedeDelete = 1;
            $Gsede->save();

            AuditRequest::auditDelete($this->tableSedeGener, $Gsede->ID_GSede, 1);
            
            $ResiduosSGeners = DB::table('residuos_geners')
                ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
                ->where('gener_sedes.ID_GSede', '=', $Gsede->ID_GSede)
                ->select('residuos_geners.ID_SGenerRes')
                ->select('residuos_geners.ID_SGenerRes', 'residuos_geners.DeleteSGenerRes')
                ->get();

            foreach($ResiduosSGeners as $ResiduoSGener){
                DB::table('residuos_geners')
                ->where('residuos_geners.ID_SGenerRes', '=', $ResiduoSGener->ID_SGenerRes)
                ->select('residuos_geners.DeleteSGenerRes')
                ->update(['DeleteSGenerRes' => 1]);
                
                AuditRequest::auditDelete($this->tableRespelSedeGener, $ResiduoSGener->ID_SGenerRes, 1);
            }

            return redirect()->route('generadores.show', [$Generador->GenerSlug]);
        }else{
            $Gsede->GSedeDelete = 0;
            $Gsede->save();    

            AuditRequest::auditRestored($this->tableSedeGener, $Gsede->ID_GSede, 0);

            // No se restauran los ResiduosSedeGener porque podria trerlos duplicados si antes se habian eliminado individualmente  
            return redirect()->route('generadores.show', [$Generador->GenerSlug]);
        }
    }
}
