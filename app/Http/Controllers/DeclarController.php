<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Sede;
use App\GenerSede;
use App\Declaration;
use App\generador;
use App\audit;
use Illuminate\Support\Facades\Auth;
    
class DeclarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Declarations = DB::table('declarations')
            ->join('gener_sedes', 'declarations.DeclarGenerSede', '=', 'gener_sedes.ID_GSede')
            ->join('sedes', 'declarations.DeclarSede', '=', 'sedes.ID_Sede')
            ->join('users', 'declarations.DeclarUser', '=', 'Users.id')
            ->select('declarations.*',
                     'users.id', 
                     'users.name',
                     'sedes.ID_Sede', 
                     'sedes.SedeName' , 
                     'sedes.Cliente', 
                     'gener_sedes.ID_GSede', 
                     'gener_sedes.GSedeName', 
                     'gener_sedes.Generador'
                 )
            ->get();

        return view('declaraciones.index', compact('Declarations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sedes = sede::all();
        $generadores = GenerSede::all();
        return view('declaraciones.create', compact('sedes', 'generadores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Declaration = new Declaration();
        $Declaration->DeclarApply = $request->input('DeclarApply');
        $Declaration->DeclarTipo = $request->input('DeclarTipo');
        $Declaration->DeclarName = $request->input('DeclarName');
        $Declaration->DeclarStatus = 'pendiente';
        $Declaration->DeclarFrecuencia = $request->input('DeclarFrecuencia');
        if ($request->input('DeclarAuditable')=='on') {
            $Declaration->DeclarAuditable='1';
        }
        else{
            $Declaration->DeclarAuditable='0';
        };
        $Declaration->DeclarSede = $request->input('DeclarSede');
        $Declaration->DeclarGenerSede = $request->input('DeclarGenerSede');
        $Declaration->DeclarUser = $request->input('DeclarUser');
        $Declaration->DeclarSlug = 'Declar-'.$request->input('DeclarName');
        $Declaration->save();

        $log = new audit();
        $log->AuditTabla="generadors";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Gener->ID_Gener;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        return redirect()->route('declaraciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $Respels = DB::table('respels')
            ->join('requerimientos', 'respels.RespelReq', '=', 'requerimientos.ID_Req')
            ->join('declarations', 'respels.RespelDeclar', '=', 'declarations.ID_Declar')
            ->join('gener_sedes', 'respels.RespelGenerSede', '=', 'gener_sedes.ID_GSede')
            ->select('respels.*',
                     'requerimientos.*',
                     'declarations.*',
                     'gener_sedes.*'
                 )
            ->get();


        // $declaration = Declaration::where('DeclarSlug',$id)->first();

        $declarationData = Declaration::where('DeclarSlug',$id)
            //datos de cliente y su sede
            ->join('sedes', 'declarations.DeclarSede', '=', 'sedes.ID_Sede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.Cliente')
            //datos de generador y su sede
            ->join('gener_sedes', 'declarations.DeclarGenerSede', '=', 'gener_sedes.ID_GSede')
            ->join('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.Generador')
            //seleccionar todo XD
            ->select('declarations.*', 'sedes.*', 'clientes.*', 'gener_sedes.*', 'generadors.*' )
            ->first();
        // return $declarationData;
        return view('declaraciones.show', compact('declarationData', 'Respels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getSGener(Request $request)
    {
        
        $sedes_id = $request->input('ID_Sede');
        $gener = generador::where('GenerCli','=',$sedes_id)->get();
        $sedegener = GenerSede::where('Generador','=',$gener)->get();
        // $Sede->cliente = cliente::with('clientes')->get(); 
        return view('declaraciones.create', compact('sedes', 'sedegener'));

    }
}
