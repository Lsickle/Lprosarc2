<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$role_user = Role::where('name','Usuario')->first();
        $role_admin = Role::where('name','admin')->first();
        $role_jlogistica = Role::where('name','JefeLogistica')->first();
        $role_joperacion = Role::where('name','JefeOperacion')->first();
        $role_suser = Role::where('name','Programador')->first();
        $role_client = Role::where('name','Cliente')->first();
        $role_gener = Role::where('name','Generador')->first();
        $role_auxlogistica = Role::where('name','AuxiliarLogistica')->first();
        $role_asistlogistica = Role::where('name','AsistenteLogistica')->first();
        $role_sturno = Role::where('name','SupervisorTurno')->first();
        $role_ealmacen = Role::where('name','EncargadoAlmacen')->first();
        $role_ehorno = Role::where('name','EncargadoHorno')->first();*/

        $user = new User();
        $user->name = 'Luis';
        $user->email = 'suser@gmail.com';
        $user->email_verified_at = '2019-04-17 10:25:10';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Luis1';
        $user->UsRol = 'Programador';
        $user->UsRolDesc = 'Programador de Software';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        
        /*$user->roles()->attach($role_suser);*/

        $user = new User();
        $user->name = 'Vigilante';
        $user->email = 'User@gmail.com';
        $user->email_verified_at = '2019-04-17 10:25:11';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'User1';
        $user->UsRol = 'Vigilante';
        $user->UsRolDesc = 'Seguridad Fisica';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_user);*/

        $user = new User();
        $user->name = 'Leider';
        $user->email = 'admin@gmail.com';
        $user->email_verified_at = '2019-04-17 10:25:11';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Leider1';
        $user->UsRol = 'Administrador';
        $user->UsRolDesc = 'Director de Planta';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_admin);*/

        $user = new User();
        $user->name = 'Juan';
        $user->email = 'jefelogistica@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Juan1';
        $user->UsRol = 'JefeLogistica';
        $user->UsRolDesc = 'Jefe de Logistica';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_jlogistica);*/

        $user = new User();
        $user->name = 'Victor';
        $user->email = 'jefeoperacion@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Victor1';
        $user->UsRol = 'JefeOperacion';
        $user->UsRolDesc = 'Jefe de Operaciones';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_joperacion);*/

        $user = new User();
        $user->name = 'Duvan';
        $user->email = 'asistentelogistica@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Duvan1';
        $user->UsRol = 'AsistenteLogistica';
        $user->UsRolDesc = 'Asistente de Logistica';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_asistlogistica);*/

        $user = new User();
        $user->name = 'TestClient';
        $user->email = 'Cliente@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'TestClient1';
        $user->UsRol = 'Cliente';
        $user->UsRolDesc = 'Cliente registrado';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_client);*/

        $user = new User();
        $user->name = 'GeneradorProsarc';
        $user->email = 'Generador@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'GeneradorProsarc1';
        $user->UsRol = 'Generador';
        $user->UsRolDesc = 'Generador de residuos';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_gener);*/

        $user = new User();
        $user->name = 'Peter';
        $user->email = 'AuxiliarLogistica@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Peter1';
        $user->UsRol = 'AuxiliarLogistica';
        $user->UsRolDesc = 'Auxiliar de Logistica';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_auxlogistica);*/

        $user = new User();
        $user->name = 'Camilo';
        $user->email = 'Supervisor1Turno@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Camilo1';
        $user->UsRol = 'SupervisorTurno';
        $user->UsRolDesc = 'Supervisor de Turno';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_sturno);*/

        $user = new User();
        $user->name = 'William';
        $user->email = 'Supervisor2Turno@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'William1';
        $user->UsRol = 'SupervisorTurno';
        $user->UsRolDesc = 'Supervisor de Turno';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_sturno);*/

        $user = new User();
        $user->name = 'Camilo2';
        $user->email = 'Supervisor3Turno@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Camilo21';
        $user->UsRol = 'SupervisorTurno';
        $user->UsRolDesc = 'Supervisor de Turno';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_sturno);*/

        $user = new User();
        $user->name = 'Sandro';
        $user->email = 'EncargadoAlmacen@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Sandro1';
        $user->UsRol = 'EncargadoAlmacen';
        $user->UsRolDesc = 'Encargado de Almacen';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_ealmacen);*/

        $user = new User();
        $user->name = 'Horno';
        $user->email = 'EncargadoHorno@gmail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Horno1';
        $user->UsRol = 'EncargadoHorno';
        $user->UsRolDesc = 'Encargado de Horno';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
        /*$user->roles()->attach($role_ehorno);*/

        $user = new User();
        $user->name = 'Lorena Urriago';
        $user->email = 'comercial1@prosarc.com.co';
        $user->email_verified_at = '2019-04-17 10:25:10';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Lorena1';
        $user->UsRol = 'Comercial';
        $user->UsRolDesc = 'Comercial Administrativo';
        $user->UsRol2 = 'Usuario';
        $user->UsRolDesc2 = 'Usuario general';
        $user->UsAvatar = 'robot400x400.gif';
        $user->FK_UserPers = '1';
        $user->save();
    }
}
