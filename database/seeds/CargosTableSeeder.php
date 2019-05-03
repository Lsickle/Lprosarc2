<?php

use Illuminate\Database\Seeder;
use App\Cargo;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    	$cargo = new Cargo();
    	$cargo->CargName = "Operario";
    	$cargo->CargSalary = '$ 829,000';
    	$cargo->CargGrade = "Bachiller";
    	$cargo->CargArea = '2';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Jefe";
    	$cargo->CargSalary = '$ 1,300,000';
    	$cargo->CargGrade = "Ingeniero(a)";
    	$cargo->CargArea = '1';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Jefe";
    	$cargo->CargSalary = '$ 3,000,000';
    	$cargo->CargGrade = "Ingeniero(a)";
    	$cargo->CargArea = '4';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Programador";
    	$cargo->CargSalary = '$ 1,200,000';
    	$cargo->CargGrade = "Tecnico";
    	$cargo->CargArea = '3';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Operario";
    	$cargo->CargSalary = '$ 829,000';
    	$cargo->CargGrade = "Bachiller";
    	$cargo->CargArea = '5';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
    	$cargo->save();
    }
}
