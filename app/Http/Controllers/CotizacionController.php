<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\audit;
use App\Sede;
use App\Cotizacion;
use App\Respel;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('ordenCompra/cotizacion');

        if(Auth::user()->UsRol === "Programador"){
            $cotizaciones = DB::table('cotizacions')
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
        // return $cotizaciones;
        return view('cotizacion.index', compact('cotizaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $residuos = DB::table('respels')
                ->join('cotizacions', 'respels.FK_RespelCoti', '=', 'cotizacions.ID_Coti')
                ->join('sedes', 'cotizacions.FK_Cotisede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->join('municipios', 'sedes.FK_SedeMun', '=', 'municipios.ID_Mun')
                ->join('departamentos', 'municipios.FK_MunCity', '=', 'departamentos.ID_Depart')
                ->select('respels.*', 'cotizacions.*', 'sedes.*', 'clientes.*', 'municipios.*', 'departamentos.*')
                ->where('RespelStatus', '=', 'Aprobado')
                ->get();


        // $residuos = Respel::with(['Cotizacion'])->get();

         
        $sedes=Sede::All();
        // return $sedes;

        // return $residuos;
        // return $sql;
        return view('cotizacion.create', compact('residuos', 'sedes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ultimo_aidi = Cotizacion::max('ID_Coti');
        // return $request;


        $cotizacion = new Cotizacion();
        $cotizacion->CotiNumero = $ultimo_aidi + 1;
        $cotizacion->CotiFechaSolicitud = now();
        $cotizacion->CotiVencida = 0;
        $cotizacion->CotiDelete = 0;
        $cotizacion->FK_CotiSede = $request->input('FK_CotiSede');
        $cotizacion->CotiStatus = 'Pendiente';
        $cotizacion->save();

        $log = new audit();
        $log->AuditTabla="cotizacion";
        $log->AuditType="Creado";
        $log->AuditRegistro=$ultimo_aidi + 1;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        return redirect()->route('cotizacion.index');
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
        $cotizacion = Cotizacion::where('ID_Coti', $id)->first();
        
        $sedes = Sede::All();
        
        $residuos = Respel::where('FK_RespelCoti', $id)->get();     

        // return $residuos;

        return view('cotizacion.edit', compact('sedes', 'cotizacion', 'residuos'));
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
