<?php

use Illuminate\Database\Seeder;
use App\SolicitudServicio;

class SolicitudServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = 'Aprobado';
        $Servicio->SolSerTipo = 'Interno';
        $Servicio->SolSerAuditable = '1';
        $Servicio->SolSerConductor = '3';
        $Servicio->SolSerVehiculo = 'PSY-462';
        $Servicio->SolSerSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Servicio->FK_SolSerCliente = '2';
        $Servicio->FK_SolSerPersona = '2';
        $Servicio->SolSerDelete = '0';
        $Servicio->save();

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = 'Negada';
        $Servicio->SolSerTipo = 'Externo';
        $Servicio->SolSerAuditable = '1';
        $Servicio->SolSerConductor = 'Juan';
        $Servicio->SolSerVehiculo = 'HDT-567';
        $Servicio->SolSerSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Servicio->FK_SolSerCliente = '1';
        $Servicio->FK_SolSerPersona = '1';
        $Servicio->SolSerDelete = '0';
        $Servicio->save();

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = 'Pendiente';
        $Servicio->SolSerTipo = 'Alquilado';
        $Servicio->SolSerAuditable = NULL;
        $Servicio->SolSerConductor = 'Cristian';
        $Servicio->SolSerVehiculo = 'HGT-478';
        $Servicio->SolSerSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Servicio->FK_SolSerCliente = '5';
        $Servicio->FK_SolSerPersona = '5';
        $Servicio->SolSerDelete = '0';
        $Servicio->save();

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = 'Incompleta';
        $Servicio->SolSerTipo = 'Interno';
        $Servicio->SolSerAuditable = '1';
        $Servicio->SolSerConductor = '';
        $Servicio->SolSerVehiculo = '';
        $Servicio->SolSerSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Servicio->FK_SolSerCliente = '3';
        $Servicio->FK_SolSerPersona = '3';
        $Servicio->SolSerDelete = '0';
        $Servicio->save();

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = 'Incompleta';
        $Servicio->SolSerTipo = 'Interno';
        $Servicio->SolSerAuditable = NULL;
        $Servicio->SolSerConductor = '';
        $Servicio->SolSerVehiculo = '';
        $Servicio->SolSerSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Servicio->FK_SolSerCliente = '4';
        $Servicio->FK_SolSerPersona = '4';
        $Servicio->SolSerDelete = '0';
        $Servicio->save();
    }
}
