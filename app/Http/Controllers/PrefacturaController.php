<?php

namespace App\Http\Controllers;

use App\Prefactura;
use Illuminate\Http\Request;

class PrefacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prefacturas = Prefactura::with(['cliente', 'comercial', 'servicio.programacionesrecibidas', 'prefacTratamiento.prefacresiduo'])->get();

        return view('prefacturas.index', compact('prefacturas'));
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
     * @param  \App\Prefactura  $prefactura
     * @return \Illuminate\Http\Response
     */
    public function show(Prefactura $prefactura)
    {
        return view('prefacturas.show', compact('prefactura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prefactura  $prefactura
     * @return \Illuminate\Http\Response
     */
    public function edit(Prefactura $prefactura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prefactura  $prefactura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prefactura $prefactura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prefactura  $prefactura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prefactura $prefactura)
    {
        //
    }
}
