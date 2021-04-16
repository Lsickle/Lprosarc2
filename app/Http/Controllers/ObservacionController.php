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
use App\Mail\FechaErrada;
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

        /*se guarda la observación de la modificación del servicio*/
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

        $email = DB::table('solicitud_servicios')
                        ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                        ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                        ->select('personals.PersEmail', 'personals.PersFirstName', 'personals.PersLastName', 'clientes.CliName', 'clientes.CliComercial', 'solicitud_servicios.*')
                        ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                        ->first();

        $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();
        
        if ($comercial == null) {
            $comercial->PersEmail = 'subgerencia@prosarc.com.co';
        }

        $copy = ['asistentelogistica@prosarc.com.co',
                    'auxiliarlogistico@prosarc.com.co',
                    'auxiliarpda@prosarc.com.co'
                    ];

        $recipient = ['conciliaciones@prosarc.com.co',
                            'recepcionpda@prosarc.com.co',
                            $comercial->PersEmail
                        ];  

        if (Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente')) {
            array_push($recipient, $email->PersEmail);
        }

        switch ($Solicitud->SolSerStatus) {

            case 'Aprobado':
                array_push($copy, 'gerenteplanta@prosarc.com.co');
                break;
            case 'Programado':
            case 'Notificado':
            case 'Completado': 
                break;
            case 'Residuo Faltante':
                array_push($copy, 'dirtecnica@prosarc.com.co');               
                break;
            case 'No Conciliado':
            case 'Conciliado':
                break;
            default:
                break;
        }

        if ($Solicitud->SolServMailCopia !== "null") {
            foreach (json_decode($Solicitud->SolServMailCopia) as $key => $value) {
                array_push($copy, $value);
            }
        }


        if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')) {
            Mail::to($recipient)->cc($copy)->send(new NewObservationClient($email, $Observacion));
        }else{
            Mail::to($recipient)->cc($copy)->send(new NewObservation($email, $Observacion));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendRecordatorio(Request $request)
    {
        $Solicitud = SolicitudServicio::where('SolSerSlug', $request->input('solserslug'))->first();
		if (!$Solicitud) {
			abort(404, 'no se encuentra las solicitud de servicio');
        }
        if ($Solicitud->SolSerStatus != 'Completado') {
			abort(403, 'el servicio debe estar en status de (completado) para poder enviar recordatorios de conciliación');
		}

		$Solicitud->SolSerDescript = $request->input('solserdescript');
        $Solicitud->save();
        
        $observacionesServicio = Observacion::where('FK_ObsSolSer', $Solicitud->ID_SolSer)->get();

        $conteoRecordatorio = Observacion::where('FK_ObsSolSer', $Solicitud->ID_SolSer)->where('ObsStatus', 'Recordatorio+')->get();

        /*se guarda la observación de la modificación del servicio*/
        $Observacion = new Observacion();
        $Observacion->ObsStatus = 'Recordatorio+';
        $Observacion->ObsMensaje = $Solicitud->SolSerDescript;
        $Observacion->ObsTipo = 'prosarc';
        if ($conteoRecordatorio->count() > 0) {
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

        $email = DB::table('solicitud_servicios')
                        ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                        ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                        ->select('personals.PersEmail', 'personals.PersFirstName', 'personals.PersLastName', 'clientes.CliName', 'clientes.CliComercial', 'solicitud_servicios.*')
                        ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                        ->first();

        $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();
        
        if ($comercial == null) {
            $comercial->PersEmail = 'subgerencia@prosarc.com.co';
        }

        if ($Observacion->ObsRepeat > 2) {
            $copy = ['recepcionpda@prosarc.com.co',
                    'conciliaciones@prosarc.com.co',
                    'logistica@prosarc.com.co',
                    $comercial->PersEmail
                ];
        }else{
            $copy = ['recepcionpda@prosarc.com.co',
                    'conciliaciones@prosarc.com.co',
                    $comercial->PersEmail
                ];
        }
        
        $recipient = [$email->PersEmail];

        if ($Solicitud->SolServMailCopia !== "null") {
            foreach (json_decode($Solicitud->SolServMailCopia) as $key => $value) {
                array_push($copy, $value);
            }
        }

        Mail::to($recipient)->cc($copy)->send(new ConcilacionRecordatorio($email, $Observacion));

        return redirect()->route('solicitud-servicio.show', ['id' => $Solicitud->SolSerSlug]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recepcionErrada(Request $request)
    {
        $Solicitud = SolicitudServicio::where('SolSerSlug', $request->input('solserslug'))->first();
		if (!$Solicitud) {
			abort(404, 'no se encuentra las solicitud de servicio');
        }
        if ($Solicitud->SolSerStatus == 'Aprobado') {
			abort(403, 'el servicio no debe estar en status de (Aprobado) para notificar fecha de recepcion errada');
		}

		$Solicitud->SolSerDescript = $request->input('solserdescript');
        $Solicitud->save();

        /*se guarda la observación de la modificación del servicio*/
        $Observacion = new Observacion();
        $Observacion->ObsStatus = 'FechaErrada+';
        $Observacion->ObsMensaje = $Solicitud->SolSerDescript;
        $Observacion->ObsTipo = 'prosarc';
        $Observacion->ObsRepeat = 1;
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

        $email = DB::table('solicitud_servicios')
                        ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                        ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                        ->select('personals.PersEmail', 'personals.PersFirstName', 'personals.PersLastName', 'clientes.CliName', 'clientes.CliComercial', 'solicitud_servicios.*')
                        ->where('solicitud_servicios.SolSerSlug', '=', $Solicitud->SolSerSlug)
                        ->first();

        $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();
        
        if ($comercial == null) {
            $comercial->PersEmail = 'subgerencia@prosarc.com.co';
        }

        $copy = [
                $comercial->PersEmail
                ];

        $recipient = [
                    'logistica@prosarc.com.co',
                    'recepcionpda@prosarc.com.co',
                    'asistentelogistica@prosarc.com.co'
                    ];


        Mail::to($recipient)->cc($copy)->send(new FechaErrada($email, $Observacion));

        return redirect()->route('solicitud-servicio.show', ['id' => $Solicitud->SolSerSlug]);

    }
}
