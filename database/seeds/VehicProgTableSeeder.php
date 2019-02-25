<?php

use Illuminate\Database\Seeder;
use App\ProgramacionVehiculo;

class VehicProgTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicleprog = new ProgramacionVehiculo();
        $vehicleprog->ProgVehFecha = "2019-02-20";
        $vehicleprog->progVehKm = "100";
        $vehicleprog->ProgVehTurno = "1";
        $vehicleprog->ProgVehtipo = "0";
        $vehicleprog->ProgVehEntrada = "2018-02-20 1:38:02";
        $vehicleprog->ProgVehSalida = "2018-02-20 16:40:02";
        $vehicleprog->FK_ProgVehiculo = "3";
        $vehicleprog->FK_ProgConductor = "3";
        $vehicleprog->FK_ProgAyudante = "4";
        $vehicleprog->FK_ProgMan = "1";
        $vehicleprog->save();

        $vehicleprog = new ProgramacionVehiculo();
        $vehicleprog->ProgVehFecha = "2019-02-15";
        $vehicleprog->progVehKm = "21214";
        $vehicleprog->ProgVehTurno = "0";
        $vehicleprog->ProgVehtipo = "1";
        $vehicleprog->ProgVehEntrada = "2019-02-15 6:38:10";
        $vehicleprog->ProgVehSalida = "2019-02-15 18:38:10";
        $vehicleprog->FK_ProgVehiculo = "3";
        $vehicleprog->FK_ProgConductor = "3";
        $vehicleprog->FK_ProgAyudante = "5";
        $vehicleprog->FK_ProgMan = "2";
        $vehicleprog->save();

        $vehicleprog = new ProgramacionVehiculo();
        $vehicleprog->ProgVehFecha = "2009-02-15";
        $vehicleprog->progVehKm = "278";
        $vehicleprog->ProgVehTurno = "1";
        $vehicleprog->ProgVehtipo = "1";
        $vehicleprog->ProgVehEntrada = "2000-01-15 17:38:10";
        $vehicleprog->ProgVehSalida = "2019-02-15 17:38:10";
        $vehicleprog->FK_ProgVehiculo = "2";
        $vehicleprog->FK_ProgConductor = "1";
        $vehicleprog->FK_ProgAyudante = "2";
        $vehicleprog->FK_ProgMan = "3";
        $vehicleprog->save();

        $vehicleprog = new ProgramacionVehiculo();
        $vehicleprog->ProgVehFecha = "2019-02-15";
        $vehicleprog->progVehKm = "322";
        $vehicleprog->ProgVehTurno = "0";
        $vehicleprog->ProgVehtipo = "0";
        $vehicleprog->ProgVehEntrada = "2019-01-15 17:38:10";
        $vehicleprog->ProgVehSalida = "2019-01-16 17:38:10";
        $vehicleprog->FK_ProgVehiculo = "5";
        $vehicleprog->FK_ProgConductor = "1";
        $vehicleprog->FK_ProgAyudante = "3";
        $vehicleprog->FK_ProgMan = "4";
        $vehicleprog->save();

        $vehicleprog = new ProgramacionVehiculo();
        $vehicleprog->ProgVehFecha = "2019-02-15";
        $vehicleprog->progVehKm = "632324";
        $vehicleprog->ProgVehTurno = "0";
        $vehicleprog->ProgVehtipo = "1";
        $vehicleprog->ProgVehEntrada = "2019-02-19 17:38:10";
        $vehicleprog->ProgVehSalida = "2019-02-20 17:38:10";
        $vehicleprog->FK_ProgVehiculo = "1";
        $vehicleprog->FK_ProgConductor = "2";
        $vehicleprog->FK_ProgAyudante = "4";
        $vehicleprog->FK_ProgMan = "5";
        $vehicleprog->save();
    }
}
