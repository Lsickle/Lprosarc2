<?php

use Illuminate\Database\Seeder;
use App\Cargo;
use Faker\Generator as Faker;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $faker = \Faker\Factory::create();
        /*cargos prosarc*//*cargos prosarc*//*cargos prosarc*//*cargos prosarc*/
        /*id = 01*/    
        $cargo = new Cargo();
        $cargo->CargName = "Lider";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '3';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 2*/    
    	$cargo = new Cargo();
    	$cargo->CargName = "Desarollador";
    	$cargo->CargSalary = '$ 829,000';
    	$cargo->CargGrade = "Profesional";
    	$cargo->CargArea = '3';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
    	$cargo->save();

        /*id = 3*/    
        $cargo = new Cargo();
        $cargo->CargName = "Jefe";
        $cargo->CargSalary = '$ 1,000,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '5';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 4*/    
    	$cargo = new Cargo();
    	$cargo->CargName = "Asistente";
    	$cargo->CargSalary = '$ 1,300,000';
    	$cargo->CargGrade = "Profesional";
    	$cargo->CargArea = '5';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
    	$cargo->save();

        /*id = 5*/    
    	$cargo = new Cargo();
    	$cargo->CargName = "Jefe";
    	$cargo->CargSalary = '$ 3,000,000';
    	$cargo->CargGrade = "Profesional";
    	$cargo->CargArea = '6';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
    	$cargo->save();

        /*id = 6*/    
    	$cargo = new Cargo();
    	$cargo->CargName = "Auxiliar";
    	$cargo->CargSalary = '$ 1,200,000';
    	$cargo->CargGrade = "Tecnico";
    	$cargo->CargArea = '5';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
    	$cargo->save();

        /*id = 7*/    
    	$cargo = new Cargo();
    	$cargo->CargName = "Ingeniero HSEQ";
    	$cargo->CargSalary = '$ 829,000';
    	$cargo->CargGrade = "Profesional";
    	$cargo->CargArea = '4';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
    	$cargo->save();

        /*id = 8*/    
        $cargo = new Cargo();
        $cargo->CargName = "Director(a)";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '4';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 9*/    
        $cargo = new Cargo();
        $cargo->CargName = "Operario";//Supervisor de Turno
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '6';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 10*/    
        $cargo = new Cargo();
        $cargo->CargName = "Conductor";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '5';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 11*/    
        $cargo = new Cargo();
        $cargo->CargName = "SubGerente";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '1';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 12*/    
        $cargo = new Cargo();
        $cargo->CargName = "Ejecutivo";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '2';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 13*/    
        $cargo = new Cargo();
        $cargo->CargName = "Asistente";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '2';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 14*/    
        $cargo = new Cargo();
        $cargo->CargName = "Tesoreria";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '1';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 15*/    
        $cargo = new Cargo();
        $cargo->CargName = "Gerente General";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '1';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 16*/    
        $cargo = new Cargo();
        $cargo->CargName = "JefeHSEQ";
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = "Profesional";
        $cargo->CargArea = '1';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*Cargos Externos*//*Cargos Externos*//*Cargos Externos*//*Cargos Externos*//*Cargos Externos*/
        /*id = 17*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Auxiliar', 'Operario', 'Jefe de bodega', 'Almacenista']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Bachiller', 'Profesional']);
        $cargo->CargArea = '9';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 18*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Asistente', 'Gerente']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Profesional', 'Doctor']);
        $cargo->CargArea = '9';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 19*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Auxiliar', 'Operario', 'Jefe de bodega', 'Almacenista']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Bachiller', 'Profesional']);
        $cargo->CargArea = '10';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 20*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Asistente', 'Gerente']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Profesional', 'Doctor']);
        $cargo->CargArea = '10';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 21*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Auxiliar', 'Operario', 'Jefe de bodega', 'Almacenista']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Bachiller', 'Profesional']);
        $cargo->CargArea = '11';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 22*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Asistente', 'Gerente']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Profesional', 'Doctor']);
        $cargo->CargArea = '11';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 23*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Auxiliar', 'Operario', 'Jefe de bodega', 'Almacenista']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Bachiller', 'Profesional']);
        $cargo->CargArea = '12';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 24*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Asistente', 'Gerente']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Profesional', 'Doctor']);
        $cargo->CargArea = '12';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 25*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Auxiliar', 'Operario', 'Jefe de bodega', 'Almacenista']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Bachiller', 'Profesional']);
        $cargo->CargArea = '13';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 26*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Asistente', 'Gerente']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Profesional', 'Doctor']);
        $cargo->CargArea = '13';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 27*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Auxiliar', 'Operario', 'Jefe de bodega', 'Almacenista']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Bachiller', 'Profesional']);
        $cargo->CargArea = '14';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 28*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Asistente', 'Gerente']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Profesional', 'Doctor']);
        $cargo->CargArea = '14';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 29*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Auxiliar', 'Operario', 'Jefe de bodega', 'Almacenista']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Bachiller', 'Profesional']);
        $cargo->CargArea = '15';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 30*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Asistente', 'Gerente']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Profesional', 'Doctor']);
        $cargo->CargArea = '15';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 31*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Auxiliar', 'Operario', 'Jefe de bodega', 'Almacenista']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Bachiller', 'Profesional']);
        $cargo->CargArea = '16';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 32*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Asistente', 'Gerente']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Profesional', 'Doctor']);
        $cargo->CargArea = '16';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 33*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Auxiliar', 'Operario', 'Jefe de bodega', 'Almacenista']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Bachiller', 'Profesional']);
        $cargo->CargArea = '17';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 34*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Asistente', 'Gerente']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Profesional', 'Doctor']);
        $cargo->CargArea = '17';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 35*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Auxiliar', 'Operario', 'Jefe de bodega', 'Almacenista']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Bachiller', 'Profesional']);
        $cargo->CargArea = '18';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();

        /*id = 36*/    
        $cargo = new Cargo();
        $cargo->CargName = $faker->randomElement(['Asistente', 'Gerente']);
        $cargo->CargSalary = '$ 829,000';
        $cargo->CargGrade = $faker->randomElement(['Profesional', 'Doctor']);
        $cargo->CargArea = '18';
        $cargo->CargDelete = 0;
        $cargo->CargSlug = hash('sha256', rand().time().$cargo->CargName);
        $cargo->save();


    }
}
