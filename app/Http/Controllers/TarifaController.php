<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\audit;
use App\Tarifa;
use Illuminate\Http\Request;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarifas = Tarifa::All();
        return view('tarifas.index', compact('tarifas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarifas.create', compact('tarifas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Tarif = new Tarifa();
        $Tarif->TarifaTipounidad1 = $request->input('TarifaTipounidad1');
        $Tarif->TarifaPesoinicial1 = $request->input('TarifaPesoinicial1');
        $Tarif->TarifaPesofinal1 = $request->input('TarifaPesofinal1');
        $Tarif->TarifaPrecio1 = $request->input('TarifaPrecio1');
        $Tarif->TarifaTipounidad2 = $request->input('TarifaTipounidad2');
        $Tarif->TarifaPesoinicial2 = $request->input('TarifaPesoinicial2');
        $Tarif->TarifaPesofinal2 = $request->input('TarifaPesofinal2');
        $Tarif->TarifaPrecio2 = $request->input('TarifaPrecio2');
        $Tarif->TarifaTipounidad3 = $request->input('TarifaTipounidad3');
        $Tarif->TarifaPesoinicial3 = $request->input('TarifaPesoinicial3');
        $Tarif->TarifaPesofinal3 = $request->input('TarifaPesofinal3');
        $Tarif->TarifaPrecio3 = $request->input('TarifaPrecio3');
        $Tarif->TarifaDelete = 0;
        $Tarif->save();

        $log = new audit();
        $log->AuditTabla="tarifas";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Tarif->ID_Tarifa;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('tarifas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarifa $tarifa)
    {   
        if(Auth::user()->UsRol === "Programador"){
            $residuos = DB::table('tarifas')
                ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('cotizacions.*', 'sedes.*', 'clientes.*', 'municipios.*', 'departamentos.*')
                ->get();
        }
        else{
            // $cotizaciones = DB::table('cotizacions')
            //     ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
            //     ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            //     ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
            //     ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
            //     ->select('cotizacions.*', 'sedes.*', 'clientes.*', 'clientes.*','municipios.*', 'departamentos.*')
            //     ->get();
        }
        return view('tarifas.create', compact('tarifa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarifa $tarifa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarifa $tarifa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarifa $tarifa)
    {
        //
    }
}
