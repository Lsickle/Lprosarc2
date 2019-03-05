<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Activo;
use App\MovimientoActivo;


class MovimientoActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Movimientos = DB::table('movimiento_activos')
            ->rightJoin('Activos', 'movimiento_activos.FK_MovInv', '=', 'Activos.ID_Act')
            ->select('movimiento_activos.*', 'Activos.ActName')
            ->get();

        return view('activos.movimientoIndex', compact('Movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Movimientos = DB::table('movimiento_activos')
            ->rightJoin('Activos', 'movimiento_activos.FK_MovInv', '=', 'Activos.ID_Act')
            ->select('movimiento_activos.*', 'Activos.ActName', 'Activos.ID_Act')
            ->get();
        
        $MovimientosAct = DB::table('movimiento_activos')
            ->rightJoin('personals', 'movimiento_activos.FK_ActPerson', '=', 'personals.ID_Pers')
            ->Join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
            ->select('Cargos.CargName',  'personals.PersFirstName', 'personals.ID_Pers')
            ->get();

    return view('activos.movimiento', compact('Movimientos', 'MovimientosAct'));
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
