<?php

use Illuminate\Database\Seeder;
use App\Requerimiento;
use Faker\Generator as Faker;

class RequerimientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 1;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('sha256', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save(); 

        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 1;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('sha256', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save(); 

    
    }
}
