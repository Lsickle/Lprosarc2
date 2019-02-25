<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $area = new Area();
        $area->AreaName = "Logistica";
        $area->FK_AreaSede = "1";
        $area->save();

        $area = new Area();
        $area->AreaName = "Operaciones";
        $area->FK_AreaSede = "40";
        $area->save();

        $area = new Area();
        $area->AreaName = "Programacion";
        $area->FK_AreaSede = "3";
        $area->save();

        $area = new Area();
        $area->AreaName = "Planta";
        $area->FK_AreaSede = "35";
        $area->save();

        $area = new Area();
        $area->AreaName = "Almacen";
        $area->FK_AreaSede = "60";
        $area->save();
    }
}
