<?php

use Illuminate\Database\Seeder;
use App\TrainingPersonal;

class TrainingPersonalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $CapaPer = new TrainingPersonal();
        $CapaPer->FK_Sede = "1";
        $CapaPer->FK_Capa = "4";
        $CapaPer->FK_Pers = "1";
        $CapaPer->CapaPersDate = "2019-02-19";
        $CapaPer->CapaPersExpire = "2019-12-19";
        $CapaPer->save();

        $CapaPer = new TrainingPersonal();
        $CapaPer->FK_Sede = "40";
        $CapaPer->FK_Capa = "5";
        $CapaPer->FK_Pers = "3";
        $CapaPer->CapaPersDate = "2018-11-20";
        $CapaPer->CapaPersExpire = "2019-06-20";
        $CapaPer->save();

        $CapaPer = new TrainingPersonal();
        $CapaPer->FK_Sede = "60";
        $CapaPer->FK_Capa = "3";
        $CapaPer->FK_Pers = "2";
        $CapaPer->CapaPersDate = "2019-02-19";
        $CapaPer->CapaPersExpire = "2019-12-19";
        $CapaPer->save();

        $CapaPer = new TrainingPersonal();
        $CapaPer->FK_Sede = "50";
        $CapaPer->FK_Capa = "1";
        $CapaPer->FK_Pers = "5";
        $CapaPer->CapaPersDate = "2019-01-07";
        $CapaPer->CapaPersExpire = "2019-06-06";
        $CapaPer->save();

        $CapaPer = new TrainingPersonal();
        $CapaPer->FK_Sede = "15";
        $CapaPer->FK_Capa = "2";
        $CapaPer->FK_Pers = "4";
        $CapaPer->CapaPersDate = "2018-02-28";
        $CapaPer->CapaPersExpire = "2019-07-30";
        $CapaPer->save();
    }
}
