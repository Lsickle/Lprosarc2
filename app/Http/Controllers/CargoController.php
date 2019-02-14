<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Cargo;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $Cargos = DB::table('cargos')
            ->join('oficces','cargos.CargOfi', '=', 'areas.ID_Area')
            ->select('areas.AreaName','cargos.OfiModule')
            ->get();
        return view('cargos.index', compact('Cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $Oficces = DB::table('oficces')
            ->select('ID_Ofi', 'OfiModule')
            ->get();
        return view('cargos.create', compact('Oficces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $cargo = new Cargo();
        $cargo->CargName = $request->input('NomCarg');
        $cargo->CargSalary= $request->input('CargSalary');
        $cargo->CargGrade = $request->input('CargGrade');
        $cargo->CargOfi= $request->input('SelectOfi');
        $cargo->save();
        return redirect()->route('cargos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
}
