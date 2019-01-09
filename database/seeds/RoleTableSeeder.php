<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name= 'admin';
        $role->descripcion= 'Administrador';
        $role->save();

        $role = new Role();
        $role->name= 'user';
        $role->descripcion= 'User';
        $role->save();

        $role = new Role();
        $role->name= 'superuser';
        $role->descripcion= 'programador';
        $role->save();

        $role = new Role();
        $role->name= 'jefelogistica';
        $role->descripcion= 'jefe de logistica';
        $role->save();

        $role = new Role();
        $role->name= 'jefeoperacion';
        $role->descripcion= 'jefe de operaciones';
        $role->save();

    }
}
