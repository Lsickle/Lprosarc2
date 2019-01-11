<?php

use Illuminate\Database\Seeder;
use App\Role;

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
        $role->name = 'admin';
        $role->descripcion = 'Administrador';
        $role->save();

        $role = new Role();
        $role->name = 'Usuario';
        $role->descripcion = 'Usuario';
        $role->save();

        $role = new Role();
        $role->name = 'Cliente';
        $role->descripcion = 'Cliente';
        $role->save();

        $role = new Role();
        $role->name = 'Generador';
        $role->descripcion = 'Generador';
        $role->save();

        $role = new Role();
        $role->name = 'Programador';
        $role->descripcion = 'Programador';
        $role->save();

        $role = new Role();
        $role->name = 'JefeLogistica';
        $role->descripcion = 'Jefe de Logistica';
        $role->save();

        $role = new Role();
        $role->name = 'AuxiliarLogistica';
        $role->descripcion = 'Auxiliar de Logistica';
        $role->save();

        $role = new Role();
        $role->name = 'AsistenteLogistica';
        $role->descripcion = 'Asistente de Logistica';
        $role->save();

        $role = new Role();
        $role->name = 'JefeOperacion';
        $role->descripcion = 'Jefe de Operaciones';
        $role->save();

        $role = new Role();
        $role->name = 'SupervisorTurno';
        $role->descripcion = 'Supervisor de Turno';
        $role->save();

        $role = new Role();
        $role->name = 'EncargadoAlmacen';
        $role->descripcion = 'encargado de almacen';
        $role->save();

        $role = new Role();
        $role->name = 'EncargadoHorno';
        $role->descripcion = 'encargado de horno';
        $role->save();

    }
}
