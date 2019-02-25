<?php

use Illuminate\Database\Seeder;
use App\Activo;

class ActivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activo = new Activo();
        $activo->ActName = "Portatil";
        $activo->ActUnid = "1";
        $activo->ActCant = "5";
        $activo->ActSerialProsarc = "AKQM928";
        $activo->ActSerialProveed = "AKQM9CFT028";
        $activo->ActModel = "hhj";
        $activo->ActTalla = "676";
        $activo->ActObserv = "Creando un activo";
        $activo->FK_ActSub = "1";
        $activo->FK_ActSede = "1";
        $activo->save();

        $activo = new Activo();
        $activo->ActName = "Silla";
        $activo->ActUnid = "0";
        $activo->ActCant = "500";
        $activo->ActSerialProsarc = "FGVG687";
        $activo->ActSerialProveed = "GFDB67754";
        $activo->ActModel = "Unica";
        $activo->ActTalla = "XXL";
        $activo->ActObserv = "Creando una silla";
        $activo->FK_ActSub = "5";
        $activo->FK_ActSede = "5";
        $activo->save();

        $activo = new Activo();
        $activo->ActName = "Cubo";
        $activo->ActUnid = "0";
        $activo->ActCant = "50";
        $activo->ActSerialProsarc = "GY6EWHUF";
        $activo->ActSerialProveed = "FYYEYF32";
        $activo->ActModel = "LL";
        $activo->ActTalla = "347";
        $activo->ActObserv = "Creando un cubo de agua";
        $activo->FK_ActSub = "3";
        $activo->FK_ActSede = "3";
        $activo->save();

        $activo = new Activo();
        $activo->ActName = "Mesa";
        $activo->ActUnid = "1";
        $activo->ActCant = "5";
        $activo->ActSerialProsarc = "GGS747";
        $activo->ActSerialProveed = "GHSE873";
        $activo->ActModel = "ultima generacion";
        $activo->ActTalla = "78df";
        $activo->ActObserv = "Creando una mesa unica";
        $activo->FK_ActSub = "2";
        $activo->FK_ActSede = "2";
        $activo->save();

        $activo = new Activo();
        $activo->ActName = "Mapa";
        $activo->ActUnid = "1";
        $activo->ActCant = "20";
        $activo->ActSerialProsarc = "G73";
        $activo->ActSerialProveed = "GD6";
        $activo->ActModel = "METALICOXLS";
        $activo->ActTalla = "100";
        $activo->ActObserv = "Creando un mapa";
        $activo->FK_ActSub = "4";
        $activo->FK_ActSede = "4";
        $activo->save();
    }
}
