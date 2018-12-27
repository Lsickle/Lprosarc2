<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Sede;
use App\GenerSede;
use App\Declaration;

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
        // $Sede->cliente = cliente::with('clientes')->get(); 
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
