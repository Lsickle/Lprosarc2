<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = DB::table('role_user')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select(   'users.id', 
                        'users.name', 
                        'users.email', 
                        'users.created_at',  
                        'users.updated_at', 
                        'users.UsType', 
                        'users.UsAvatar', 
                        'users.UsStatus', 
                        'users.UsSlug', 
                        'users.UsRol', 
                        'users.UsRolDesc'
                        )
        ->get();

        if (!$request->User()) {
          return redirect()->route('login');
        }else{
            $request->User()->authorizeRoles(['admin', 'Programador', 'JefeLogistica']);
            // $trainers = Trainer::all();
            return view('permisos.index', compact('users'));
        }
        // return view('permisos.index', compact('users'));
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
        $user=User::find($id);
        // return $user;
        return view('permisos.edit', compact('user'));
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
        // return $request;
        $rolDescripcion="";
        switch ($request->UsRol) {
            case '':
                $rolDescripcion="Sin Rol Asignado";
                break;

            case 'Usuario':
                $rolDescripcion="Usuario general";
                break;

            case 'Cliente':
                $rolDescripcion="Cliente registrado";
                break; 

            case 'Generador':
                $rolDescripcion="Generador de residuos";
                break; 

            case 'Auditor':
                $rolDescripcion="Auditor Externo";
                break; 

            case 'JefeLogistica':
                $rolDescripcion="Jefe de Logistica";
                break; 

            case 'AuxiliarLogistica':
                $rolDescripcion="Auxiliar de Logistica";
                break; 

            case 'JefeOperacion':
                $rolDescripcion="Jefe de Operaciones";
                break;    
            
            case 'SupervisorTurno':
                $rolDescripcion="Supervisor de Turno";
                break;    
            
            case 'EncargadoAlmacen':
                $rolDescripcion="Encargado de Almacen";
                break;    
            
            case 'AsistenteLogistica':
                $rolDescripcion="Asistente de Logistica";
                break;    
            
            case 'EncargadoHorno':
                $rolDescripcion="Encargado de Horno";
                break;    
            
            case 'Tesoreria':
                $rolDescripcion="Tesoreria";
                break;    
            
            case 'AdminCuenta':
                $rolDescripcion="Administrador de cuenta";
                break;    
            
            case 'AdminComercial':
                $rolDescripcion="Director Comercial";
                break;    
            
            case 'admin':
                $rolDescripcion="Director de Planta";
                break;    
            
            case 'Programador':
                $rolDescripcion="Programador de Software";
                break; 
            
            default:
                $rolDescripcion="Sin Rol Asignado";
                break;
        };
        DB::table('users')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'UsRol' => $request->UsRol,
            'UsStatus' => $request->UsStatus,
            'UsRolDesc' => $rolDescripcion,
        ]);
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
