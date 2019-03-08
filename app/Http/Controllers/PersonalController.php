<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Personal;
use App\audit;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $Personals = DB::table('personals')
            ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
            ->select('personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName','personals.PersLastName','personals.PersCellphone','personals.PersSlug','cargos.CargName')
            ->get();
        return view('personal.index', compact('Personals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $Cargos = DB::table('cargos')
            ->join('areas', 'CargArea', '=', 'ID_Area')
            ->select('cargos.ID_Carg','cargos.CargName', 'areas.AreaName')
            ->get();
        return view('personal.create', compact('Cargos'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $Personal = new Personal();
        $Personal->PersDocType = $request->input('PersDocType');
        $Personal->PersDocNumber = $request->input('PersDocNumber');
        $Personal->PersFirstName = $request->input('PersFirstName');
        $Personal->PersSecondName = $request->input('PersSecondName');
        $Personal->PersLastName = $request->input('PersLastName');
        $Personal->PersCellphone = $request->input('PersCellphone');
        $Personal->PersAddress = $request->input('PersAddress');
        $Personal->PersType = $request->input('PersType');
        $Personal->FK_PersCargo = $request->input('FK_PersCargo');
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
        $Personal->PersSlug = "pers".$Personal->PersDocNumber.date('Ymd')."prosarc";
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
        $Personas = DB::table('personals')
            ->select('*')
            ->where('PersSlug',$id)
            ->get();
        $Cargos = DB::table('cargos')
            ->join('areas', 'CargArea', '=', 'ID_Area')
            ->select('cargos.ID_Carg','cargos.CargName', 'areas.AreaName')
            ->get();
        return view('personal.edit', compact('Personas', 'Cargos'));
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
