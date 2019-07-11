<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\SolSerEmail;
use App\SolicitudServicio;
use App\Personal;

class EmailController extends Controller
{
    protected function sendemail($slug)
    {
        $SolSer = SolicitudServicio::where('SolSerSlug', $slug)->first();
        if((Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')) && ($SolSer->SolSerStatus === 'No Conciliado' || $SolSer->SolSerStatus === 'Conciliado')){
            $email = DB::table('solicitud_servicios')
                ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                ->select('personals.PersEmail', 'personals.PersFirstName', 'personals.PersLastName', 'clientes.CliName', 'solicitud_servicios.*')
                ->where('solicitud_servicios.SolSerSlug', '=', $SolSer->SolSerSlug)
                ->first();
            
            $emailUser = DB::table('solicitud_servicios')
                ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                ->join('sedes', 'sedes.FK_SedeCli', '=' ,'clientes.ID_Cli')
                ->join('areas', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('cargos', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('personals', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('users', 'users.FK_UserPers', 'personals.ID_Pers')
                ->select('users.email', 'clientes.CliName', 'solicitud_servicios.*')
                ->where('users.UsRol', 'JefeLogistica')//rol que va ha ser contactado para las solicitudes de servicio
                ->first();
            Mail::to($emailUser->email)->send(new SolSerEmail($email));
        }elseif($SolSer->SolSerStatus === 'Programado'){
            $email = DB::table('solicitud_servicios')
                ->join('progvehiculos', 'progvehiculos.FK_ProgServi', '=', 'solicitud_servicios.ID_SolSer')
                ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                ->select('personals.PersEmail', 'solicitud_servicios.*', 'progvehiculos.ProgVehFecha', 'progvehiculos.ProgVehSalida')
                ->where('solicitud_servicios.SolSerSlug', '=', $SolSer->SolSerSlug)
                ->where('progvehiculos.FK_ProgServi', '=', $SolSer->ID_SolSer)
                ->first();
            Mail::to($email->PersEmail)->send(new SolSerEmail($email));
        }else{
            $email = DB::table('solicitud_servicios')
                ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                ->select('personals.PersEmail', 'solicitud_servicios.*')
                ->where('solicitud_servicios.SolSerSlug', '=', $SolSer->SolSerSlug)
                ->first();
            Mail::to($email->PersEmail)->send(new SolSerEmail($email));
        }
        return back();
    }
}