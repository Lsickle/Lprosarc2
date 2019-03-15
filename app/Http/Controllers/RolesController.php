<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Personal;
use App\Audit;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class RolesController extends Controller
{   
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $viejousers = DB::table('users')
            ->select('users.id','users.name','users.email','users.created_at','users.updated_at','users.UsType','users.UsAvatar','users.UsStatus','users.UsSlug','users.UsRol','users.UsRolDesc', 'users.FK_UserPers')
            ->get();


        $users = DB::table('users')
                ->join('personals', 'users.FK_UserPers', '=', 'personals.ID_Pers')
                ->select('users.id','users.name','users.email','users.created_at','users.updated_at','users.UsType','users.UsAvatar','users.UsStatus','users.UsSlug','users.UsRol','users.UsRolDesc','users.FK_UserPers','personals.PersDocType','personals.PersDocNumber','personals.PersFirstName','personals.PersSecondName', 'personals.PersLastName','personals.PersCellphone','personals.PersSlug')
                ->get();
        /*if (!$request->User()) {
          return redirect()->route('login');
        }else{
            $request->User()->authorizeRoles(['admin', 'Programador', 'JefeLogistica']);
            // $trainers = Trainer::all();
            return view('permisos.index', compact('users'));
        }*/
        return view('permisos.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $user=User::find($id);
        return view('permisos.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $personas=Personal::all();
        $user=User::find($id);
        // return $user;
        return view('permisos.edit', compact('user', 'personas'));
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
        // return $id;
        $rolDescripcion="";
        $tipoUsuario="";
        switch ($request->UsRol) {
            case '':
                $rolDescripcion="Sin Rol Asignado";
                $tipoUsuario="Sin tipo aignado";
                break;

            case 'Usuario':
                $rolDescripcion="Usuario general";
                $tipoUsuario="Externo";
                break;

            case 'Cliente':
                $rolDescripcion="Cliente registrado";
                $tipoUsuario="Externo";
                break; 

            case 'Generador':
                $rolDescripcion="Generador de residuos";
                $tipoUsuario="Externo";
                break; 

            case 'Auditor':
                $rolDescripcion="Auditor Externo";
                $tipoUsuario="Externo";
                break; 

            case 'JefeLogistica':
                $rolDescripcion="Jefe de Logistica";
                $tipoUsuario="Interno";
                break; 

            case 'AuxiliarLogistica':
                $rolDescripcion="Auxiliar de Logistica";
                $tipoUsuario="Interno";
                break; 

            case 'JefeOperacion':
                $rolDescripcion="Jefe de Operaciones";
                $tipoUsuario="Interno";
                break;    
            
            case 'SupervisorTurno':
                $rolDescripcion="Supervisor de Turno";
                $tipoUsuario="Interno";
                break;    
            
            case 'EncargadoAlmacen':
                $rolDescripcion="Encargado de Almacen";
                $tipoUsuario="Interno";
                break;    
            
            case 'AsistenteLogistica':
                $rolDescripcion="Asistente de Logistica";
                $tipoUsuario="Interno";
                break;    
            
            case 'EncargadoHorno':
                $rolDescripcion="Encargado de Horno";
                $tipoUsuario="Interno";
                break;    
            
            case 'Tesoreria':
                $rolDescripcion="Tesoreria";
                $tipoUsuario="Interno";
                break;    
            
            case 'AdminCuenta':
                $rolDescripcion="Administrador de cuenta";
                $tipoUsuario="Interno";
                break;    
            
            case 'AdminComercial':
                $rolDescripcion="Director Comercial";
                $tipoUsuario="Interno";
                break;    
            
            case 'admin':
                $rolDescripcion="Director de Planta";
                $tipoUsuario="Interno";
                break;    
            
            case 'Programador':
                $rolDescripcion="Programador de Software";
                $tipoUsuario="Interno";
                break; 
            
            default:
                $rolDescripcion="Sin Rol Asignado";
                $tipoUsuario="Interno";
                break;
        };
        if ($request->hasfile('UsAvatar')) {
            $file = $request->file('UsAvatar');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/img/',$name);
        }
        else{
            $name = 'robot400x400.gif';

        };

        $propietario = $request->input('FK_UserPers');

        DB::table('users')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'UsRol' => $request->UsRol,
            'UsStatus' => $request->UsStatus,
            'UsRolDesc' => $rolDescripcion,
            'UsType' => $tipoUsuario,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_by' => $request->updated_by,
            'UsAvatar' => $name,
            'FK_UserPers' => $propietario,
        ]);


        $log = new audit();
        $log->AuditTabla="users";
        $log->AuditType="modificado";
        $log->AuditRegistro=$id;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();


        return redirect()->route('permisos.index');
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
