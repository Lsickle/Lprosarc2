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
        $tratamiento->TratName = "Incineracion";
        $tratamiento->TratTipo = "0";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->TratPretratamiento = "mezcla";
        $tratamiento->FK_TratRespel = "1";
        $tratamiento->TratDelete = "0";
        $tratamiento->save();
        
        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Biologico";
        $tratamiento->TratTipo = "1";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->TratPretratamiento = "solidificacion";
        $tratamiento->FK_TratRespel = "1";
        $tratamiento->TratDelete = "0";
        $tratamiento->save();

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "Evaporacion";
        $tratamiento->TratTipo = "0";
        $tratamiento->FK_TratProv = "4";
        $tratamiento->TratPretratamiento = "desarme";
        $tratamiento->FK_TratRespel = "2";
        $tratamiento->TratDelete = "0";
        $tratamiento->save();

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "celda de seguridad";
        $tratamiento->TratTipo = "0";
        $tratamiento->FK_TratProv = "2";
        $tratamiento->TratPretratamiento = "desarme";
        $tratamiento->FK_TratRespel = "2";
        $tratamiento->TratDelete = "0";
        $tratamiento->save();

        $tratamiento = new Tratamiento();
        $tratamiento->TratName = "incineracion";
        $tratamiento->TratTipo = "1";
        $tratamiento->FK_TratProv = "1";
        $tratamiento->TratPretratamiento = "solidificacion";
        $tratamiento->FK_TratRespel = "3";
        $tratamiento->TratDelete = "0";
        $tratamiento->save();

        
    }
}
