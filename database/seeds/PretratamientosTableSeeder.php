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
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "1";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "precalentamiento1";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "1";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "desarme1";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "1";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "mezcla2";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "2";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "precalentamiento2";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "2";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "desarme2";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "2";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "mezcla3";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "3";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "precalentamiento3";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "3";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "desarme3";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "3";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "mezcla4";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "4";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "precalentamiento4";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "4";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "desarme4";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "4";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "mezcla5";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "5";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "precalentamiento5";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "0";
        $pretratamiento->FK_Pre_Trat = "5";
        $pretratamiento->save();

        $pretratamiento = new Pretratamiento();
        $pretratamiento->PreTratName = "desarme5";
        $pretratamiento->PreTratDescription = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $pretratamiento->PreTratDelete = "1";
        $pretratamiento->FK_Pre_Trat = "5";
        $pretratamiento->save();
    }
}
