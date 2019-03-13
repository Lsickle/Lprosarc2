<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\audit;
use App\TrainingPersonal;

class TrainingPersonalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Auth::user()->UsRol === "Programador"){
            $CapaPers = DB::table('training_personals')
                ->join('sedes', 'training_personals.FK_Sede', '=', 'sedes.ID_Sede')
                ->join('trainings', 'training_personals.FK_Capa', '=', 'trainings.ID_Capa')
                ->join('personals', 'training_personals.FK_Pers', '=', 'personals.ID_Pers')
                ->select('training_personals.ID_CapPers','training_personals.CapaPersDate','training_personals.CapaPersExpire','training_personals.CapaPersDelete','sedes.SedeName','trainings.CapaName','personals.PersFirstName','personals.PersLastName')
                ->get();
            return view('TrainingPersonals.index', compact('CapaPers'));
        }
        $CapaPers = DB::table('training_personals')
            ->join('sedes', 'training_personals.FK_Sede', '=', 'sedes.ID_Sede')
            ->join('trainings', 'training_personals.FK_Capa', '=', 'trainings.ID_Capa')
            ->join('personals', 'training_personals.FK_Pers', '=', 'personals.ID_Pers')
            ->select('training_personals.ID_CapPers','training_personals.CapaPersDate','training_personals.CapaPersExpire','training_personals.CapaPersDelete','sedes.SedeName','trainings.CapaName','personals.PersFirstName','personals.PersLastName')
            ->where('training_personals.CapaPersDelete', 0)
            ->get();
        return view('TrainingPersonals.index', compact('CapaPers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Personals = DB::table('personals')
            ->select('ID_Pers', 'PersFirstName', 'PersLastName')
            ->get();
        $Trainings = DB::table('trainings')
            ->select('ID_Capa', 'CapaName')
            ->get();
        $Sedes = DB::table('sedes')
            ->select('ID_Sede', 'SedeName')
            ->get();
        return view('trainingPersonals.create', compact('Personals', 'Trainings', 'Sedes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $CapaPers = new TrainingPersonal();
        $CapaPers->CapaPersDate = $request->input('CapaPersDate');
        $CapaPers->CapaPersExpire = $request->input('CapaPersExpire');
        $CapaPers->FK_Pers = $request->input('FK_Pers');
        $CapaPers->FK_Capa = $request->input('FK_Capa');
        $CapaPers->FK_Sede = $request->input('FK_Sede');
        $CapaPers->CapaPersDelete = 0;
        $CapaPers->save();

        return redirect()->route('capacitacion-personal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $CapaPers = DB::table('training_personals')
            ->select('*')
            ->where('ID_CapPers', $id)
            ->get();
        $Personals = DB::table('personals')
            ->select('ID_Pers', 'PersFirstName', 'PersLastName')
            ->get();
        $Trainings = DB::table('trainings')
            ->select('ID_Capa', 'CapaName')
            ->get();
        $Sedes = DB::table('sedes')
            ->select('ID_Sede', 'SedeName')
            ->get();
        return view('trainingPersonals.edit', compact('CapaPers','Personals','Trainings', 'Sedes'));
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
        $CapaPers = TrainingPersonal::where('ID_CapPers', $id)->first();
        $CapaPers->fill($request->all());
        $CapaPers->FK_Pers = $request->input('FK_Pers');
        $CapaPers->FK_Capa = $request->input('FK_Capa');
        $CapaPers->FK_Sede = $request->input('FK_Sede');
        $CapaPers->save();

        $log = new audit();
        $log->AuditTabla="training_personals";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$CapaPers->ID_CapPers;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('capacitacion-personal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $CapaPers = TrainingPersonal::where('ID_CapPers', $id)->first();
            if ($CapaPers->CapaPersDelete == 0) {
                $CapaPers->CapaPersDelete = 1;
            }
            else{
                $CapaPers->CapaPersDelete = 0;
            }
        $CapaPers->save();

        $log = new audit();
        $log->AuditTabla = "training_personals";
        $log->AuditType = "Eliminado";
        $log->AuditRegistro = $CapaPers->ID_CapPers;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $CapaPers->CapaPersDelete;
        $log->save();

        return redirect()->route('capacitacion-personal.index');
    }
}
