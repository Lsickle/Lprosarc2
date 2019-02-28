<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Assistance;

class AssistancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $Asistencias = DB::table('assistances')
        ->join('personals', 'assistances.FK_AsisPers', '=', 'personals.ID_Pers')
        ->select('personals.PersFirstName','personals.PersLastName','personals.PersDocNumber', 'assistances.AsisFecha', 'assistances.AsisLlegada', 'assistances.AsisSalida', 'assistances.AsisStatus')
        ->get();
        return view('assistances.index', compact('Asistencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $Asistencias = DB::table('assistances')
        ->select('FK_AsisPers','ID_Asis','AsisSalida')
        ->where([['AsisFecha', '=', date('Y-m-d')],['AsisSalida', '=', null]])
        ->get();
        $personal = DB::table('personals')
        ->select('*')
        ->get();
        /*$contadorAsis = count($Asistencias);*/
        $contadorPers = count($personal);
        $contador = 0;
        /*return $Asistencias;*/
        return view('assistances.create',compact('Asistencias','personal','contador','contadorPers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $Asistencia = new Assistance();
        $Asistencia->AsisLlegada = now();
        $Asistencia->AsisFecha = date('Y-m-d');
        $Asistencia->AsisStatus = 1;
        $Asistencia->FK_AsisPers = $request->input('AsisPers');
        $Asistencia->save();
        return redirect()->route('asistencia.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $Asistencia  = Assistance::where('ID_Asis',$id)->first();
        $Asistencia->AsisSalida = now();
        $Asistencia->AsisNocturnas = $Asistencia->AsisSalida->diffInHours($Asistencia->AsisLlegada);
        $Asistencia->AsisStatus = 0;
        $Asistencia->save();
        return redirect()->route('asistencia.create');
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
