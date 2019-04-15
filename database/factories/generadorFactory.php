<?php

use Faker\Generator as Faker;

$factory->define(App\Generador::class, function (Faker $faker) {
	$slug=$faker->numberBetween($min = 100, $max = 200);
	$title = $faker->company();
	$sufixcompany = $faker->randomElement(['C.A.', 'S.A.','SAS', 'ONG']);
	$cactualizado = $faker->dateTime($max = 'now');
	$ccreado= $faker->dateTime($max = $cactualizado);
	$GenerName=$title.' '.$sufixcompany;
	$GenerClisede = $faker->numberBetween($min = 1, $max = 60);
    return [
       	'GenerNit'=> $faker->numerify('###.###.###.###-#'),
        'GenerName'=> $GenerName,
        'GenerShortname'=> $title,
        'GenerCode'=> $faker->optional($weight = 0.3)->bothify('Cli ##??'), /*70% chance of NULL*/
        'GenerType'=>  $faker->randomElement(['organico', 'biologico','industrial', 'medicamentos', 'otros']),
        'FK_GenerCli'=> $GenerClisede,
        'created_at'=> $ccreado,
        'updated_at'=> $cactualizado,
        'GenerDelete'=> 0,
        'GenerSlug'=> str_slug('cli'.$title.$slug)
    ];

});
