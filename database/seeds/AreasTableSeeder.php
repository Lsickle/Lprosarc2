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
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $area->save();

        $area = new Area();
        $area->AreaName = "Operaciones";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $area->save();

        $area = new Area();
        $area->AreaName = "Programacion";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $area->save();

        $area = new Area();
        $area->AreaName = "Planta";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $area->save();

        $area = new Area();
        $area->AreaName = "Almacen";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $area->save();
    }
}
