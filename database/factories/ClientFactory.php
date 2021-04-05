<?php

use App\Models\Clients\Client;

/*
|--------------------------------------------------------------------------
| Factory for profiles
|--------------------------------------------------------------------------
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Client::class, function (Faker\Generator $faker) {
    return [
        'client_name'       => $faker->company,
        'client_email'      => $faker->unique()->safeEmail,
        'client_nif'        => $faker->swiftBicNumber,
        'client_zip'        => $faker->postcode,
        'client_contact'    => $faker->name,
        'client_address'    => $faker->streetAddress,
        'client_city'       => $faker->city,
        'client_country'    => $faker->country,
        'client_region'     => $faker->state,
        'client_state'      => $faker->state,
        'client_web'        => $faker->url,
        'client_telephone'  => $faker->tollFreePhoneNumber,
    ];
});