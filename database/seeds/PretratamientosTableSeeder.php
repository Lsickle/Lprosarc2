<?php

use Illuminate\Database\Seeder;
use App\Pretratamiento;

class PretratamientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "mezcla1";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "1";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "precalentamiento1";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "1";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "desarme1";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "1";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "mezcla2";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "2";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "precalentamiento2";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "2";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "desarme2";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "2";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "mezcla3";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "3";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "precalentamiento3";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "3";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "desarme3";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "3";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "mezcla4";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "4";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "precalentamiento4";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "4";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "desarme4";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "4";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "mezcla5";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "5";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "precalentamiento5";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "5";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "desarme5";
        $pretratamiento->PreTratDelete = "1";
        $pretratamiento->FK_Pre_Trat = "5";
        $pretratamiento->save();
    }
}
