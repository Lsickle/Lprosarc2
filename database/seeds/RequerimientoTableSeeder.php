<?php

use Illuminate\Database\Seeder;
use App\Requerimiento;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class RequerimientoTableSeeder extends Seeder
{
    public function relatedpretrat($trat)
    {
        $faker = \Faker\Factory::create();
        switch ($trat) {
            case '1':
            
            $values = array();

            for ($i = 0; $i < 2; $i++) {
              // get a random digit, but always a new one, to avoid duplicates
                $values[] = $faker->unique()->randomElement([13, 15, 8]);
            }
                // $Requerimiento->pretratamientosSelected()->sync($values);
                break;

            case '2':
            $values = array();

            for ($i = 0; $i < 1; $i++) {
              // get a random digit, but always a new one, to avoid duplicates
                $values[] = $faker->unique()->randomElement([1, 2]);
            }
                // $Requerimiento->pretratamientosSelected()->sync($values);
                break;

            case '3':
            $values = array();

            for ($i = 0; $i < 4; $i++) {
              // get a random digit, but always a new one, to avoid duplicates
                $values[] = $faker->unique()->randomElement([2, 4, 5, 8, 10, 12, 13, 14, 15]);
            }
                // $Requerimiento->pretratamientosSelected()->sync($values);
                break;

            case '4':
            $values = array();

            for ($i = 0; $i < 3; $i++) {
              // get a random digit,  but always a new one, to avoid duplicates
                $values[] = $faker->unique()->randomElement([2, 4, 6, 8]);
            }
                // $Requerimiento->pretratamientosSelected()->sync($values);
                break;
            
            default:
                // 
                break;
        }
        return $values;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
        /*respel 1*/
        /*id = 1 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 1;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 2 */
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
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 3 */
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
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 2*/
        /*id = 4 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 2;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 5 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 2;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 6 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 2;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 3*/
        /*id = 7 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 3;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 8 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 3;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 9 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 3;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 4*/
        /*id = 10 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 4;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 11 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 4;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 12 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 4;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 5*/
        /*id = 13 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 5;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 14 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 5;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 15 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 5;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 6*/
        /*id = 16 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 6;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 17 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 6;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 18 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 6;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 7*/
        /*id = 19 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 7;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 20 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 7;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 21 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 7;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 8*/
        /*id = 22 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 8;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 23 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 8;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 24 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 8;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 9*/
        /*id = 25 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 9;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 26 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 9;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 27 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 9;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 10*/
        /*id = 28 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 10;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 29 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 10;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 30 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 10;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 11*/
        /*id = 31 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 11;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 32 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 11;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 33 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 11;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 12*/
        /*id = 34 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 12;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 35 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 12;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 36 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 12;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 13*/
        /*id = 37 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 13;
        $Requerimiento->ofertado = 1;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 38 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 13;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 39 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 13;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 14*/
        /*id = 40 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 14;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 41 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 14;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 42 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 14;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*respel 15*/
        /*id = 43 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 15;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 44 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 15;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

        /*id = 45 */
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqFotoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDescargue = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqVideoDestruccion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqAuditoria = $faker->randomElement([NULL, 1]); 
        $Requerimiento->ReqDevolucion = $faker->randomElement([NULL, 1]); 
        $Requerimiento->FK_ReqRespel = 15;
        $Requerimiento->ofertado = 0;
        $Requerimiento->FK_ReqTrata = $faker->numberBetween($min = 1, $max = 4);
        $Requerimiento->forevaluation = 1;
        $Requerimiento->ReqSlug = hash('md5', rand().time().$Requerimiento->FK_ReqRespel.$Requerimiento->FK_ReqTrata);
        $Requerimiento->save();
        $Requerimiento->pretratamientosSelected()->sync($this->relatedpretrat($Requerimiento->FK_ReqTrata));
        

    
    }
}
