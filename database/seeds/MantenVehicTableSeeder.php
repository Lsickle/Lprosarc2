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
        $vehicmanten->MvAceite = "2018-10-15";
        $vehicmanten->MvTecnicoMecanica = "2017-02-15";
        $vehicmanten->Mvtanqueo = "2019-01-15";
        $vehicmanten->MvtanqueoCant = "498943";
        $vehicmanten->FK_MvProgram = "3";
        $vehicmanten->FK_ManVehiculo = "3";
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "485473";
        $vehicmanten->MvAceite = "2018-11-15";
        $vehicmanten->MvTecnicoMecanica = "2018-02-15";
        $vehicmanten->Mvtanqueo = "2019-02-15";
        $vehicmanten->MvtanqueoCant = "32394";
        $vehicmanten->FK_MvProgram = "1";
        $vehicmanten->FK_ManVehiculo = "1";
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "4386";
        $vehicmanten->MvAceite = "2018-11-15";
        $vehicmanten->MvTecnicoMecanica = "2019-02-15";
        $vehicmanten->Mvtanqueo = "2019-01-30";
        $vehicmanten->MvtanqueoCant = "97834";
        $vehicmanten->FK_MvProgram = "2";
        $vehicmanten->FK_ManVehiculo = "2";
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "378232";
        $vehicmanten->MvAceite = "2018-10-16";
        $vehicmanten->MvTecnicoMecanica = "2009-02-15";
        $vehicmanten->Mvtanqueo = "2018-01-15";
        $vehicmanten->MvtanqueoCant = "83828";
        $vehicmanten->FK_MvProgram = "5";
        $vehicmanten->FK_ManVehiculo = "5";
        $vehicmanten->save();
 
        $vehicmanten = new MantenimientoVehiculo();
        $vehicmanten->MvKm = "298823";
        $vehicmanten->MvAceite = "2010-10-15";
        $vehicmanten->MvTecnicoMecanica = "2017-10-15";
        $vehicmanten->Mvtanqueo = "2019-01-01";
        $vehicmanten->MvtanqueoCant = "2393";
        $vehicmanten->FK_MvProgram = "4";
        $vehicmanten->FK_ManVehiculo = "4";
        $vehicmanten->save();
 
    }
}
