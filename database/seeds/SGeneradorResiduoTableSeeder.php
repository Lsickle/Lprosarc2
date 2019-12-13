<?php

use Illuminate\Database\Seeder;
use App\ResiduosGener;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;


class SGeneradorResiduoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "1";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 1, $max = 2);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "1";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 4, $max = 5);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "2";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 1, $max = 2);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "2";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 4, $max = 5);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "3";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 1, $max = 2);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "3";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 4, $max = 5);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "4";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 1, $max = 2);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "4";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 4, $max = 5);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "5";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 1, $max = 2);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "5";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 4, $max = 5);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "6";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 1, $max = 2);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "6";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 4, $max = 5);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "7";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 1, $max = 2);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "7";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 4, $max = 5);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "8";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 7, $max = 8);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "8";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 10, $max = 11);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "9";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 7, $max = 8);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "9";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 10, $max = 11);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "10";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 7, $max = 8);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "10";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 10, $max = 11);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "11";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 7, $max = 8);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "11";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 10, $max = 11);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "12";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 7, $max = 8);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "12";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 10, $max = 11);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "13";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 7, $max = 8);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "13";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 10, $max = 11);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "14";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 7, $max = 8);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "14";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 10, $max = 11);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "15";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 7, $max = 8);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "15";
        $SGenerRes->FK_Respel = $faker->numberBetween($min = 10, $max = 11);
        $SGenerRes->SlugSGenerRes = hash('sha256', rand().time().$SGenerRes->FK_SGener.$SGenerRes->FK_Respel);
        $SGenerRes->DeleteSGenerRes = 0;
        $SGenerRes->save();




        
    }
}
