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
    	$cargo->CargSalary = '829000';
    	$cargo->CargGrade = "Bachiller";
    	$cargo->CargArea = '2';
        $cargo->CargDelete = 0;
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Jefe";
    	$cargo->CargSalary = '1300000';
    	$cargo->CargGrade = "Ingeniero(a)";
    	$cargo->CargArea = '1';
        $cargo->CargDelete = 0;
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Jefe";
    	$cargo->CargSalary = '3000000';
    	$cargo->CargGrade = "Ingeniero(a)";
    	$cargo->CargArea = '4';
        $cargo->CargDelete = 0;
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Programador";
    	$cargo->CargSalary = '1200000';
    	$cargo->CargGrade = "Tecnico";
    	$cargo->CargArea = '3';
        $cargo->CargDelete = 0;
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Operario";
    	$cargo->CargSalary = '829000';
    	$cargo->CargGrade = "Bachiller";
    	$cargo->CargArea = '5';
        $cargo->CargDelete = 0;
    	$cargo->save();
    }
}
