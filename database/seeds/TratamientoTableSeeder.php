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
        $tratamiento->TratName = "Incineración";
        $tratamiento->TratTipo = "0";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->save();
        $tratamiento->clasificaciones()->attach([3,4,5,8,10,20,31,51,15]);
        $tratamiento->pretratamientos()->attach([13,15,8]);
        
        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Biologico";
        $tratamiento->TratTipo = "0";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->save();
        $tratamiento->clasificaciones()->attach([31,42,53,84,10,20,31,51,15]);
        $tratamiento->pretratamientos()->attach([1,2]);

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Evaporacion";
        $tratamiento->TratTipo = "1";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "4";
        $tratamiento->save();
        $tratamiento->clasificaciones()->attach([2,4,5,8,10,12,13,14,15]);

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "celda de seguridad";
        $tratamiento->TratTipo = "1";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "2";
        $tratamiento->save();
        $tratamiento->clasificaciones()->attach([23,24,25,28,103,20,31,51,15]);
        $tratamiento->pretratamientos()->attach([2,4,6,8,]);

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "incineración";
        $tratamiento->TratTipo = "0";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->save();
        $tratamiento->clasificaciones()->attach([33,34,35,38,18,20,31,51,19]);
        $tratamiento->pretratamientos()->attach([9,8,7,5]);
    }
}
