<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\audit;
use App\Tarifa;
use App\Sede;
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
        // $tarifas = Tarifa::All();

        $Requerimientos = DB::table('requerimientos')
				->join('tarifas', 'requerimientos.ID_Req', '=', 'tarifas.FK_TarifaReq')
				->join('tratamientos', 'requerimientos.FK_ReqTrata', '=', 'tratamientos.ID_Trat')
				->select('tarifas.*', 'requerimientos.*', 'tratamientos.*')
				->where('tratamientos.TratName', 'Posconsumo luminarias')
				->where('requerimientos.ofertado', 1)
				->where('requerimientos.forevaluation', 1)
                ->get();
        // return $Requerimientos;
        $conteo = 0;
        
        foreach ($Requerimientos as $key => $requerimiento) {
            $tarifa = Tarifa::where('FK_TarifaReq', $requerimiento->ID_Req)->first();
            if ($tarifa->Tarifatipo == 'Kg') {
                $tarifa->Tarifatipo = 'Unid';
                $conteo++;
            }
            $tarifa->save();
        }

        return $conteo;


        if(Auth::user()->UsRol === "Programador"){
            $tarifas = Tarifa::All();
        }
        else{
            $tarifas = Tarifa::where('tarifas.TarifaDelete', 0)->get();;
        }
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
            $Tarifarelacionada = DB::table('tarifas')
                ->join('requerimientos', 'requerimientos.FK_ReqTarifa', '=', 'tarifas.ID_Tarifa')
                ->join('tratamientos', 'requerimientos.FK_ReqTrata', '=', 'tratamientos.ID_Trat')
                ->join('respels', 'requerimientos.FK_ReqRespel', '=', 'respels.ID_Respel')
                ->join('cotizacions', 'respels.FK_RespelCoti', '=', 'cotizacions.ID_Coti')
                ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->where('requerimientos.FK_ReqTarifa', $tarifa->ID_Tarifa)
                ->select('tarifas.*', 'requerimientos.*', 'tratamientos.*', 'respels.*', 'cotizacions.*', 'sedes.*', 'clientes.*', 'municipios.*', 'departamentos.*')
                ->first();
        }
        else{
            $Tarifarelacionada = DB::table('tarifas')
                ->join('requerimientos', 'requerimientos.FK_ReqTarifa', '=', 'tarifas.ID_Tarifa')
                ->join('tratamientos', 'requerimientos.FK_ReqTrata', '=', 'tratamientos.ID_Trat')
                ->join('respels', 'requerimientos.FK_ReqRespel', '=', 'respels.ID_Respel')
                ->join('cotizacions', 'respels.FK_RespelCoti', '=', 'cotizacions.ID_Coti')
                ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->where('requerimientos.FK_ReqTarifa', $tarifa->ID_Tarifa)
                ->select('tarifas.*', 'requerimientos.*', 'tratamientos.*', 'respels.*', 'cotizacions.*', 'sedes.*', 'clientes.*', 'municipios.*', 'departamentos.*')
                ->first();
        }
        /*bloque comentado para poder entrar a la tarifa con id 5*/
        // if ($Tarifarelacionada!=='') {
        //     $tarifa=$Tarifarelacionada;
        // }

        return view('tarifas.show', compact('tarifa'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarifa $tarifa)
    {
        return view('tarifas.edit', compact('tarifa'));
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
        $Tarif = Tarifa::where('ID_Tarifa', $tarifa->ID_Tarifa)->first();
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
        $Tarif->update();

        $log = new audit();
        $log->AuditTabla="tarifas";
        $log->AuditType="Actualizado";
        $log->AuditRegistro=$Tarif->ID_Tarifa;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('tarifas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarifa $tarifa)
    {
        $tarifa = Tarifa::where('ID_Tarifa', $tarifa->ID_Tarifa)->first();
            if ($tarifa->TarifaDelete == 0) {
                $tarifa->TarifaDelete = 1;
            }
            else{
                $tarifa->TarifaDelete = 0;
            }
        $tarifa->update();
        

        $log = new audit();
        $log->AuditTabla="tarifas";
        $log->AuditType="Borrado";
        $log->AuditRegistro=$tarifa->ID_Tarifa;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog = $tarifa->TarifaDelete;
        $log->save();

        return redirect()->route('tarifas.index');
    }
}
