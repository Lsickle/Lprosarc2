<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pretratamiento;
use App\Permisos;
use App\audit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PretratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)) {
            $pretratamientos = Pretratamiento::all();
        }else{
            $pretratamientos = Pretratamiento::where('PreTratDelete', 0)->get();
        }
        return view('pretratamientos.index', compact('pretratamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {                
        return view('pretratamientos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['ID_PreTrat']!==null) {
            for ($x=0; $x < count($request['PreTratName']); $x++) {
                $pretratamiento = new Pretratamiento();
                $pretratamiento->PreTratName = $request['PreTratName'][$x];
                $pretratamiento->PreTratDescription = $request['PreTratDescription'][$x];
                $pretratamiento->PreTratDelete = 0;
                $pretratamiento->save();

                $log = new audit();
                $log->AuditTabla="pretratamiento";
                $log->AuditType="Creado";
                $log->AuditRegistro=$pretratamiento->ID_PreTrat ;
                $log->AuditUser=Auth::user()->email;
                $log->Auditlog=$request->all();
                $log->save();
            }
        }
        return redirect()->route('pretratamiento.index');
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
