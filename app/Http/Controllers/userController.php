<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\audit;
use App\User;

class userController extends Controller
{
    public function verify($code)
{
    $user = User::where('confirmation_code', $code)->first();

    if (! $user)
        return redirect('/');

    $user->confirmed = true;
    $user->confirmation_code = null;
    $user->save();
    return redirect('/home')->with('notification', 'Has confirmado correctamente tu correo!');
}
	public static function IDClienteSegunUsuario(){
		$Cliente = DB::table('personals')
                ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('clientes.ID_Cli')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->get();
        return $Cliente[0]->ID_Cli;
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
		$user = User::where('UsSlug', $id)->first();
		if(isset($user) && $user->id == Auth::user()->id){
	        return view('users.show', compact('user'));
	    }
	    else{
	    	return redirect()->route('home');
	    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $user = User::where('UsSlug', $id)->first();
		if(isset($user) && $user->id == Auth::user()->id){
	        return view('users.edit', compact('user'));
	    }
	    else{
	    	return redirect()->route('home');
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
        $user = User::where('UsSlug', $id)->first();
        $validate = $request->validate([
            'name'          => 'required',
            'email'         => 'required|unique:users,email,'.$user->id.',id',
            'UsAvatar'      => 'mimes:jpeg,jpg,png,gif,web',
        ]);
        // return $request;
        if($request->hasfile('UsAvatar')){
            if($user->UsAvatar <> null && file_exists(public_path().'/img/ImagesProfile/'.$user->UsAvatar)){
                unlink(public_path().'/img/ImagesProfile/'.$user->UsAvatar);
            }
            $file = $request->file('UsAvatar');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/img/ImagesProfile/',$name);
            $user->UsAvatar = $name;
        }
        $user->name = $request->input('name');
        if($request->input('email') <> $user->email){
        	$user->email_verified_at = null;
        }
        $user->email = $request->input('email');
        $user->save();

        $log = new audit();
        $log->AuditTabla = "user";
        $log->AuditType = "Modificado";
        $log->AuditRegistro = $user->id;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $request->all();
        $log->save();

        return redirect()->route('profile', ['id' => $user->UsSlug]);
    }

    public function viewchangepassword($id){
        $user = User::where('UsSlug', $id)->first();
		if(isset($user) && $user->id == Auth::user()->id){
	        return view('users.changepassword', compact('user'));
	    }
	    else{
	    	return redirect()->route('home');
	    }
    }

    public function changepassword(Request $request, $id){
        // return $request;
        $user = User::where('UsSlug', $id)->first();
        $validate = $request->validate([
            'oldpassword'          => 'required|min:6',
            'newpassword'          => 'required|confirmed:confirmnewpassword|min:6',
        ]);
        // return $request;
        if(Hash::check($request->input('oldpassword'), $user->password)){
        	$Menssage = trans('adminlte_lang::message.passwordchangetrue');
        	$user->password = bcrypt($request->input('newpassword'));
        	$user->save();
        }
        else{
        	$Menssage = trans('adminlte_lang::message.passwordchangefalse');
        	return redirect()->route('permisos-edit', ['id' => $user->UsSlug])->with('Menssage', $Menssage)->with('Error', 'Error');
        }

        $log = new audit();
        $log->AuditTabla = "user";
        $log->AuditType = "Modificado";
        $log->AuditRegistro = $user->id;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $request->all();
        $log->save();

        return redirect()->route('profile.changepassword', ['id' => $user->UsSlug])->with('Menssage', $Menssage);
    }
}
