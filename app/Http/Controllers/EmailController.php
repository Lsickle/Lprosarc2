<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\SolSerEmail;
use App\Mail\SolSerEmailClient;
use App\Mail\RespelMail;
use App\SolicitudServicio;
use App\Personal;
use App\Respel;

class EmailController extends Controller
{
    // Email de Solcitud de Servicio
    protected function sendemail($slug)
    {
        $SolSer = SolicitudServicio::where('SolSerSlug', $slug)->first();
        if((Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')) && ($SolSer->SolSerStatus === 'No Conciliado' || $SolSer->SolSerStatus === 'Conciliado')){
            $email = DB::table('solicitud_servicios')
                ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                ->select('personals.PersEmail', 'personals.PersFirstName', 'personals.PersLastName', 'clientes.CliName', 'clientes.CliComercial', 'solicitud_servicios.*')
                ->where('solicitud_servicios.SolSerSlug', '=', $SolSer->SolSerSlug)
                ->first();
           // {{ $message->embed(base_path() . '/img/logo.png') }}
            $Roles1 = DB::table('users')
                ->whereIn('users.UsRol', ['AsistenteLogistica', 'Supervisor'])
                ->select('users.email')
                ->get();
                
            // $Roles2 = DB::table('users')
            //     ->whereIn('users.UsRol2', ['JefeLogistica', 'AsistenteLogistica'])
            //     ->select('users.email')
            //     ->get();
            
            foreach($Roles1 as $Rol1){
                //SE ENVIA UN CORREO A CADA USUARIO DE ACUERDO AL ARRAY ROLES 1
                Mail::to($Rol1->email)->send(new SolSerEmailClient($email));
            }   
                // validacion del rol2 para el envio de correo
                // foreach($Roles2 as $Rol2){
                //     Mail::to($Rol2->email)->send(new SolSerEmail($email));
                // }

                // para no enviar a logistica los email
                // Mail::to(Auth::user()->email)->send(new SolSerEmail($email));

        }elseif($SolSer->SolSerStatus === 'Programado'){
            $email = DB::table('solicitud_servicios')
                ->join('progvehiculos', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
                ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                ->select('personals.PersEmail', 'solicitud_servicios.*', 'progvehiculos.ProgVehFecha', 'progvehiculos.ProgVehSalida')
                ->where('solicitud_servicios.SolSerSlug', '=', $SolSer->SolSerSlug)
                ->where('progvehiculos.FK_ProgServi', '=', $SolSer->ID_SolSer)
                ->where('progvehiculos.ProgVehDelete', 0)
                ->first();

            if ($SolSer->SolServMailCopia == "null") {
                Mail::to($email->PersEmail)
                ->send(new SolSerEmail($email));
            }else{
                Mail::to($email->PersEmail)
                ->cc(json_decode($SolSer->SolServMailCopia))
                ->send(new SolSerEmail($email));
            }
            
        }elseif($SolSer->SolSerStatus === 'Notificado'){
            $email = DB::table('solicitud_servicios')
                ->join('progvehiculos', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
                ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                ->select('personals.PersEmail', 'solicitud_servicios.*', 'progvehiculos.ProgVehFecha', 'progvehiculos.ProgVehSalida', 'clientes.*')
                ->where('solicitud_servicios.SolSerSlug', '=', $SolSer->SolSerSlug)
                ->where('progvehiculos.FK_ProgServi', '=', $SolSer->ID_SolSer)
                ->where('progvehiculos.ProgVehDelete', 0)
                ->first();
            $comercial = Personal::where('ID_Pers', $email->CliComercial)->first();
            $destinatarios = ['diroperaciones@prosarc.com.co',
                                'logistica@prosarc.com.co',
                                'asistentelogistica@prosarc.com.co',
                                'auxiliarlogistico@prosarc.com.co',
                                'gerenteplanta@prosarc.com.co',
                                'subgerencia@prosarc.com.co',
                                'recepcionpda@prosarc.com.co',
                                $comercial->PersEmail
                            ];

            if ($SolSer->SolServMailCopia == "null") {
                Mail::to($email->PersEmail)
                ->cc($destinatarios)
                ->send(new SolSerEmail($email));
            }else{
                foreach (json_decode($SolSer->SolServMailCopia) as $key => $value) {
                    array_push($destinatarios, $value);
                }
                Mail::to($email->PersEmail)
                ->cc($destinatarios)
                ->send(new SolSerEmail($email));
            }
            return redirect()->route('vehicle-programacion.index')->with('mensaje', trans('servicio notificado correctamente'));

        }elseif($SolSer->SolSerStatus === 'Completado'){
            $email = DB::table('solicitud_servicios')
                ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                ->select('personals.PersEmail', 'solicitud_servicios.*')
                ->where('solicitud_servicios.SolSerSlug', '=', $SolSer->SolSerSlug)
                ->first();
            
            $destinatarios = ['asistentelogistica@prosarc.com.co',
                            $email->PersEmail];

            if ($SolSer->SolServMailCopia == "null") {
                Mail::to($destinatarios)
                ->send(new SolSerEmail($email));
            }else{
                Mail::to($destinatarios)
                ->cc(json_decode($SolSer->SolServMailCopia))
                ->send(new SolSerEmail($email));
            }
            
        }else{
            $email = DB::table('solicitud_servicios')
                ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                ->select('personals.PersEmail', 'solicitud_servicios.*')
                ->where('solicitud_servicios.SolSerSlug', '=', $SolSer->SolSerSlug)
                ->first();
                
            if ($SolSer->SolServMailCopia == "null") {
                Mail::to($email->PersEmail)
                ->send(new SolSerEmail($email));
            }else{
                Mail::to($email->PersEmail)
                ->cc(json_decode($SolSer->SolServMailCopia))
                ->send(new SolSerEmail($email));
            }
            
        }
        // return back();
        return redirect()->route('solicitud-servicio.index');

    }

    protected function sendEmailRespel($slug){
        $respel = DB::table('respels')
            ->join('cotizacions', 'cotizacions.ID_Coti', 'respels.FK_RespelCoti')
            ->join('sedes', 'cotizacions.FK_CotiSede', '=', 'sedes.ID_Sede')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('respels.*', 'clientes.ID_Cli')
            ->where('respels.RespelSlug', $slug)
            ->first();

        $email = DB::table('users')
            ->join('personals', 'personals.ID_Pers', 'users.FK_UserPers')
            ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
            ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
            ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
            ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->where('clientes.ID_Cli', $respel->ID_Cli)
            ->select('users.email')
            ->first();
            
        Mail::to($email->email)->send(new RespelMail($respel));
        // return back();
        return redirect()->route('respels.index');
    }
}