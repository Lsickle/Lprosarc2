<?php

use Illuminate\Database\Seeder;
use App\Area;
use Faker\Generator as Faker;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        /*AREAS PROSARC*//*AREAS PROSARC*//*AREAS PROSARC*//*AREAS PROSARC*//*AREAS PROSARC*/
        /*id = 01*/
        $area = new Area();
        $area->AreaName = "Administrativa";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "2";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 02*/
        $area = new Area();
        $area->AreaName = "Comercial";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "2";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 03*/
        $area = new Area();
        $area->AreaName = "Comunicaciones e informática";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 04*/
        $area = new Area();
        $area->AreaName = "Administrativa";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 05*/
        $area = new Area();
        $area->AreaName = "Logística";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 06*/
        $area = new Area();
        $area->AreaName = "Operaciones";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 07*/
        $area = new Area();
        $area->AreaName = "HSEQ";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 08*/
        $area = new Area();
        $area->AreaName = "Mantenimiento";
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "1";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();

        /*AREAS EXTERNAS*//*AREAS EXTERNAS*//*AREAS EXTERNAS*//*AREAS EXTERNAS*/
        /*id = 09*/
        $area = new Area();
        $area->AreaName = $faker->randomElement(['operaciones', 'logistica', 'principal']);
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "3";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 10*/
        $area = new Area();
        $area->AreaName = $faker->randomElement(['compras', 'ambiental']);
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "3";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 11*/
        $area = new Area();
        $area->AreaName = $faker->randomElement(['operaciones', 'logistica', 'principal']);
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "4";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 12*/
        $area = new Area();
        $area->AreaName = $faker->randomElement(['compras']);
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "4";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 13*/
        $area = new Area();
        $area->AreaName = $faker->randomElement(['ambiental']);
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "4";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 14*/
        $area = new Area();
        $area->AreaName = $faker->randomElement(['operaciones', 'logistica', 'principal']);
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "5";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 15*/
        $area = new Area();
        $area->AreaName = $faker->randomElement(['compras', 'ambiental']);
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "5";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 16*/
        $area = new Area();
        $area->AreaName = $faker->randomElement(['operaciones', 'logistica', 'principal']);
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "6";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 17*/
        $area = new Area();
        $area->AreaName = $faker->randomElement(['compras']);
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "6";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
        
        /*id = 18*/
        $area = new Area();
        $area->AreaName = $faker->randomElement(['ambiental']);
        $area->AreaDelete = 0;
        $area->FK_AreaSede = "6";
        $area->AreaSlug = hash('sha256', rand().time().$area->AreaName);
        $area->save();
    }
}
