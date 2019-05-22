<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Personal;
use App\User;

class PermisoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->UsRol == trans('adminlte_lang::message.Programador') || Auth::user()->UsRol == trans('adminlte_lang::message.Administrador')) {
            $UsersSinPersonal = DB::table('users')
                ->where('users.UsRol', '<>', 'Cliente')
                ->where('FK_UserPers', null)
                ->select('users.name', 'users.email', 'users.UsSlug', 'users.UsRol', 'users.UsRol2', 'users.id')
                ->get();
    
            $Personal = DB::table('personals')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->select('sedes.ID_Sede')
                ->first();

            $Users = DB::table('users')
                ->join('personals', 'personals.ID_Pers', '=', 'users.FK_UserPers')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->where('sedes.ID_Sede', $Personal->ID_Sede)
                ->select('personals.PersFirstName', 'personals.PersLastName', 'users.name', 'users.email', 'users.UsSlug', 'users.UsRol', 'users.UsRol2', 'users.id')
                ->get();
           
            return view('permisos.index', compact('Users', 'UsersSinPersonal'));
        } else {
            abort(403);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Personal = DB::table('personals')
            ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
            ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
            ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
            ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
            ->select('sedes.ID_Sede')
            ->first();

        $Users = DB::table('users')
            ->join('personals', 'personals.ID_Pers', '=', 'users.FK_UserPers')
            ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
            ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
            ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
            ->where('sedes.ID_Sede', $Personal->ID_Sede)
            ->select('users.FK_UserPers')
            ->get();
        
        $Personals = DB::table('personals')
            ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
            ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
            ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
            ->where('sedes.ID_Sede', $Personal->ID_Sede)
            ->where(function ($query) use($Users){
                foreach($Users as $User){
                    $query->where('personals.ID_Pers', '<>', $User->FK_UserPers);
                }
            })
            ->select('personals.PersFirstName', 'personals.PersLastName', 'personals.PersSlug')
            ->get();
            
        return view('permisos.create', compact('Personals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Validate = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|max:255|unique:users,email',
            'password'  => 'required|max:255|min:6',
            'UsAvatar'  => 'max:255|mimes:jpeg,bmp,svg,png|nullable',
            'UsRol'     => 'required|max:255',
            'UsRolDesc' => 'max:255|nullable',
            'UsRol2'    => 'required|max:255|nullable',
            'UsRolDesc2'=> 'max:255|nullable',
            'UsType'    => 'max:64|nullable',
            'UsStatus'  => 'max:32|nullable',
        ]);

        $User = new User();
        $User->name = $request->input('name');
        $User->email = $request->input('email');
        $User->password = bcrypt($request->input('password'));

        $User->UsAvatar = $request->input('UsAvatar');
        $User->UsSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc S.A.".substr(md5(rand()), 0,32);

        if ($request->hasfile('UsAvatar')){
            $name = time().$request->UsAvatar->getClientOriginalName();
            $request->UsAvatar->move(public_path('/img/'),$name);
            $Src = '/img/'.$name;
            $User->UsAvatar = $Src;
        }

        $User->UsRol = $request->input('UsRol');
        $User->UsRolDesc = $request->input('UsRolDesc');
        $User->UsRol2 = $request->input('UsRol2');
        $User->UsRolDesc2 = $request->input('UsRolDesc2');
        
        if($request->input('FK_UserPers') !== null){
            $Personal = Personal::where('PersSlug', $request->input('FK_UserPers'))->first();
            $User->FK_UserPers = $Personal->ID_Pers;
        }

        $User->UsType = $request->input('UsType');
        $User->UsStatus = $request->input('UsStatus');
        $User->save();

        return redirect()->route('permisos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $User = User::where('UsSlug', $id)->first();

        return view('permisos.show', compact('User'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $User = User::where('UsSlug', $id)->first();
// return $User; 
        return view('permisos.edit', compact('User'));
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
