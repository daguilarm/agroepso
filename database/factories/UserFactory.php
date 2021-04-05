<?php

use App\Models\Clients\Client;
use App\Models\Users\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->defineAs(User::class, 'user_admin', function (Faker $faker) {

    $client = 1;
    $total = getReferenceFromClient('user', $client);

    return [
        'user_ref'          => format_ref($total),
        'client_id'         => $client,
        'name'              => 'Administrador',
        'deputy_name'       => $faker->name,
        'nif'               => $faker->randomNumber(9),
        'email'             => $faker->safeEmail,
        'password'          => str_random(20),
        'agreement'         => $faker->ipv4,
    ];
});

$factory->define(User::class, function (Faker $faker) {

    $client = Client::randomId();
    $total = getReferenceFromClient('user', $client);

    return [
        'user_ref'          => format_ref($total),
        'client_id'         => $client,
        'name'              => $faker->name,
        'deputy_name'       => $faker->name,
        'nif'               => $faker->randomNumber(9),
        'email'             => $faker->unique()->safeEmail,
        'active'            => array_random(['yes', 'not']),
        'password'          => str_random(20),
        'agreement'         => $faker->ipv4,
    ];
});
