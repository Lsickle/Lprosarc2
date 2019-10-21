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
        if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones) || in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)){
            return view('pretratamientos.create');
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
                $log->AuditTabla="pretratamientos";
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
        $pretratamiento = Pretratamiento::find($id);

        if (!$pretratamiento) {
            abort(404);
        }
        
        if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones) || in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)){
            return view('pretratamientos.edit', compact('pretratamiento'));
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
    public function update(Request $request, $id)
    {
        
        $pretratamiento = Pretratamiento::where('ID_PreTrat', $id)->first();
        if (!$pretratamiento) {
            abort(404);
        }
        // return $pretratamiento;
        $pretratamiento->PreTratName = $request->input('PreTratName');
        $pretratamiento->PreTratDescription = $request->input('PreTratDescription');
        $pretratamiento->save();

        /*auditoria*/
        $log = new audit();
        $log->AuditTabla="pretratamiento";
        $log->AuditType="Actualizado";
        $log->AuditRegistro=$pretratamiento->ID_PreTrat;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();

        return redirect()->route('pretratamiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)){

            /*se carga el registro del pretratamieento*/
            $pretratamiento = Pretratamiento::find($id);
            /*se elimina la relaciona entre pretratamiento y pretratamientos*/
            $pretratamiento->tratamientos()->detach();

            // $pretratamiento = Pretratamiento::where('ID_PreTrat', $id)->first();
            //     if ($pretratamiento->PreTratDelete == 0) {
            //         $pretratamiento->PreTratDelete = 1;
            //     }
            //     else{
            //         $pretratamiento->PreTratDelete = 0;
            //     }
            // $pretratamiento->save();

            /*se elimina el pretratamiento de la base de datos*/
            $pretratamiento->delete();

            $log = new audit();
            $log->AuditTabla="pretratamientos";
            $log->AuditType="Eliminado";
            $log->AuditRegistro=$pretratamiento->ID_PreTrat;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog = $pretratamiento->PreTratDelete;
            $log->save();
    
            return redirect()->route('pretratamiento.index');
        }else{
            abort(403);
        }
    }
    
}
