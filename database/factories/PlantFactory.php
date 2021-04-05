<?php

use App\Models\Plants\Plant;

/*
|--------------------------------------------------------------------------
| Factory for profiles
|--------------------------------------------------------------------------
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Plant::class, function (Faker\Generator $faker) {
    return [
        'plant_ref'        => null,
        'plant_company'    => $faker->company,
        'plant_lat'        => $faker->latitude($min = 36.7, $max = 43.5),
        'plant_lng'        => $faker->latitude($min = -5.9, $max = 2.15),
        'plant_name'       => $faker->company,
        'plant_nif'        => $faker->swiftBicNumber,
        'plant_zip'        => $faker->postcode,
        'plant_email'      => $faker->unique()->safeEmail,
        'plant_contact'    => $faker->name,
        'plant_address'    => $faker->streetAddress,
        'plant_telephone'  => $faker->tollFreePhoneNumber,
        'plant_city'       => $faker->city,
        'plant_country'    => $faker->country,
        'plant_region'     => $faker->state,
        'plant_state'      => $faker->state,
        'plant_telephone'  => $faker->tollFreePhoneNumber,
        'plant_nif_alt'        => $faker->swiftBicNumber,
        'plant_zip_alt'        => $faker->postcode,
        'plant_email_alt'      => $faker->unique()->safeEmail,
        'plant_contact_alt'    => $faker->name,
        'plant_address_alt'    => $faker->streetAddress,
        'plant_telephone_alt'  => $faker->randomNumber(9),
        'plant_city_alt'       => $faker->city,
        'plant_region_alt'     => $faker->state,
        'plant_state_alt'      => $faker->state,
        'plant_telephone_alt'  => $faker->tollFreePhoneNumber,
        'plant_observations'   => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
    ];
});
