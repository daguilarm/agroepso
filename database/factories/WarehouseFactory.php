<?php

use App\Models\Warehouses\Warehouse;

/*
|--------------------------------------------------------------------------
| Factory for profiles
|--------------------------------------------------------------------------
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Warehouse::class, function (Faker\Generator $faker) {
    return [
        'warehouse_ref'        => null,
        'warehouse_company'    => $faker->company,
        'warehouse_lat'        => $faker->latitude($min = 36.7, $max = 43.5),
        'warehouse_lng'        => $faker->latitude($min = -5.9, $max = 2.15),
        'warehouse_nif'        => $faker->swiftBicNumber,
        'warehouse_zip'        => $faker->postcode,
        'warehouse_contact'    => $faker->name,
        'warehouse_address'    => $faker->streetAddress,
        'warehouse_telephone'  => $faker->randomNumber(9),
        'warehouse_city'       => $faker->city,
        'warehouse_country'    => $faker->country,
        'warehouse_region'     => $faker->state,
        'warehouse_state'      => $faker->state,
        'warehouse_telephone'  => $faker->tollFreePhoneNumber,
        'warehouse_observations' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
    ];
});
