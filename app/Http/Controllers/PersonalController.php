<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Personal;
use App\Area;
use App\Cargo;
use App\audit;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        /*Validacion del Programador para ver todo el personal externo aun asi este eliminado*/
        if(Auth::user()->UsRol === "Programador"){
            $Personals = DB::table('personals')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','personals.PersEmail','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'areas.AreaName', 'clientes.ID_Cli')
                ->where('clientes.ID_Cli', '<>', 1)
                ->get();
            return view('personal.index', compact('Personals'));
        }
        /*Validacion del personal de Prosarc autorizado para el personal del cliente solo los que no esten eliminados*/
        elseif(Auth::user()->UsRol === "Administrador" || Auth::user()->UsRol === "JefeLogistica" || Auth::user()->UsRol === "AsistenteLogistica" || Auth::user()->UsRol === "AuxiliarLogistica"){
            $Personals = DB::table('personals')
                    ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                    ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                    ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                    ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                    ->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','personals.PersEmail','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'areas.AreaName', 'clientes.ID_Cli')
                    ->where('personals.PersDelete',0)
                    ->where('clientes.ID_Cli', '<>', 1)
                    ->get();
            return view('personal.index', compact('Personals'));
        }
        /*Validacion del cliente que pueda ver solo el personal que tiene a cargo solo los que no esten eliminados*/
        elseif(Auth::user()->UsRol === "Cliente"){
            $Personals = DB::table('personals')
                    ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                    ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                    ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                    ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                    ->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','personals.PersEmail','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'areas.AreaName', 'clientes.ID_Cli')
                    ->where('personals.PersDelete',0)
                    ->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
                    ->get();
            return view('personal.index', compact('Personals'));
        }
        /*Validacion para usuarios no permitidos en esta vista*/
        else{
            return route('home');
        }
    }
     public function indexInterno(){
        /*Validacion del Programador para ver todo el personal interno aun asi este eliminado*/
        if(Auth::user()->UsRol === "Programador"){
            $Personals = DB::table('personals')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','personals.PersEmail','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'areas.AreaName', 'clientes.ID_Cli')
                ->where('clientes.ID_Cli', 1)
                ->get();
            return view('personal.indexinterno', compact('Personals'));
        }
        /*Validacion para el Administrador ver el personal de Prosarc solo los que no esten eliminados*/
        elseif(Auth::user()->UsRol === "Administrador"){
            $Personals = DB::table('personals')
                    ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                    ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                    ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                    ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                    ->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','personals.PersEmail','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'areas.AreaName', 'clientes.ID_Cli')
                    ->where('personals.PersDelete',0)
                    ->where('clientes.ID_Cli', 1)
                    ->get();
            return view('personal.indexinterno', compact('Personals'));
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
        if(Auth::user()->UsRol === "Programador" || Auth::user()->UsRol === "Administrador" || Auth::user()->UsRol === "Cliente"){
            $Sedes = DB::table('sedes')
                ->select('sedes.ID_Sede', 'sedes.SedeName')
                ->where('sedes.FK_SedeCli', userController::IDClienteSegunUsuario())
                ->get();
            return view('personal.create', compact('Sedes'));
        }
        else{
            return route('home');
        }
    }

    public function AreasSedes(Request $request, $id)
    {
        if ($request->ajax()) {
            $Areas = DB::table('areas')
                ->select('*')
                ->where('FK_AreaSede', $id)
                ->get();
            return response()->json($Areas);
        }
    }
    public function CargosAreas(Request $request, $id)
    {
        if ($request->ajax()) {
            $Cargos = DB::table('cargos')
            ->select('*')
            ->where('CargArea', $id)
            ->get();
            return response()->json($Cargos);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if($request->input('NewCargo') <> null){
            if($request->input('NewArea') <> null){
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
        return redirect()->route('personal.index');;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $Personas = DB::table('personals')
            ->join('cargos', 'FK_PersCargo', '=', 'ID_Carg')
            ->select('personals.*', 'cargos.CargName')
            ->where('PersSlug',$id)
            ->get();
         return view('personal.show', compact('Personas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $Persona = Personal::where('PersSlug', $id)->first();
        $Cargos = DB::table('cargos')
            ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
            ->select('areas.ID_Area','cargos.*', 'areas.AreaName')
            ->where('cargos.ID_Carg', $Persona->FK_PersCargo)
            ->get();
        $Areas = DB::table('areas')
            ->select('ID_Area', 'AreaName')
            ->where('ID_Area', '<>', $Cargos[0]->CargArea)
            ->get();
        return view('personal.edit', compact('Persona', 'Cargos', 'Areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        // return $request;
        if($request->input('NewCargo') <> null){
            if($request->input('NewArea') <> null){
                $newArea = new Area();
                $newArea->AreaName = $request->input('NewArea');
                if($request->input('PersType') == 0){
                    $newArea->FK_AreaSede = 2;
                }
                else{
                    $newArea->FK_AreaSede = 1;
                }
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
        
        $Persona = Personal::where('PersSlug', $id)->first();
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

        return redirect()->route('personal.index');
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

        return redirect()->route('personal.index');
    }
}
