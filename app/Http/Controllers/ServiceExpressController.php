<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SolServStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use App\Http\Controllers\userController;
use App\Http\Controllers\SolicitudResiduoController;
use App\Mail\NewSolServEmail;
use App\Mail\SolSerLeftRespel;
use App\Mail\NewSolServProsarcEmail;
use App\SolicitudServicio;
use App\SolicitudResiduo;
use App\audit;
use App\Sede;
use App\GenerSede;
use App\Respel;
use App\ResiduosGener;
use App\Cliente;
use App\Tratamiento;
use App\Generador;
use App\Personal;
use App\Departamento;
use App\Municipio;
use App\Tarifa;
use App\Rango;
use App\Certificado;
use App\Certdato;
use App\Manifiesto;
use App\Manifdato;
use App\Requerimiento;
use App\Documento;
use App\Docdato;
use App\ProgramacionVehiculo;
use App\RequerimientosCliente;
use App\Observacion;
use Permisos;

class ServiceExpressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Servicios = DB::table('solicitud_servicios')
			->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
			->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
			->join('personals as Comercial', 'Comercial.ID_Pers', '=', 'clientes.CliComercial')
			->select('solicitud_servicios.ID_SolSer',
			'solicitud_servicios.SolSerStatus',
			'solicitud_servicios.SolSerTipo',
			'solicitud_servicios.SolSerAuditable',
			'solicitud_servicios.SolSerConductor',
			'solicitud_servicios.SolSerVehiculo',
			'solicitud_servicios.SolSerSlug',
			'solicitud_servicios.created_at',
			'solicitud_servicios.updated_at',
			'solicitud_servicios.SolSerDelete',
			'solicitud_servicios.SolResAuditoriaTipo',
			'solicitud_servicios.SolSerNameTrans',
			'solicitud_servicios.SolSerNitTrans',
			'solicitud_servicios.SolSerAdressTrans',
			'solicitud_servicios.SolSerTypeCollect',
			'solicitud_servicios.SolSerCollectAddress',
			'solicitud_servicios.SolServCertStatus',
			'clientes.CliName',
			'clientes.CliSlug',
			'clientes.CliStatus',
			'clientes.TipoFacturacion',
			'personals.PersFirstName',
			'personals.PersLastName',
			'personals.PersSlug',
			'personals.PersEmail',
			'personals.PersCellphone',
			'Comercial.ID_Pers as ComercialID_Pers',
			'Comercial.PersFirstName as ComercialPersFirstName',
			'Comercial.PersLastName as ComercialPersLastName',
			'Comercial.PersSlug as ComercialPersSlug',
			'Comercial.PersEmail as ComercialPersEmail',
			'Comercial.PersCellphone as ComercialPersCellphone')
			->where(function($query){
				if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
					$query->where('ID_Cli',userController::IDClienteSegunUsuario());
				}
				if(in_array(Auth::user()->UsRol, Permisos::SOLSERACEPTADO) || in_array(Auth::user()->UsRol2, Permisos::SOLSERACEPTADO)){
					if(!in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
						$query->where('solicitud_servicios.SolSerStatus', 'Pendiente');
						$query->orWhere('solicitud_servicios.SolServCertStatus', 1);
					}
				}
				if(in_array(Auth::user()->UsRol, Permisos::COMERCIALES) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALES)){
					if(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)){
						$query->where('Comercial.ID_Pers', Auth::user()->FK_UserPers);
					}
				}
			})
			->orderBy('created_at', 'desc')
			->get();
		$Cliente = Cliente::select('CliName','ID_Cli', 'CliStatus')->where('ID_Cli',userController::IDClienteSegunUsuario())->first();
		foreach ($Servicios as $servicio) {
			if($servicio->SolSerTypeCollect == 98){
				$Address = Sede::select('SedeAddress')->where('ID_Sede',$servicio->SolSerCollectAddress)->first();
				$servicio->SolSerCollectAddress = $Address->SedeAddress;
			}

			/* validacion para encontrar la fecha de recepción en planta del servicio */
			$fechaRecepcion = SolicitudServicio::find($servicio->ID_SolSer)->programacionesrecibidas()->first();
			if($fechaRecepcion){
				$servicio->recepcion = $fechaRecepcion->ProgVehSalida;
			}else{
				$servicio->recepcion = null;
			}
		}
		if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
			return view('serviciosexpress.index', compact('Servicios', 'Residuos', 'Cliente'));
		}else{
			return view('serviciosexpress.indexprosarc', compact('Servicios', 'Residuos', 'Cliente'));
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(in_array(Auth::user()->UsRol, Permisos::EXPRESS) || in_array(Auth::user()->UsRol, Permisos::EXPRESS)){
			$Departamentos = Departamento::all();
            $Cliente = Cliente::select('CliName', 'CliName','ID_Cli', 'CliStatus', 'TipoFacturacion')->where('ID_Cli',userController::IDClienteSegunUsuario())->first();
            $Clientes = Cliente::all();
			$Sedes = Sede::select('SedeSlug','SedeName')->where('FK_SedeCli', $Cliente->ID_Cli)
			->where('sedes.SedeDelete', 0)
			->get();
			$SGeneradors = DB::table('gener_sedes')
				->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
				->join('sedes', 'generadors.FK_GenerCli', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('gener_sedes.GSedeSlug', 'gener_sedes.GSedeName', 'generadors.GenerName')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->where('generadors.GenerDelete', 0)
				->where('gener_sedes.GSedeDelete', 0)
				->get();
			$Personals = DB::table('personals')
				->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
				->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
				->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('personals.PersSlug', 'personals.PersFirstName', 'personals.PersLastName', 'personals.PersEmail')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->where('personals.PersDelete', 0)
				->get();
            $Requerimientos = RequerimientosCliente::where('FK_RequeClient', $Cliente->ID_Cli)->get();
            // return $Requerimientos;
			if ($Cliente->CliStatus=="Bloqueado") {
				abort(403, 'Actualmente se encuentra deshabilitado para realizar nuevas solicitudes de servicio... Para mas detalles comuníquese con su Asesor Comercial');
			}else{
				return view('serviciosexpress.create', compact('Personals', 'Clientes', 'Cliente', 'SGeneradors', 'Departamentos', 'Sedes', 'Requerimientos'));
			}
		}
		else{
			abort(403, 'Solo los Roles autorizados pueden realizar nuevas solicitudes de servicio Express');
		}
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
