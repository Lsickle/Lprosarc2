<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;  
use App\audit;
use App\Recurso;
use App\SolicitudServicio;
use App\SolicitudResiduo;
use App\cliente;

class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $Recursos = DB::table('recursos')
            ->join('solicitud_servicios', 'solicitud_servicios.ID_SolSer', '=', 'recursos.FK_RecSol')
            ->select('solicitud_servicios.ID_SolSer', 'recursos.*')
            ->get();
        // $Recursos = Recurso::all();
        // $SolSer = SolicitudServicio::all();
        // $SolRes = SolicitudResiduo::all();

        return view('recursos.index', compact('Recursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Clientes = cliente::all();
        $SolSers = SolicitudServicio::all();
        // $SolRes = SolicitudResiduo::all();

        return view('recursos.create', compact('SolSers', 'Clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $file = $request->file('RecSrc');
        $name = time().$file->getClientOriginalName();

        // $ext = new SplFileInfo($file);
        $file->move(public_path().'/Recursos/'.$request->input("RecName").time(),$name);
        $Src = 'Recursos/'.$request->input("RecName").time().'/'.$name;

        // $extension = pathinfo(getFilename($file), PATHINFO_EXTENSION);

        $Recurso = new Recurso();
        $Recurso->RecName = $request->input("RecName");
        $Recurso->RecTipo = $request->input("RecTipo");
        $Recurso->RecCarte = $request->input("RecCarte");
        $Recurso->RecSrc = $Src;
        $Recurso->RecFormat = '.jpg';
        $Recurso->FK_RecSol = $request->input("FK_RecSol");
        // $Recurso->FK_RecSolRes = $request->input("SolRes");
        $Recurso->save();

        return redirect()->route('recurso.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Recursos = Recurso::where('ID_Rec', $id)->first();

        return view('recursos.show', compact('Recursos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Recursos = Recurso::where('ID_Rec', $id)->first();
        $SolSers = SolicitudServicio::all();

        
        return view('recursos.edit', compact('Recursos', 'SolSers'));
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
        $Recursos = Recurso::where('ID_Rec', $id)->first();
        $SolSer = SolicitudServicio::where('FK_RecSol', $id)->first();
        // $SolRes = SolicitudResiduo::where('FK_RecSolRes', $id)->first();
        $Recurso->fill($request->except('RecSrc'));

        // if ($request->hasfile('RecSrc')) {
        //     $file = $request->file('RecSrc');
        //     $name = time().$file->getClientOriginalName();
        //     $file->move(public_path().'/Recursos/'.$Recursos->input("RecName").time(),$name);
        //     $Src = 'Recursos/'.$request->input("RecName").time().'/'.$name;
        //     $Recurso->RecSrc = $Src;
        // }
        $Recurso->save();

        $log = new audit();
        $log->AuditTabla="recursos";
        $log->AuditType="Modificado";
        $log->AuditRegistro = $Recurso->ID_Rec;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('recurso.index');
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
}
