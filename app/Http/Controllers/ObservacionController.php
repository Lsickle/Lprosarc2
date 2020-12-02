<?php

namespace App\Http\Controllers;

use App\Observacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\SolicitudServicio;
use App\Personal;
use App\Mail\NewObservationClient;
use App\Mail\NewObservation;
use App\Mail\ConcilacionRecordatorio;
use Permisos;
use App\audit;




class ObservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $Solicitud = SolicitudServicio::where('SolSerSlug', $request->input('solserslug'))->first();
		if (!$Solicitud) {
			abort(404, 'no se encuentra las solicitud de servicio');
		}

		$Solicitud->SolSerDescript = $request->input('solserdescript');
        $Solicitud->save();
        
        $observacionesServicio = Observacion::where('FK_ObsSolSer', $Solicitud->ID_SolSer)->get();

        $conteoRecordatorio = Observacion::where('FK_ObsSolSer', $Solicitud->ID_SolSer)->where('ObsStatus', 'Completado+')->get();

        /*se guarda la observacion de la modificacion del servicio*/
        $Observacion = new Observacion();
        $Observacion->ObsStatus = $Solicitud->SolSerStatus.'+';
        $Observacion->ObsMensaje = $Solicitud->SolSerDescript;
        $Observacion->ObsTipo = (in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) ? 'prosarc' : 'cliente');
        if ($conteoRecordatorio->count() > 3) {
            $Observacion->ObsRepeat = $conteoRecordatorio->count() + 1;
        }else{
            $Observacion->ObsRepeat = 1;
        }
        $Observacion->ObsDate = now();
        $Observacion->ObsUser = Auth::user()->email;
        $Observacion->ObsRol = Auth::user()->UsRol;
        $Observacion->FK_ObsSolSer = $Solicitud->ID_SolSer;
        $Observacion->save();

        $log = new audit();
		$log->AuditTabla="observaciones";
		$log->AuditType="Add observacion";
		$log->AuditRegistro=$Observacion->ID_Obs;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=[$Solicitud->SolSerStatus, $Solicitud->SolSerDescript];
        $log->save();

        switch ($Solicitud->SolSerStatus) {

            case 'No Conciliado':
                if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')) {
                    $email = DB::table('solicitud_servicios')
                        ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                        ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                        ->select('personals.PersEmail', 'personals.PersFirstName', 'personals.PersLastName', 'clientes.CliName', 'clientes.CliComercial', 'solicitud_servicios.*')
                        ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                        ->first();

                    $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();
                    $destinatarios = ['asistentelogistica@prosarc.com.co',
                                        'recepcionpda@prosarc.com.co',
                                        'auxiliarpda@prosarc.com.co',
                                        $comercial->PersEmail
                                    ];
                    $destinatarioscc = ['logistica@prosarc.com.co'];
                    Mail::to($destinatarios)
                    ->cc($destinatarioscc)
                    ->send(new NewObservationClient($email, $Observacion));
                }
                break;

            case 'Conciliado':
                if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')) {
                    $email = DB::table('solicitud_servicios')
                        ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                        ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                        ->select('personals.PersEmail', 'personals.PersFirstName', 'personals.PersLastName', 'clientes.CliName', 'clientes.CliComercial', 'solicitud_servicios.*')
                        ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                        ->first();

                    $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();
                    $destinatarios = ['asistentelogistica@prosarc.com.co',
                                        'auxiliarlogistico@prosarc.com.co',
                                        $comercial->PersEmail
                                    ];
                    $destinatarioscc = ['auxiliarpda@prosarc.com.co',
                                        'ingtratamiento1@prosarc.com.co',
                                        'ingtratamiento2@prosarc.com.co',
                                        'ingtratamiento3@prosarc.com.co',
                                        'dirtecnica@prosarc.com.co',
                                        'conciliaciones@prosarc.com.co',
                                        'recepcionpda@prosarc.com.co',
                                        'gerenteplanta@prosarc.com.co',
                                        'logistica@prosarc.com.co'
                                    ];
                    Mail::to($destinatarios)
                    ->cc($destinatarioscc)
                    ->send(new NewObservationClient($email, $Observacion));
                }
                break;

            case 'Programado':
                $email = DB::table('solicitud_servicios')
                    ->join('progvehiculos', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
                    ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                    ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                    ->select('personals.PersEmail', 'solicitud_servicios.*', 'progvehiculos.ProgVehFecha', 'progvehiculos.ProgVehSalida', 'clientes.CliName')
                    ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                    ->where('progvehiculos.FK_ProgServi', '=', $Solicitud->ID_SolSer)
                    ->where('progvehiculos.ProgVehDelete', 0)
                    ->first();

                if ($Solicitud->SolServMailCopia == "null") {
                    Mail::to($email->PersEmail)
                    ->send(new NewObservation($email, $Observacion));
                }else{
                    Mail::to($email->PersEmail)
                    ->cc(json_decode($Solicitud->SolServMailCopia))
                    ->send(new NewObservation($email, $Observacion));
                }
                break;
            
            case 'Notificado':
                $email = DB::table('solicitud_servicios')
                    ->join('progvehiculos', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
                    ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                    ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                    ->select('personals.PersEmail', 'solicitud_servicios.*', 'progvehiculos.ProgVehFecha', 'progvehiculos.ProgVehSalida', 'clientes.CliName', 'clientes.CliComercial')
                    ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                    ->where('progvehiculos.FK_ProgServi', '=', $Solicitud->ID_SolSer)
                    ->where('progvehiculos.ProgVehDelete', 0)
                    ->first();
                $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();
                $destinatarios = ['dirtecnica@prosarc.com.co',
                                    'logistica@prosarc.com.co',
                                    'asistentelogistica@prosarc.com.co',
                                    'auxiliarlogistico@prosarc.com.co',
                                    'recepcionpda@prosarc.com.co',
                                    $comercial->PersEmail
                                ];

                if ($Solicitud->SolServMailCopia == "null") {
                    Mail::to($email->PersEmail)
                    ->cc($destinatarios)
                    ->send(new NewObservation($email, $Observacion));
                }else{
                    foreach (json_decode($Solicitud->SolServMailCopia) as $key => $value) {
                        array_push($destinatarios, $value);
                    }
                    Mail::to($email->PersEmail)
                    ->cc($destinatarios)
                    ->send(new NewObservation($email, $Observacion));
                }
                return redirect()->route('vehicle-programacion.index')->with('mensaje', trans('servicio notificado correctamente'));
                break;
            
            case 'Completado':
                $email = DB::table('solicitud_servicios')
                    ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                    ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                    ->select('personals.PersEmail', 'solicitud_servicios.*', 'clientes.CliName')
                    ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                    ->first();
                
                $destinatarios = ['asistentelogistica@prosarc.com.co',
                                'recepcionpda@prosarc.com.co',
                                $email->PersEmail];

                if ($Solicitud->SolServMailCopia == "null") {
                    Mail::to($destinatarios)
                    ->send(new ConcilacionRecordatorio($email, $Observacion));
                }else{
                    Mail::to($destinatarios)
                    ->cc(json_decode($Solicitud->SolServMailCopia))
                    ->send(new ConcilacionRecordatorio($email, $Observacion));
                }
                break;
            
            case 'Corregido':
                $email = DB::table('solicitud_servicios')
                    ->join('progvehiculos', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
                    ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                    ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                    ->select('personals.PersEmail', 'solicitud_servicios.*', 'clientes.CliName', 'clientes.CliComercial')
                    ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                    ->first();
                $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();
                $destinatarios = ['logistica@prosarc.com.co',
                                    'gerenteplanta@prosarc.com.co',
                                    'recepcionpda@prosarc.com.co',
                                    'dirtecnica@prosarc.com.co',
                                    $comercial->PersEmail
                                ];

                if ($Solicitud->SolServMailCopia !== "null") {
                    foreach (json_decode($SolSer->SolServMailCopia) as $key => $value) {
                        array_push($destinatarios, $value);
                    }
                }
                Mail::to($email->PersEmail)->cc($destinatarios)->send(new NewObservation($email, $Observacion));
                break;
            
            case 'Residuo Faltante':
                $email = DB::table('solicitud_servicios')
                    ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                    ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                    ->select('personals.PersEmail', 'solicitud_servicios.*', 'clientes.CliName', 'clientes.CliComercial')
                    ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                    ->first();
                
                $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();
                
                $destinatarios = ['asistentelogistica@prosarc.com.co',
                                'recepcionpda@prosarc.com.co',
                                $comercial->PersEmail];

                if ($Solicitud->SolServMailCopia !== "null") {
                    foreach (json_decode($Solicitud->SolServMailCopia) as $key => $value) {
                        array_push($destinatarios, $value);
                    }
                }

                Mail::to($email->PersEmail)->cc($destinatarios)->send(new NewObservation($email, $Observacion));
                break;
            default:
                $email = DB::table('solicitud_servicios')
                    ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                    ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                    ->select('personals.PersEmail', 'solicitud_servicios.*', 'clientes.CliName')
                    ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                    ->first();
                    
                if ($Solicitud->SolServMailCopia == "null") {
                    Mail::to($email->PersEmail)
                    ->send(new NewObservation($email, $Observacion));
                }else{
                    Mail::to($email->PersEmail)
                    ->cc(json_decode($Solicitud->SolServMailCopia))
                    ->send(new NewObservation($email, $Observacion));
                }
                break;
        }

        return redirect()->route('solicitud-servicio.show', ['id' => $Solicitud->SolSerSlug]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function show(Observacion $observacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Observacion $observacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Observacion $observacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Observacion $observacion)
    {
        //
    }
}
