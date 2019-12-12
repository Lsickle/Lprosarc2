<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PermisoUserRequest;
use App\AuditRequest;
use App\Personal;
use App\Sede;
use App\User;
use App\audit;
use App\Permisos;

class PermisoClienteController extends Controller
{
    public function __construct()
    {
        $this->table = 'users';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
            // usuarios sin personal
            $UsersSinPersonal = DB::table('users')
                ->where('users.UsRol', 'Cliente')
                ->where('FK_UserPers', null)
                ->where(function ($query){
                    if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
                    }else{
                        $query->where('DeleteUser', 0);
                    }
                })
                ->select('users.name', 'users.email', 'users.UsSlug', 'users.UsRolDesc', 'users.UsRolDesc2', 'users.id', 'users.DeleteUser')
                ->get();

            // personal de mi sede
            $Personal = DB::table('personals')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->select('sedes.ID_Sede', 'clientes.ID_Cli')
                ->first();

            // usuarios con personal de la sede
            $Users = DB::table('users')
                ->join('personals', 'personals.ID_Pers', '=', 'users.FK_UserPers')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                ->where(function ($query) use ($Personal){
                    if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)){
                        $query->where('clientes.ID_Cli', $Personal->ID_Cli);
                    }else{
                        $query->where('sedes.ID_Sede', $Personal->ID_Sede);
                        $query->where('DeleteUser', 0);
                    }
                })
                ->where('users.UsRol', 'Cliente')
                ->select('personals.PersFirstName', 'personals.PersLastName', 'users.name', 'users.email', 'users.UsSlug', 'users.UsRolDesc', 'users.UsRolDesc2', 'users.id', 'users.DeleteUser')
                ->get();
           
            return view('usuariosexternos.index', compact('Users', 'UsersSinPersonal'));
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
        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {

            $Roles = DB::table('rols')
                ->where('rols.RolDelete', 0)
                ->where('rols.RolName', '<>', 'Programador')
                ->get();

             // Sede del usuario
            $SedeSlug = userController::IDSedeSegunUsuario();
            $Sede = Sede::select('ID_Sede')->where('SedeSlug', $SedeSlug)->first();

            // Usuarios que tienen personal
            $Users = DB::table('users')
                ->join('personals', 'personals.ID_Pers', '=', 'users.FK_UserPers')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->where('sedes.ID_Sede', $Sede->ID_Sede)
                ->where('DeleteUser', 0)
                ->select('users.FK_UserPers')
                ->get();

            // personal de una sede en concreto
            $Personals = DB::table('personals')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->where('sedes.ID_Sede', $Sede->ID_Sede)
                ->where(function ($query) use($Users){
                    foreach($Users as $User){
                        $query->where('personals.ID_Pers', '<>', $User->FK_UserPers);
                    }
                })
                ->select('personals.PersFirstName', 'personals.PersLastName', 'personals.PersSlug')
                ->get();
                
            return view('usuariosexternos.create', compact('Personals', 'Roles'));
        }else{
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
        $Validate = $request->validate([
            'email'     => 'required|max:255|unique:users,email',
            'password'  => 'required|max:255|min:8|confirmed:password_confirmation',
            'name'      => 'required|max:64',
            'UsAvatar'  => 'max:5120|mimes:jpeg,svg,png,gif,jpg|nullable',
        ]);

        $User = new User();
        $User->name = $request->input('name');
        $User->email = $request->input('email');
        $User->password = bcrypt($request->input('password'));
        $User->UsRol = 'Cliente';
        $User->UsRolDesc = 'Usuario General';
        $User->UsRol2 = 'Cliente';
        $User->UsRolDesc2 = 'Usuario General';
        $User->UsSlug = hash('sha256', rand().time().$User->name);

        if ($request->hasfile('UsAvatar')){
            $name = time().$request->UsAvatar->getClientOriginalName();
            $request->UsAvatar->move(public_path('/img/ImagesProfile/'),$name);
            $User->UsAvatar = $name;
        }

        if($request->input('FK_UserPers') !== null){
            $Personal = Personal::where('PersSlug', $request->input('FK_UserPers'))->first();
            $User->FK_UserPers = $Personal->ID_Pers;
            $User->UsStatus = trans('adminlte_lang::message.userstatusactive');
        }else{
            $User->UsStatus = trans('adminlte_lang::message.userstatusinactive');
        }

        $User->save();

        return redirect()->route('UsuariosCliente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {

            $User = User::where('UsSlug', $id)->first();
            if (!$User) {
                abort(404);
            }
            $Personal = Personal::where('ID_Pers', $User->FK_UserPers)->first();

            return view('usuariosexternos.show', compact('User', 'Personal'));
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {

            $User = User::where('UsSlug', $id)->first();
            if (!$User) {
                abort(404);
            }
            $Personal = Personal::select('PersFirstName', 'PersLastName', 'PersSlug', 'ID_Pers')->where('ID_Pers', $User->FK_UserPers)->first();
            
            // Sede del usuario
            $SedeSlug = userController::IDSedeSegunUsuario();
            $Sede = Sede::select('ID_Sede')->where('SedeSlug', $SedeSlug)->first();
            
            // Usuarios que tienen personal
            $Users = DB::table('users')
                ->join('personals', 'personals.ID_Pers', '=', 'users.FK_UserPers')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->where('sedes.ID_Sede', $Sede->ID_Sede)
                ->where('DeleteUser', 0)
                ->select('users.FK_UserPers')
                ->get();

            // personal de una sede en concreto
            $Personals = DB::table('personals')
            ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
            ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
            ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
            ->where('sedes.ID_Sede', $Sede->ID_Sede)
            ->where(function ($query) use($Users, $User){
                foreach($Users as $User){
                    $query->where('personals.ID_Pers', '<>', $User->FK_UserPers);
                }
            })
            ->select('personals.PersFirstName', 'personals.PersLastName', 'personals.PersSlug', 'personals.ID_Pers')
            ->get();
            
            $Roles = DB::table('rols')
                ->where('rols.RolDelete', 0)
                ->where('rols.RolName', '<>', 'Programador')
                ->get();
            
            return view('usuariosexternos.edit', compact('User', 'Personals', 'Roles', 'Personal'));
        }else{
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

        $User = User::where('UsSlug', $id)->first();
        if (!$User) {
            abort(404);
        }
        $Validate = $request->validate([
            'email'     => 'required|max:255|unique:users,email',
            'password'  => 'required|max:255|min:8|confirmed:password_confirmation',
            'name'      => 'required|max:64',
            'UsAvatar'  => 'max:5120|mimes:jpeg,svg,png,gif,jpg|nullable',
        ]);
        $User->fill($request->except('UsAvatar', 'UsRol', 'UsRol2', 'FK_UserPers', 'UsStatus'));
        $User->UsRol = 'Cliente';
        $User->UsRolDesc = 'Usuario General';
        $User->UsRol2 = 'Cliente';
        $User->UsRolDesc2 = 'Usuario General';

        if($request->input('FK_UserPers') !== null){
            $Personal = Personal::where('PersSlug', $request->input('FK_UserPers'))->first();
            $User->FK_UserPers = $Personal->ID_Pers;
            $User->UsStatus = trans('adminlte_lang::message.userstatusactive');
        }else{
            $User->FK_UserPers = null;
            $User->UsStatus = trans('adminlte_lang::message.userstatusinactive');
        }

        if ($request->hasfile('UsAvatar')){

            // Verifica si existe la imagen en la carpeta para eliminarla
            $image = public_path('/img/ImagesProfile/'.$User->UsAvatar);
            if(@getimagesize($image)){
                unlink(public_path()."/img/ImagesProfile/".$User->UsAvatar);
            };

            $file = $request->file('UsAvatar');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path('/img/ImagesProfile/'),$name);
            $User->UsAvatar = $name;
        }

        $User->save();

        AuditRequest::auditUpdate($this->table, $User->id, json_encode($request->all()));

        return redirect()->route('UsuariosCliente.show', compact('id'));
    }

    public function editpassword($id){
        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {

            $User = User::select('UsSlug')->where('UsSlug', $id)->first();
            if (!$User) {
                abort(404);
            }
            return view('usuariosexternos.editpassword', compact('User'));
        }else{
            abort(403);
        }
    }

    public function updatepassword(Request $request, $id){
        $User = User::where('UsSlug', $id)->first();
        if (!$User) {
            abort(404);
        }
        $validate = $request->validate([
            'newpassword' => 'required|confirmed:confirmnewpassword|min:8',
        ]);
        $User->password = bcrypt($request->input('newpassword'));
        $User->save();

        AuditRequest::auditUpdate($this->table, $User->id, json_encode($request->all()));
        
        return redirect()->route('UsuariosCliente.show', compact('id'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {

            $User = User::where('UsSlug', $id)->first();
            if (!$User) {
                abort(404);
            }
            if($User->DeleteUser == 0){
                $User->DeleteUser = 1;
                $User->save();

                AuditRequest::auditDelete($this->table, $User->id, 1);

                return redirect()->route('UsuariosCliente.index');
            }else{
                $User->DeleteUser = 0;
                $User->save();

                AuditRequest::auditRestored($this->table, $User->id, 0);

                return redirect()->route('UsuariosCliente.show', compact('id'));
            }
        }else{
            abort(403);
        }
    }
}
