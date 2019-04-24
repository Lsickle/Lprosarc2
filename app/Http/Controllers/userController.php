<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
}
