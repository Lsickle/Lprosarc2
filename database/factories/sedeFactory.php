<?php

use Faker\Generator as Faker;

/*factory para la tabla seder*/

$factory->define(App\sede::class, function (Faker $faker) {
	$sedename=$faker->randomElement(['norte', 'sur','este', 'oeste', 'principal']);
	$slug=$sedename.' '.$faker->unique()->numberBetween($min = 100, $max = 900);
	$sactualizado = $faker->dateTime($max = 'now');
	$screado= $faker->dateTime($max = $sactualizado);

	$cellpart2=$faker->optional($weight = 0.9)->numerify('#######');/*10% chance of NULL*/

	if ($cellpart2!=null) {
		$cellpart1=$faker->numberBetween($min = 300, $max = 316);
		$ext1= $faker->optional($weight = 0.3)->numerify('####');/*70% chance of NULL*/
		$cellpart4=$faker->optional($weight = 0.9)->numerify('#######');/*10% chance of NULL*/
	}else{
		$cellpart4=null;
		$cellpart1=null;
		$cellpart3=null;
		$ext2=null;
		$ext1=null;
	};

	if ($cellpart4!=null) {
		$cellpart3=$faker->numberBetween($min = 300, $max = 316);
		$ext2= $faker->optional($weight = 0.3)->numerify('####');/*70% chance of NULL*/
	}else{
		$cellpart3=null;
		$ext2=null;
	};

	$sedecorreo=$sedename.'@'.$faker->freeEmailDomain();

    return [
        'SedeName'=> $sedename,
        'SedeAddress'=> $faker->address(),
        'SedePhone1'=> '('.$cellpart1.')'.$cellpart2,
        'SedeExt1'=>  $ext1,
        'SedePhone2'=> '('.$cellpart3.')'.$cellpart4,
        'SedeExt2'=> $ext2,
        'SedeEmail'=> $sedecorreo,
        'SedeCelular'=> $faker->optional($weight = 0.8)->numerify('###.###.###.###-#'),/*20% chance of NULL*/
        'SedeSlug'=> str_slug($slug), /*$title-$sedeclass,*/
        'created_at'=> $screado,
        'updated_at'=> $sactualizado
    ];
});