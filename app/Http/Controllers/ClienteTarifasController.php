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
use App\CTarifa;
use App\TRangos;

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

        $request->validate([
            'FK_Tratamiento' => 'required|exists:tratamientos,ID_Trat',
            'CTarifaDesde' => 'required|numeric|min:0',
            'Tarifatipo' => 'required|in:Kg,Unid,Lt',
            'CTarifaPrecio' => 'required|numeric|min:0',
            'CTarifaFrecuencia' => 'required|in:Servicio,Mensual',
            'TarifaVencimiento' => 'required|date',
        ], [
            '*.required' => 'debe especificar un valor en el campo :attribute',
            'CTarifaDesde.min' => 'ingrese un valor mayor a 0 en el campo :attribute',
            'CTarifaPrecio.min' => 'ingrese un valor mayor a 0 en el campo :attribute',
            'FK_Tratamiento.exists' => 'el :attribute seleccionado no se encuentra en la base de datos',
        ], [
            'FK_Tratamiento' => 'Tratamiento',
            'CTarifaDesde' => 'Rango',
            'Tarifatipo' => 'Unidad',
            'CTarifaPrecio' => 'Precio',
            'CTarifaFrecuencia' => 'Frecuencia',
            'TarifaVencimiento' => 'Vencimiento',
        ]);

        // check if CTarifa exist


        $cliente = Cliente::where('CliSlug', $CliSlug)->with(['clientetarifa.rangos', 'clientetarifa.tratamiento'])->first();

        $tarifaPrevia = CTarifa::where('FK_Cliente', $cliente->ID_Cli)
            ->where('FK_Tratamiento', $request->input('FK_Tratamiento'))
            ->where('Tarifatipo', $request->input('Tarifatipo'))
            ->first();
        if ($tarifaPrevia === null) {
            $Tarifanueva = new CTarifa();
            $Tarifanueva->TarifaDelete = 0;
            $Tarifanueva->TarifaVencimiento = $request->input('TarifaVencimiento');
            $Tarifanueva->TarifaFrecuencia = 'Servicio';
            $Tarifanueva->TarifaFrecuencia = $request->input('CTarifaFrecuencia');
            $Tarifanueva->Tarifatipo = $request->input('Tarifatipo');
            $Tarifanueva->FK_Cliente = $cliente->ID_Cli;
            $Tarifanueva->FK_Tratamiento = $request->input('FK_Tratamiento');
            $Tarifanueva->save();

            $Rangonuevo = new TRangos();
            $Rangonuevo->CTarifaPrecio = $request->input('CTarifaPrecio');
            $Rangonuevo->CTarifaDesde = $request->input('CTarifaDesde');
            $Rangonuevo->FK_RangoCTarifa = $Tarifanueva->ID_CTarifa;
            $Rangonuevo->save();

            $log = new audit();
            $log->AuditTabla="CTarifa";
            $log->AuditType="CTarifa Nueva";
            $log->AuditRegistro=$Tarifanueva->ID_CTarifa;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog=$Tarifanueva;
            $log->save();

        } else {
            $Rangonuevo = new TRangos();
            $Rangonuevo->CTarifaPrecio = $request->input('CTarifaPrecio');
            $Rangonuevo->CTarifaDesde = $request->input('CTarifaDesde');
            $Rangonuevo->FK_RangoCTarifa = $tarifaPrevia->ID_CTarifa;
            $Rangonuevo->save();

            $log = new audit();
            $log->AuditTabla="TRangos";
            $log->AuditType="rango adicional";
            $log->AuditRegistro=$Rangonuevo->ID_CRango;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog=$Rangonuevo;
            $log->save();

            $tarifaPrevia->TarifaFrecuencia = $request->input('CTarifaFrecuencia');
            $tarifaPrevia->save();
        }





        return redirect()->route('clientetarifas.create', ['cliente' => $cliente->CliSlug]);
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
     * @param  string  $CliSlug
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($CliSlug, $ID_CRango)
    {
        $Rangoparaborrar = TRangos::find($ID_CRango);
        $Rangoparaborrar->delete();

        // cuenta de rangos de la tarifa
        $tarifaparaborrar = CTarifa::where('ID_CTarifa', $Rangoparaborrar->FK_RangoCTarifa)->with('rangos')->first();

        $log = new audit();
        $log->AuditTabla="TRangos";
        $log->AuditType="TRangos Eliminado";
        $log->AuditRegistro=$Rangoparaborrar->ID_CRango;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$Rangoparaborrar;
        $log->save();

        if ($tarifaparaborrar->rangos->Count() < 1) {
            $tarifaparaborrar->delete();


            $log = new audit();
            $log->AuditTabla="CTarifa";
            $log->AuditType="CTarifa Eliminada";
            $log->AuditRegistro=$tarifaparaborrar->ID_CTarifa;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog=$tarifaparaborrar;
            $log->save();
        }

        return redirect()->route('clientetarifas.create', ['cliente' => $CliSlug]);
    }
}
