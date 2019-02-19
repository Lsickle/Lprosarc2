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
        $area->AreaSede = "1";
        $area->save();

        $area = new Area();
        $area->AreaName = "Operaciones";
        $area->AreaSede = "40";
        $area->save();

        $area = new Area();
        $area->AreaName = "Programacion";
        $area->AreaSede = "3";
        $area->save();

        $area = new Area();
        $area->AreaName = "Planta";
        $area->AreaSede = "35";
        $area->save();

        $area = new Area();
        $area->AreaName = "Almacen";
        $area->AreaSede = "60";
        $area->save();
    }
}
