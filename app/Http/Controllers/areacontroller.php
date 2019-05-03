<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\userController;
use App\Area;
use App\audit;
use Illuminate\Support\Facades\Auth;



class AreaController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(){
		if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
			$Areas = DB::table('areas')
			->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
			->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
			->select('areas.AreaSlug', 'areas.AreaName','areas.AreaDelete','sedes.SedeName','clientes.CliShortname','clientes.ID_Cli')
			->where(function($query){
				$id = userController::IDClienteSegunUsuario();
				/*Validacion del cliente que pueda ver solo las areas que tiene a cargo solo los que no esten eliminados*/
				if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
					$query->where('clientes.ID_Cli', '=', $id);
					$query->where('areas.AreaDelete', '=', 0);
				}
				/*Validacion del personal de Prosarc autorizado para las areas del cliente solo los que no esten eliminados*/
				else if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
					$query->where('clientes.ID_Cli', '<>', $id);
					$query->where('areas.AreaDelete', '=', 0);
				}
				/*Validacion del Programador para ver todas las areas del cliente aun asi este eliminado*/
				else{
					$query->where('clientes.ID_Cli', '<>', $id);
				}
			})
			->get();
			return view('areas.index', compact('Areas'));
		}
		else{
			abort(403);
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create(){
		if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
			$Sedes = DB::table('sedes')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('ID_Sede', 'SedeName')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->get();
			return view('areas.create', compact('Sedes'));
		}
		else{
			abort(403);
		}
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(Request $request){
		$validate = $request->validate([
			'AreaName'       => 'required|min:8',
			'FK_AreaSede'    => 'required',
		]);
		$area = new Area();
		$area->AreaName = $request->input('AreaName');
		$area->FK_AreaSede= $request->input('FK_AreaSede');
		$area->AreaDelete = 0;
		$area->AreaSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
		$area->save();

		return redirect()->route('areas.index');
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     **/
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function edit($id){
		$Areas = Area::where('AreaSlug', $id)->first();
		if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') && $Areas <> null){
			$Sedes = DB::table('sedes')
				->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
				->select('ID_Sede', 'SedeName')
				->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
				->get();
			return view('areas.edit', compact('Sedes', 'Areas'));
		}
		else{
			abort(403);
		}
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(Request $request, $id){
		$validate = $request->validate([
			'AreaName'       => 'required|min:8',
			'FK_AreaSede'    => 'required',
		]);
		$Area = Area::where('AreaSlug', $id)->first();
		$Area->AreaName = $request->input('AreaName');
		$Area->FK_AreaSede = $request->input('FK_AreaSede');
		$Area->save();

		$log = new audit();
		$log->AuditTabla="areas";
		$log->AuditType="Modificado";
		$log->AuditRegistro=$Area->ID_Area;
		$log->AuditUser=Auth::user()->email;
		$log->Auditlog=$request->all();
		$log->save();

		return redirect()->route('areas.index');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy($id){
		$Area = Area::where('AreaSlug', $id)->first();
			if ($Area->AreaDelete == 0) {
				$Area->AreaDelete = 1;
			}
			else{
				$Area->AreaDelete = 0;
			}
		$Area->save();

		$log = new audit();
		$log->AuditTabla = "areas";
		$log->AuditType = "Eliminado";
		$log->AuditRegistro = $Area->ID_Area;
		$log->AuditUser = Auth::user()->email;
		$log->Auditlog = $Area->AreaDelete;
		$log->save();

		return redirect()->route('areas.index');
	}
}
