<?php

use Illuminate\Database\Seeder;
use App\Rol;


class RolsTableSeeder extends Seeder
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

        $rol = new Rol();
        $rol->RolName = 'Programador';
        $rol->RolDesc = 'Programador de Software';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'JefeOperaciones';
        $rol->RolDesc = 'Jefe de area Operaciones';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'JefeLogistica';
        $rol->RolDesc = 'Jefe de area Logistica';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'AsistenteLogistica';
        $rol->RolDesc = 'Asistente de area Logistica';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'Hseq';
        $rol->RolDesc = 'Ingeniero de seguridad y salud Ocupacional';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'AdministradorPlanta';
        $rol->RolDesc = 'Jefe de Planta';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'Supervisor';
        $rol->RolDesc = 'Supervisor de Turno';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'Conductor';
        $rol->RolDesc = 'Conductor';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'AdministradorBogota';
        $rol->RolDesc = 'Administrador de la sede Bogotá';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'Comercial';
        $rol->RolDesc = 'Ejecutivo Comercial';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'AsistenteComercial';
        $rol->RolDesc = 'Asistente Comercial';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'Tesorera';
        $rol->RolDesc = 'Tesoreria y facturacion';
        $rol->RolDelete = '0';
        $rol->save();

        $rol = new Rol();
        $rol->RolName = 'jefehseq';
        $rol->RolDesc = 'Jefe de HSEQ';
        $rol->RolDelete = '0';
        $rol->save();

    }
}
