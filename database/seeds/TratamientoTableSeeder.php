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
        $tratamiento->TratName = "Insineracion";
        $tratamiento->TratTipo = "0";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->save();
        
        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Biologico";
        $tratamiento->TratTipo = "1";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->save();

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Evaporacion";
        $tratamiento->TratTipo = "1";
        $tratamiento->FK_TratProv = "4";
        $tratamiento->save();

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Enterado";
        $tratamiento->TratTipo = "0";
        $tratamiento->FK_TratProv = "2";
        $tratamiento->save();

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Cortado";
        $tratamiento->TratTipo = "1";
        $tratamiento->FK_TratProv = "5";
        $tratamiento->save();

        
    }
}
