<?php

use App\Models\PlotGeolocations\PlotGeolocation;
use App\Models\Plots\Plot;

/*
|--------------------------------------------------------------------------
| Factory for Plot
|--------------------------------------------------------------------------
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Plot::class, function (Faker\Generator $faker) {
    return [
        'plot_ref'                      => 1,
        'user_id'                       => 1,
        'plant_id'                      => 1,
        'warehouse_id'                  => 1,
        'client_id'                     => 1,
        'city_id'                       => 1,
        'country_id'                    => 1,
        'region_id'                     => 1,
        'state_id'                      => 1,
        'plot_framework_x'              => 1,
        'plot_framework_y'              => 1,
        'plot_area'                     => 1,
        'plot_real_area'                => 1,
        'plot_percent_cultivated_land'  => 1,
        'plot_name'                     => $faker->company,
        'plot_start_date'               => $faker->year($max = 'now'),
        'plot_green_cover'              => array_random(['yes', 'not']),
        'plot_pond'                     => array_random(['yes', 'not']),
        'plot_road'                     => rand(1, 3),
        'plot_active'                   => array_random(['yes', 'not']),

        'crop_id'                   => null,
        'crop_variety_id'           => null,
        'crop_variety_type'         => null,
        'plot_crop_quantity'        => null,
        'plot_crop_training'        => null,
        'pattern_id'                => null,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(PlotGeolocation::class, function (Faker\Generator $faker) {

    $catastro = $faker->swiftBicNumber;
    $lat = $faker->latitude($min = 36.7, $max = 43.5);
    $lng = $faker->longitude($min = -5.9, $max = 2.15);
    $utm = Geolocation::gpsToUtm($lat, $lng);

    return [
        'plot_id'                       => null,
        'climatic_station_id'           => null,
        'climatic_station_distance'     => null,
        'geo_lat'                       => $lat,
        'geo_lng'                       => $lng,
        'geo_x'                         => (int) $utm[0],
        'geo_y'                         => (int) $utm[1],
        'geo_srs'                       => $utm[2],
        'geo_bbox'                      => null,
        'geo_sigpac_region'             => null,
        'geo_sigpac_city'               => null,
        'geo_sigpac_aggregate'          => 0,
        'geo_sigpac_zone'               => 0,
        'geo_sigpac_polygon'            => rand(1, 100),
        'geo_sigpac_plot'               => rand(1, 100),
        'geo_sigpac_precinct'           => rand(1, 100),
        'geo_catastro'                  => $catastro,
        'geo_catastro_url'              => 'https://www.catastro.com?id=' . $catastro,
        'geo_height'                    => rand(0, 100),
        'frame_width'                   => null,
        'frame_height'                  => null,
    ];
});
