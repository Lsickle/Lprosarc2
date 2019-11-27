<?php

use Illuminate\Database\Seeder;
use App\Tratamiento;

class TratamientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "TermoDestrucción";
        $tratamiento->TratTipo = "0";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->save();
        $tratamiento->clasificaciones()->attach([3,4,5,8,10,20,31,51,15]);
        $tratamiento->pretratamientos()->attach([13,15,8]);
        
        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Celda de Seguridad";
        $tratamiento->TratTipo = "1";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "4";
        $tratamiento->save();
        $tratamiento->clasificaciones()->attach([31,42,53,84,10,20,31,51,15]);
        $tratamiento->pretratamientos()->attach([1,2]);

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "TermoDestrucción";
        $tratamiento->TratTipo = "1";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "4";
        $tratamiento->save();
        $tratamiento->clasificaciones()->attach([2,4,5,8,10,12,13,14,15]);

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Celda de Seguridad";
        $tratamiento->TratTipo = "1";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "6";
        $tratamiento->save();
        $tratamiento->clasificaciones()->attach([23,24,25,28,103,20,31,51,15]);
        $tratamiento->pretratamientos()->attach([2,4,6,8,]);

    }
}
