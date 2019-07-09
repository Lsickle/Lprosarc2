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
        $area->AreaName = "Administrativa";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "2";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();

        $area = new Area();
        $area->AreaName = "Comercial";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "2";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();

        $area = new Area();
        $area->AreaName = "Comunicaciones e informática";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();

        $area = new Area();
        $area->AreaName = "Administrativa";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();

        $area = new Area();
        $area->AreaName = "Logística";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();

        $area = new Area();
        $area->AreaName = "Operaciones";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
    }
}
