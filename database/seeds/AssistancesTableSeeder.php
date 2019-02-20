<?php

use Illuminate\Database\Seeder;
use App\Assistance;

class AssistancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $asistencia = new Assistance();
        $asistencia->AsisLlegada = "2019-02-20 07:00:00";
        $asistencia->AsisSalida = "2019-02-20 17:00:00";
        $asistencia->AsisNocturnas = "0";
        $asistencia->FK_AsisPers = "1";
        $asistencia->save();

        $asistencia = new Assistance();
        $asistencia->AsisLlegada = "2019-02-20 19:00:00";
        $asistencia->AsisSalida = "2019-02-21 05:00:00";
        $asistencia->AsisNocturnas = "8";
        $asistencia->FK_AsisPers = "2";
        $asistencia->save();

        $asistencia = new Assistance();
        $asistencia->AsisLlegada = "2019-02-20 09:00:00";
        $asistencia->AsisSalida = "2019-02-20 20:00:00";
        $asistencia->AsisNocturnas = "2";
        $asistencia->FK_AsisPers = "3";
        $asistencia->save();

        $asistencia = new Assistance();
        $asistencia->AsisLlegada = "2019-02-20 07:00:00";
        $asistencia->AsisSalida = "2019-02-20 17:00:00";
        $asistencia->AsisNocturnas = "0";
        $asistencia->FK_AsisPers = "4";
        $asistencia->save();

        $asistencia = new Assistance();
        $asistencia->AsisLlegada = "2019-02-20 10:00:00";
        $asistencia->AsisSalida = "2019-02-20 20:00:00";
        $asistencia->AsisNocturnas = "3";
        $asistencia->FK_AsisPers = "5";
        $asistencia->save();
    }
}
