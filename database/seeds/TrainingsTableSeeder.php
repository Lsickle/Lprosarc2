<?php

use Illuminate\Database\Seeder;
use App\Training;

class TrainingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $training = new Training();
        $training->CapaName = "Alturas";
        $training->CapaTipo = 1;
        $training->save();

        $training = new Training();
        $training->CapaName = "Menejo de residuos";
        $training->CapaTipo = 0;
        $training->save();

        $training = new Training();
        $training->CapaName = "Primeros auxilios";
        $training->CapaTipo = 1;
        $training->save();

        $training = new Training();
        $training->CapaName = "Seguridad y Salud";
        $training->CapaTipo = 0;
        $training->save();

        $training = new Training();
        $training->CapaName = "Manejo del aplicativo";
        $training->CapaTipo = 1;
        $training->save();
    }
}
