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
        $cargo->CargName = "Lider";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '3';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Desarollador";
    	$cargo->CargSalary = '$ 829,000';
    	$cargo->CargGrade = "Profesional";
    	$cargo->CargArea = '3';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
    	$cargo->save();

        $cargo = new Cargo();
        $cargo->CargName = "Jefe";
        $cargo->CargSalary = '$ 1,000,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '5';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Asistente";
    	$cargo->CargSalary = '$ 1,300,000';
    	$cargo->CargGrade = "Profesional";
    	$cargo->CargArea = '5';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Jefe";
    	$cargo->CargSalary = '$ 3,000,000';
    	$cargo->CargGrade = "Profesional";
    	$cargo->CargArea = '6';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Auxiliar";
    	$cargo->CargSalary = '$ 1,200,000';
    	$cargo->CargGrade = "Tecnico";
    	$cargo->CargArea = '5';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
    	$cargo->save();

    	$cargo = new Cargo();
    	$cargo->CargName = "Ingeniero HSEQ";
    	$cargo->CargSalary = '$ 829,000';
    	$cargo->CargGrade = "Profesional";
    	$cargo->CargArea = '4';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
    	$cargo->save();

        $cargo = new Cargo();
        $cargo->CargName = "Director(a)";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '4';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        $cargo = new Cargo();
        $cargo->CargName = "Operario";//Supervisor de Turno
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '6';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        $cargo = new Cargo();
        $cargo->CargName = "Conductor";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '5';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        $cargo = new Cargo();
        $cargo->CargName = "SubGerente";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '1';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        $cargo = new Cargo();
        $cargo->CargName = "Ejecutivo";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '2';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        $cargo = new Cargo();
        $cargo->CargName = "Asistente";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '2';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        $cargo = new Cargo();
        $cargo->CargName = "Tesoreria";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '1';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        $cargo = new Cargo();
        $cargo->CargName = "Gerente General";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '1';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();
    }
}
