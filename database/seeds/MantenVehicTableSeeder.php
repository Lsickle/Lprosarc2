<?php

use Illuminate\Database\Seeder;
use App\MantenimientoVehiculo;

class MantenVehicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "2131";
        $vehicmanten->MvType = "aceite";
        $vehicmanten->HoraMavInicio = "2019-02-25 10:28:19";
        $vehicmanten->HoraMavFin = "2019-02-25 12:28:19";
        $vehicmanten->FK_VehMan = "3";
        $vehicmanten->MvDelete = 0;
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "485473";
        $vehicmanten->MvType = "tanqueo";
        $vehicmanten->HoraMavInicio = "2019-02-25 10:28:19";
        $vehicmanten->HoraMavFin = "2019-02-25 12:28:19";
        $vehicmanten->FK_VehMan = "1";
        $vehicmanten->MvDelete = 0;
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "4386";
        $vehicmanten->MvType = "tecnomecanica";
        $vehicmanten->HoraMavInicio = "2019-02-25 10:28:19";
        $vehicmanten->HoraMavFin = "2019-02-25 12:28:19";
        $vehicmanten->FK_VehMan = "2";
        $vehicmanten->MvDelete = 0;
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "378232";
        $vehicmanten->MvType = "aceite";
        $vehicmanten->HoraMavInicio = "2019-02-25 10:28:19";
        $vehicmanten->HoraMavFin = "2019-02-25 12:28:19";
        $vehicmanten->FK_VehMan = "5";
        $vehicmanten->MvDelete = 0;
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "298823";
        $vehicmanten->MvType = "tanqueo";
        $vehicmanten->HoraMavInicio = "2019-02-25 10:28:19";
        $vehicmanten->HoraMavFin = "2019-02-25 12:28:19";
        $vehicmanten->FK_VehMan = "4";
        $vehicmanten->MvDelete = 0;
        $vehicmanten->save();
 
    }
}
