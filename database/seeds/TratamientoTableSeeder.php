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
        $tratamiento->TratPretratamiento = "mezcla";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->save();
        
        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Biologico";
        $tratamiento->TratTipo = "0";
        $tratamiento->TratPretratamiento = "solidificacion";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->save();

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Evaporacion";
        $tratamiento->TratTipo = "1";
        $tratamiento->TratPretratamiento = "desarme";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "4";
        $tratamiento->save();

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "celda de seguridad";
        $tratamiento->TratTipo = "1";
        $tratamiento->TratPretratamiento = "desarme";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "2";
        $tratamiento->save();

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "incineración";
        $tratamiento->TratTipo = "0";
        $tratamiento->TratPretratamiento = "solidificacion";
        $tratamiento->TratDelete = "0";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->save();
    }
}
