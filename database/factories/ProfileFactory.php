<?php

use App\Models\Users\User;
use App\Models\Profiles\Profile;

/*
|--------------------------------------------------------------------------
| Factory for profiles
|--------------------------------------------------------------------------
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Profile::class, function (Faker\Generator $faker) {
    return [
        'profile_address'           => $faker->address,
        'profile_birthdate'         => $faker->dateTimeBetween($startDate = '-50 years', $endDate = '-18 years')->format('d/m/Y'),
        'profile_city'              => $faker->city,
        'profile_country'           => $faker->country,
        'profile_region'            => $faker->state,
        'profile_state'             =>  $faker->state,
        'profile_telephone'         =>  $faker->randomNumber(9),
        'profile_url'               =>  $faker->url,
        'profile_zip'               =>  $faker->randomNumber(5),
    ];
});
