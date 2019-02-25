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
        $vehicmanten->MvStatus = "1";
        $vehicmanten->MvType = "aceite";
        $vehicmanten->HoraMavInicio = "2019-02-25 10:28:19";
        $vehicmanten->HoraMavFin = "2019-02-25 12:28:19";
        $vehicmanten->FK_VehMan = "3";
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "485473";
        $vehicmanten->MvStatus = "0";
        $vehicmanten->MvType = "tanqueo";
        $vehicmanten->HoraMavInicio = "2019-02-25 10:28:19";
        $vehicmanten->HoraMavFin = "2019-02-25 12:28:19";
        $vehicmanten->FK_VehMan = "1";
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "4386";
        $vehicmanten->MvStatus = "1";
        $vehicmanten->MvType = "tecnomecanica";
        $vehicmanten->HoraMavInicio = "2019-02-25 10:28:19";
        $vehicmanten->HoraMavFin = "2019-02-25 12:28:19";
        $vehicmanten->FK_VehMan = "2";
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "378232";
        $vehicmanten->MvStatus = "0";
        $vehicmanten->MvType = "aceite";
        $vehicmanten->HoraMavInicio = "2019-02-25 10:28:19";
        $vehicmanten->HoraMavFin = "2019-02-25 12:28:19";
        $vehicmanten->FK_VehMan = "5";
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "298823";
        $vehicmanten->MvStatus = "1";
        $vehicmanten->MvType = "tanqueo";
        $vehicmanten->HoraMavInicio = "2019-02-25 10:28:19";
        $vehicmanten->HoraMavFin = "2019-02-25 12:28:19";
        $vehicmanten->FK_VehMan = "4";
        $vehicmanten->save();
 
    }
}
