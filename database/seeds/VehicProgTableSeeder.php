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
        $vehicleprog->ProgVehFeriado = "1";
        $vehicleprog->ProgVehEntrada = "2018-02-20 1:38:02";
        $vehicleprog->ProgVehSalida = "2018-02-20 16:40:02";
        $vehicleprog->HoraMantenimientoInicio = "2019-01-20 16:38:02";
        $vehicleprog->HoraMAntenimientoFin = "2019-02-18 16:20:02";
        $vehicleprog->FK_ProgVeh = "1";
        $vehicleprog->save();

        $vehicleprog = new ProgramacionVehiculo();
        $vehicleprog->ProgVehFecha = "2019-02-15";
        $vehicleprog->progVehKm = "21214";
        $vehicleprog->ProgVehTurno = "0";
        $vehicleprog->ProgVehtipo = "1";
        $vehicleprog->ProgVehFeriado = "0";
        $vehicleprog->ProgVehEntrada = "2019-02-15 6:38:10";
        $vehicleprog->ProgVehSalida = "2019-02-15 18:38:10";
        $vehicleprog->HoraMantenimientoInicio = "2017-10-15 17:38:10";
        $vehicleprog->HoraMAntenimientoFin = "2019-02-15 17:38:10";
        $vehicleprog->FK_ProgVeh = "3";
        $vehicleprog->save();

        $vehicleprog = new ProgramacionVehiculo();
        $vehicleprog->ProgVehFecha = "2009-02-15";
        $vehicleprog->progVehKm = "278";
        $vehicleprog->ProgVehTurno = "1";
        $vehicleprog->ProgVehtipo = "1";
        $vehicleprog->ProgVehFeriado = "1";
        $vehicleprog->ProgVehEntrada = "2000-01-15 17:38:10";
        $vehicleprog->ProgVehSalida = "2019-02-15 17:38:10";
        $vehicleprog->HoraMantenimientoInicio = "2019-01-15 17:38:10";
        $vehicleprog->HoraMAntenimientoFin = "2019-02-15 17:38:10";
        $vehicleprog->FK_ProgVeh = "2";
        $vehicleprog->save();

        $vehicleprog = new ProgramacionVehiculo();
        $vehicleprog->ProgVehFecha = "2019-02-15";
        $vehicleprog->progVehKm = "322";
        $vehicleprog->ProgVehTurno = "0";
        $vehicleprog->ProgVehtipo = "0";
        $vehicleprog->ProgVehFeriado = "0";
        $vehicleprog->ProgVehEntrada = "2019-01-15 17:38:10";
        $vehicleprog->ProgVehSalida = "2019-01-16 17:38:10";
        $vehicleprog->HoraMantenimientoInicio = "2019-02-15 17:38:10";
        $vehicleprog->HoraMAntenimientoFin = "2019-02-18 17:38:10";
        $vehicleprog->FK_ProgVeh = "1";
        $vehicleprog->save();

        $vehicleprog = new ProgramacionVehiculo();
        $vehicleprog->ProgVehFecha = "2019-02-15";
        $vehicleprog->progVehKm = "632324";
        $vehicleprog->ProgVehTurno = "0";
        $vehicleprog->ProgVehtipo = "1";
        $vehicleprog->ProgVehFeriado = "1";
        $vehicleprog->ProgVehEntrada = "2019-02-19 17:38:10";
        $vehicleprog->ProgVehSalida = "2019-02-20 17:38:10";
        $vehicleprog->HoraMantenimientoInicio = "2018-01-15 17:38:10";
        $vehicleprog->HoraMAntenimientoFin = "2018-02-15 17:38:10";
        $vehicleprog->FK_ProgVeh = "1";
        $vehicleprog->save();
    }
}
