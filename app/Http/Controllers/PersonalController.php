<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::user()->UsRol === "Programador"){
            $Personals = DB::table('personals')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                 ->join('areas', 'CargArea', '=', 'ID_Area')
                ->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'areas.AreaName')
                ->get();
            return view('personal.index', compact('Personals'));
        }
        $Personals = DB::table('personals')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                 ->join('areas', 'CargArea', '=', 'ID_Area')
                ->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','cargos.CargName','personals.PersDelete','personals.ID_Pers', 'areas.AreaName')
                ->where('personals.PersDelete',0)
                ->get();
        return view('personal.index', compact('Personals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $Areas = DB::table('areas')
            ->select('areas.ID_Area', 'areas.AreaName')
            ->get();
        return view('personal.create', compact('Areas'));
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
        $Cadena = '0123456789abcdefghijklmnopqrstuvwxyz';
        $Personal->PersSlug = "pers".substr(str_shuffle($Cadena), 0, 80)."prosarc";
        $Personal->save();

        $log = new audit();
        $log->AuditTabla="Personal";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Personal->ID_Pers;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

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
            ->select('areas.ID_Area','cargos.CargArea', 'areas.AreaName')
            ->where('cargos.ID_Carg', $Persona->FK_PersCargo)
            ->get();
        // return $Cargos[0]->CargArea;
        $Areas = DB::table('areas')
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
        $Persona = Personal::where('PersSlug', $id)->first();
        $Persona->fill($request->all());
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
