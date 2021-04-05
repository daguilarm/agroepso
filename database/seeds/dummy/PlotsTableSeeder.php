<?php

use App\Models\Cities\City;
use App\Models\Clients\Client;
use App\Models\CropVarieties\CropVariety;
use App\Models\Inspections\Inspection;
use App\Models\Patterns\Pattern;
use App\Models\Plants\Plant;
use App\Models\PlotGeolocations\PlotGeolocation;
use App\Models\Plots\Plot;
use App\Models\Users\User;
use App\Models\Warehouses\Warehouse;
use Illuminate\Database\Seeder;

class PlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plots')->delete();

        foreach(Client::all() as $client) {
            //Only add a plot if the client has a valid crop assign
            if($client->crop_id) {
                for($x = 1; $x <= rand(5, 50); $x++) {
                    //Data
                    $user = User::whereClientId($client->id)->random();
                    $city = City::whereRegionId(array_random([3, 12, 46]))->random();
                    $framework_x = rand(1, 5);
                    $framework_y = rand(2, 6);
                    //Variables
                    $area = rand(1000, 100000);
                    $percent = rand(1, 100);
                    $realArea = calc_percent($area, $percent);
                    //Get variety
                    $variety = CropVariety::whereCropId($client->crop_id)->random();
                    //Plant and warehouse
                    $plant = Plant::whereClientId($client->id)->random();
                    $warehouse = Warehouse::whereClientId($client->id)->wherePlantId($plant->id)->random();

                    //Plot
                    $plot = factory(Plot::class)->create([
                        'plot_ref'                      => format_ref($x),
                        'user_id'                       => $user->id,
                        'plant_id'                      => $plant->id,
                        'warehouse_id'                  => $warehouse->id,
                        'client_id'                     => $user->client_id,
                        'city_id'                       => $city->id,
                        'country_id'                    => $city->country_id,
                        'region_id'                     => $city->region_id,
                        'state_id'                      => $city->state_id,
                        'plot_framework_x'              => $framework_x,
                        'plot_framework_y'              => $framework_y,
                        'plot_area'                     => $area,
                        'plot_real_area'                => $realArea,
                        'plot_percent_cultivated_land'  => $percent,
                        'plot_crop_quantity'            => calc_framework($area, $framework_x, $framework_y),
                        'plot_crop_training'            => array_random(array_keys(trans('_config.training_types'))),
                        'crop_id'                       => $client->crop_id,
                        'crop_variety_id'               => optional($variety)->id,
                        'crop_variety_type'             => optional($variety)->crop_variety_type,
                        'pattern_id'                    => optional(Pattern::whereCropId($client->crop_id)->random())->id,
                    ]);

                    //PlotGeolocation
                    $PlotCrop = factory(PlotGeolocation::class)->create([
                        'plot_id'               => $plot->id,
                        'geo_sigpac_region'     => $city->region_id,
                        'geo_sigpac_city'       => $city->id,
                        'geo_lat'               => $city->city_lat,
                        'geo_lng'               => $city->city_lng,
                    ]);

                    //PlotInspections
                    for($inspection = 0; $inspection <= rand(3, 20); $inspection++) {
                        if(!empty($client->crop_id)) {
                            $PlotInspections = factory(Inspection::class)->create([
                                'plot_id'               => $plot->id,
                                'client_id'             => $user->client_id,
                                'city_id'               => $city->id,
                                'user_id'               => $user->id,
                                'crop_id'               => $client->crop_id,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
