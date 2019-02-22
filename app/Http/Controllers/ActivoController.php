<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activo;
use App\SubcategoriaActivo;
use App\CategoriaActivo;
use Illuminate\Support\Facades\DB;


class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SubActivos = DB::table('subcategoria_activos')
            ->rightJoin('Activos', 'Activos.FK_SubCat', '=', 'subcategoria_activos.ID_SubCat')
            ->leftJoin('categoria_activos', 'subcategoria_activos.FK_SubCat', '=', 'categoria_activos.ID_CatAct')
            ->select('subcategoria_activos.*', 'categoria_activos.CatName', 'Activos.*')
            ->get();

        return view('activos.index', compact('SubActivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $SubActivos = DB::table('subcategoria_activos')
            ->rightJoin('Activos', 'Activos.FK_SubCat', '=', 'subcategoria_activos.ID_SubCat')
            ->leftJoin('categoria_activos', 'subcategoria_activos.FK_SubCat', '=', 'categoria_activos.ID_CatAct')
            ->select('subcategoria_activos.*', 'categoria_activos.CatName', 'Activos.*')
            ->get();
            
        return view('activos.create', compact('SubActivos'));
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
