<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Sede;
use App\Cliente;
use App\audit;
use App\Departamento;
use App\Municipio;
use App\Tratamiento;
use App\Pretratamiento;
use App\Clasificacion;
use App\Respel;
use App\Requerimiento;
use App\Permisos;

class ClienteTarifasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* se indexara todos las tarifas de los clientes con sus tratamientos respectivo y cada tarifa con sus rangos*/
        $tarifas = CTarifa::with(['cliente', 'clasificaciones'])
        ->join('sedes', 'tratamientos.FK_TratProv', '=', 'sedes.ID_Sede')
        ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
        ->where('TratDelete', 0)
        ->get();
        // return $tratamientos;
        // return $depart;
        return view('cliente_tratamientos.index', compact('tratamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  string  $CliSlug
     */
    public function create($CliSlug)
    {

        $cliente = Cliente::where('CliSlug', $CliSlug)->with(['clientetarifa.rangos', 'clientetarifa.tratamiento'])->first();
        // return $cliente;
        $tratamientos = Tratamiento::where('FK_TratProv', 1)->get();

        return view('cliente_tarifas.create', compact(['cliente', 'tratamientos']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
*    * @param  string  $CliSlug
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $CliSlug)
    {
        return $request;
        $cliente = Cliente::where('CliSlug', $CliSlug)->with(['clientetarifa.rangos', 'clientetarifa.tratamiento'])->first();

        return $cliente;
        return 'hello World';
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
