<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\audit;
use App\Training;

class TrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Auth::user()->UsRol === "Programador"){
             $Trainings = DB::table('trainings')
                ->select('ID_Capa','CapaName','CapaTipo','CapaDelete')
                ->get();
            return view('trainings.index', compact('Trainings'));
        }
        $Trainings = DB::table('trainings')
            ->select('ID_Capa','CapaName','CapaTipo','CapaDelete')
            ->where('CapaDelete', 0)
            ->get();
        return view('trainings.index', compact('Trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Trainings = new Training();
        $Trainings->CapaName = $request->input('CapaName');
        $Trainings->CapaTipo = $request->input('CapaTipo');
        $Trainings->CapaDelete = 0;
        $Trainings->save();

        return redirect()->route('capacitacion.index');
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
        $training = Training::where('ID_Capa', $id)->first();
        return view('trainings.edit', compact('training'));
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
        $trainings = Training::where('ID_Capa', $id)->first();
        $trainings->fill($request->all());
        $trainings->save();

        $log = new audit();
        $log->AuditTabla="trainings";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$trainings->ID_Capa;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('capacitacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Trainings = Training::where('ID_Capa', $id)->first();
            if ($Trainings->CapaDelete == 0) {
                $Trainings->CapaDelete = 1;
            }
            else{
                $Trainings->CapaDelete = 0;
            }
        $Trainings->save();

        $log = new audit();
        $log->AuditTabla = "Trainings";
        $log->AuditType = "Eliminado";
        $log->AuditRegistro = $Trainings->ID_Capa;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $Trainings->CapaDelete;
        $log->save();

        return redirect()->route('capacitacion.index');
    }
}
