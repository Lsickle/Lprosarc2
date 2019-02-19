<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\TrainingPersonals;

class TrainingPersonalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $CapaPers = DB::table('training_personals')
            ->join('sedes', 'training_personals.FK_Sede', '=', 'sedes.ID_Sede')
            ->join('trainings', 'training_personals.FK_Capa', '=', 'trainings.ID_Capa')
            ->join('personals', 'training_personals.FK_Pers', '=', 'personals.ID_Pers')
            ->select('training_personals.CapaPersDate','training_personals.CapaPersExpire','sedes.SedeName','trainings.CapaName','personals.PersFirstName','personals.PersLastName')
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
