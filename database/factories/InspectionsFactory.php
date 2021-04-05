<?php

use App\Models\Inspections\Inspection;

/*
|--------------------------------------------------------------------------
| Factory for Inspection
|--------------------------------------------------------------------------
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Inspection::class, function (Faker\Generator $faker) {
    //Inspection date
    $date = $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now')->format('d/m/Y');

    //Inspection result
    $inspection_result = null;

    //Inspection result
    $inspection_status = rand(1, 3);

    if($inspection_status === 1) {
        $inspection_planed = $inspection_date = null;
    }

    if($inspection_status === 2) {
        $inspection_planed = $date;
        $inspection_date = null;
    }

    if($inspection_status === 3) {
        $inspection_planed = $date;
        $inspection_date = $date;
        $inspection_result = rand(1, 3);
    }

    return [
        'plot_id'                       => 1,
        'client_id'                     => 1,
        'crop_id'                       => 1,
        'user_id'                       => 1,
        'city_id'                       => 1,
        'inspection_date'               => $inspection_date,
        'inspection_total_time'         => rand(60, 240),
        'inspection_planing_date'       => $inspection_planed,
        'inspection_status'             => $inspection_status,
        'inspection_type'               => rand(1, 4),
        'inspection_result'             => $inspection_result,
        'inspection_data'               => null,
        'inspection_observations'       => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
    ];
});
