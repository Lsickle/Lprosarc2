<?php

use Illuminate\Database\Seeder;
use App\role;
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
        $role_user = Role::where('name','Usuario')->first();
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
        $role_ehorno = Role::where('name','EncargadoHorno')->first();

        $user = new User();
        $user->name = 'Luis';
        $user->email = 'suser@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Luis1';
        $user->save();
        $user->roles()->attach($role_suser);

        $user = new User();
        $user->name = 'User';
        $user->email = 'User@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'User1';
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Leider';
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Leider1';
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Juan';
        $user->email = 'jefelogistica@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Juan1';
        $user->save();
        $user->roles()->attach($role_jlogistica);

        $user = new User();
        $user->name = 'Victor';
        $user->email = 'jefeoperacion@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Victor1';
        $user->save();
        $user->roles()->attach($role_joperacion);

        $user = new User();
        $user->name = 'Duvan';
        $user->email = 'asistentelogistica@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Duvan1';
        $user->save();
        $user->roles()->attach($role_asistlogistica);

        $user = new User();
        $user->name = 'TestClient';
        $user->email = 'Cliente@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'TestClient1';
        $user->save();
        $user->roles()->attach($role_client);

        $user = new User();
        $user->name = 'GeneradorProsarc';
        $user->email = 'Generador@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'GeneradorProsarc1';
        $user->save();
        $user->roles()->attach($role_gener);

        $user = new User();
        $user->name = 'Peter';
        $user->email = 'AuxiliarLogistica@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Peter1';
        $user->save();
        $user->roles()->attach($role_auxlogistica);

        $user = new User();
        $user->name = 'Camilo';
        $user->email = 'Supervisor1Turno@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Camilo1';
        $user->save();
        $user->roles()->attach($role_sturno);

        $user = new User();
        $user->name = 'William';
        $user->email = 'Supervisor2Turno@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'William1';
        $user->save();
        $user->roles()->attach($role_sturno);

        $user = new User();
        $user->name = 'Camilo2';
        $user->email = 'Supervisor3Turno@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Camilo21';
        $user->save();
        $user->roles()->attach($role_sturno);

        $user = new User();
        $user->name = 'Sandro';
        $user->email = 'EncargadoAlmacen@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Sandro1';
        $user->save();
        $user->roles()->attach($role_ealmacen);

        $user = new User();
        $user->name = 'Horno';
        $user->email = 'EncargadoHorno@mail.com';
        $user->password = bcrypt('secret');
        $user->UsSlug = 'Horno1';
        $user->save();
        $user->roles()->attach($role_ehorno);

    }
}
