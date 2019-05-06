<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonalStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Personal;
use App\Area;
use App\Cargo;
use App\audit;

class PersonalInternoController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        /*Validacion del Programador para ver todo el personal interno aun asi este eliminado*/
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
            $Personals = DB::table('personals')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','personals.PersEmail','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'areas.AreaName', 'clientes.ID_Cli')
                ->where('clientes.ID_Cli', 1)
                ->get();
            return view('personal.personalInterno.index', compact('Personals'));
        }
        /*Validacion para el Administrador ver el personal de Prosarc solo los que no esten eliminados*/
        elseif(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
            $Personals = DB::table('personals')
                    ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                    ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                    ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                    ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                    ->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','personals.PersEmail','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'areas.AreaName', 'clientes.ID_Cli')
                    ->where('personals.PersDelete',0)
                    ->where('clientes.ID_Cli', 1)
                    ->get();
            return view('personal.personalInterno.index', compact('Personals'));
        }
        /*Validacion para usuarios no permitidos en esta vista*/
        else{
            return route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        /*Validacion para personas autorisadas a crear una persona*/
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
            $Sedes = DB::table('sedes')
                ->select('sedes.ID_Sede', 'sedes.SedeName')
                ->where('sedes.FK_SedeCli', userController::IDClienteSegunUsuario())
                ->get();
            if(old('Sede') == null){
                $Areas = null;
            }
            else{
                $Areas = DB::table('areas')
                    ->select('ID_Area', 'AreaName')
                    ->where('FK_AreaSede', old('Sede'))
                    ->get();
            }
            if(old('CargArea') == null){
                $Cargos = null;
            }
            else{
                $Cargos = DB::table('cargos')
                    ->select('ID_Carg', 'CargName')
                    ->where('CargArea', old('CargArea'))
                    ->get();
            }
            return view('personal.personalInterno.create', compact('Sedes', 'Areas', 'Cargos'));
        }
        else{
            return route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalStoreRequest $request){
        $NuevaArea = $request->input('NewArea');
        $NuevoCargo =  $request->input('NewCargo');
        if($request->input('CargArea') <> "NewArea"){
            $NuevaArea = null;
        }
        if($request->input('FK_PersCargo') <> "NewCargo"){
            $NuevoCargo = null;
        }
        /*Valida si se ha creado un nuevo cargo*/
        if($NuevoCargo <> null){
            /*Valida si se ha creado una nueva area*/
            if($NuevaArea <> null){
                $newArea = new Area();
                $newArea->AreaName = $request->input('NewArea');
                $newArea->FK_AreaSede = $request->input('Sede');
                $newArea->AreaDelete = 0;
                $newArea->save();

                $newCargo = new Cargo();
                $newCargo->CargName = $request->input('NewCargo');
                $newCargo->CargArea = $newArea->ID_Area;
                $newCargo->CargDelete = 0;
                $newCargo->save();
                $Cargo = $newCargo->ID_Carg;
            }
            else{
                $newCargo = new Cargo();
                $newCargo->CargName = $request->input('NewCargo');
                $newCargo->CargArea = $request->input('CargArea');
                $newCargo->CargDelete = 0;
                $newCargo->save();
                $Cargo = $newCargo->ID_Carg;
            }
        }
        else{
            $Cargo = $request->input('FK_PersCargo');
        }

        $Personal = new Personal();
        $Personal->PersType = $request->input('PersType');
        $Personal->PersDocType = $request->input('PersDocType');
        $Personal->PersDocNumber = $request->input('PersDocNumber');
        $Personal->PersFirstName = $request->input('PersFirstName');
        $Personal->PersSecondName = $request->input('PersSecondName');
        $Personal->PersLastName = $request->input('PersLastName');
        $Personal->PersEmail = $request->input('PersEmail');
        $Personal->PersCellphone = $request->input('PersCellphone');
        $Personal->PersAddress = $request->input('PersAddress');
        $Personal->FK_PersCargo = $Cargo;
        $Personal->PersBirthday = $request->input('PersBirthday');
        $Personal->PersPhoneNumber = $request->input('PersPhoneNumber');
        $Personal->PersEPS = $request->input('PersEPS');
        $Personal->PersARL = $request->input('PersARL');
        $Personal->PersLibreta = $request->input('PersLibreta');
        $Personal->PersBank = $request->input('PersBank');
        $Personal->PersBankAccaunt = $request->input('PersBankAccaunt');
        $Personal->PersIngreso = $request->input('PersIngreso');
        $Personal->PersSalida = $request->input('PersSalida');
        $Personal->PersPase = $request->input('PersPase');
        $Personal->PersDelete = 0;
        $Personal->PersSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32).$request->input('PersFirstName').$request->input('PersLastName').substr(md5(rand()), 0,32);
        $Personal->save();

        return redirect()->route('personalInterno.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
            $Personas = DB::table('personals')
                ->join('cargos', 'FK_PersCargo', '=', 'ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('personals.*', 'cargos.CargName','sedes.SedeName','clientes.ID_Cli')
                ->where('PersSlug',$id)
                ->get();
            $IDClienteSegunUsuario = userController::IDClienteSegunUsuario();
             return view('personal.personalInterno.show', compact('Personas', 'IDClienteSegunUsuario'));
         }
        else{
            return route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
            $Persona = Personal::where('PersSlug', $id)->first();
            $Cargo = DB::table('cargos')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->select('areas.ID_Area','cargos.*', 'areas.AreaName', 'sedes.ID_Sede', 'sedes.SedeName')
                ->where('cargos.ID_Carg', $Persona->FK_PersCargo)
                ->get();
            $Sedes = DB::table('sedes')
                ->select('sedes.ID_Sede', 'sedes.SedeName')
                ->where('sedes.FK_SedeCli', userController::IDClienteSegunUsuario())
                ->where('sedes.ID_Sede', '<>', $Cargo[0]->ID_Sede)
                ->get();
            $Areas = DB::table('areas')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->select('areas.ID_Area', 'areas.AreaName')
                ->where('areas.FK_AreaSede', $Cargo[0]->ID_Sede)
                ->where('areas.ID_Area', '<>', $Cargo[0]->ID_Area)
                ->get();
            $Cargos = DB::table('cargos')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->select('cargos.*')
                ->where('cargos.CargArea', $Cargo[0]->ID_Area)
                ->where('cargos.ID_Carg', '<>', $Cargo[0]->ID_Carg)
                ->get();
            return view('personal.personalInterno.edit', compact('Persona', 'Cargo', 'Cargos', 'Sedes', 'Areas'));
        }
        else{
            return route('home');
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
        $Persona = Personal::where('PersSlug', $id)->first();
        $validate = $request->validate([
            'Sede'          => 'required',
            'CargArea'      => 'required',
            'FK_PersCargo'  => 'required',
            'PersDocType'   => 'required|max:3|min:2',
            'PersDocNumber' => 'required|max:25|unique:personals,PersDocNumber,'.$Persona->ID_Pers.',ID_Pers',
            'PersFirstName' => 'required|max:64',
            'PersSecondName'=> 'max:64|nullable',
            'PersLastName'  => 'required|max:64',
            'PersEmail'     => 'required|email|max:255',
            'PersCellphone' => 'required|min:12',
            'PersAddress'   => 'max:255|nullable',
            'PersPhoneNumber' => 'max:20|min:10|nullable',
            'PersEPS'       => 'required|max:255|min:5',
            'PersARL'       => 'required|max:255|min:5',
            'PersLibreta'   => 'max:25',
            'PersPase'      => 'max:25',
            'PersBank'      => 'max:255',
            'PersBankAccaunt' => 'max:64',
            'PersIngreso'   => 'required|date|before:PersSalida',
            'PersSalida'    => 'required|date|after:PersIngreso',
        ]);
        $NuevaArea = $request->input('NewArea');
        $NuevoCargo =  $request->input('NewCargo');
        if($request->input('CargArea') <> "NewArea"){
            $NuevaArea = null;
        }
        if($request->input('FK_PersCargo') <> "NewCargo"){
            $NuevoCargo = null;
        }
        if($NuevoCargo <> null){
            if($NuevaArea <> null){
                $newArea = new Area();
                $newArea->AreaName = $request->input('NewArea');
                $newArea->FK_AreaSede = $request->input('Sede');
                $newArea->AreaDelete = 0;
                $newArea->save();

                $newCargo = new Cargo();
                $newCargo->CargName = $request->input('NewCargo');
                $newCargo->CargArea = $newArea->ID_Area;
                $newCargo->CargDelete = 0;
                $newCargo->save();
                $Cargo = $newCargo->ID_Carg;
            }
            else{
                $newCargo = new Cargo();
                $newCargo->CargName = $request->input('NewCargo');
                $newCargo->CargArea = $request->input('CargArea');
                $newCargo->CargDelete = 0;
                $newCargo->save();
                $Cargo = $newCargo->ID_Carg;
            }
        }
        else{
            $Cargo = $request->input('FK_PersCargo');
        }
        
        $Persona->fill($request->except('FK_PersCargo'));
        $Persona->FK_PersCargo = $Cargo;
        $Persona->save();

        $log = new audit();
        $log->AuditTabla = "personals";
        $log->AuditType = "Modificado";
        $log->AuditRegistro = $Persona->ID_Pers;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $request->all();
        $log->save();

        return redirect()->route('personalInterno.show',['id' => $Persona->PersSlug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $Persona = Personal::where('PersSlug', $id)->first();
        if ($Persona->PersDelete == 0){
            $Persona->PersDelete = 1;
        }
        else{
            $Persona->PersDelete = 0;
        }
        $Persona->save();

        $log = new audit();
        $log->AuditTabla = "personals";
        $log->AuditType = "Eliminado";
        $log->AuditRegistro = $Persona->ID_Pers;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $Persona->PersDelete;
        $log->save();

        return redirect()->route('personalInterno.index');
    }
}
