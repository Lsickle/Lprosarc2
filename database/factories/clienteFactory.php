<?php

use Faker\Generator as Faker;



/*factory para la tabla cliente*/
$factory->define(App\cliente::class, function (Faker $faker) {
	$slug=$faker->numberBetween($min = 100, $max = 200);
	$title = $faker->company();
	$sufixcompany = $faker->randomElement(['C.A.', 'S.A.','SAS', 'ONG']);
	$cactualizado = $faker->dateTime($max = 'now');
	$ccreado= $faker->dateTime($max = $cactualizado);
	$CliName=$title.' '.$sufixcompany;

    return [
        'CliNit'=> $faker->numerify('###.###.###.###-#'),
        'CliName'=> $CliName,
        'CliShortname'=> $title,
        'CliCode'=> $faker->optional($weight = 0.3)->bothify('Cli ##??'), /*70% chance of NULL*/
        'CliType'=>  $faker->randomElement(['organico', 'biologico','industrial', 'medicamentos', 'otros']),
        'CliCategoria'=> $faker->randomElement(['cliente', 'generador','transportador', 'Proveedor']),
        'CliAuditable'=> $faker->boolean($chanceOfGettingTrue = 50),
        'created_at'=> $ccreado,
        'updated_at'=> $cactualizado,
        'CliSlug'=> str_slug('cli'.$title.$slug)
    ];
});

