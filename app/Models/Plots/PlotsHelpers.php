<?php

namespace App\Models\Plots;

use App\Models\Cities\City;
use DB, Geolocation;

trait PlotsHelpers {

    /**
     * Create the item.
     * @return void
     */
    public function toStore()
    {
        //Store with a transaction
        return DB::transaction(function () {

            //Set geolocation
            $geolocation = self::setGeolocation();
            $location = self::setPlotLocalization();

            //Create plot
            $plot = Plot::create([
                //Plot parametters
                'plot_ref' => request('plot_ref') ?? null,
                'client_id' => request('client_id') ?? null,
                'user_id' => request('user_id') ?? null,
                'plant_id' => request('plant_id') ?? null,
                'warehouse_id' => request('warehouse_id') ?? null,
                'city_id' => $location['city'] ?? null,
                'region_id' => $location['region'] ?? null,
                'state_id' => $location['state'] ?? null,
                'plot_name' => request('plot_name') ?? 'Parcela Nº ' . request('plot_ref'),
                'plot_start_date' => request('plot_start_date') ?? null,
                'plot_framework_x' => request('plot_framework_x') ?? null,
                'plot_framework_y' => request('plot_framework_y') ?? null,
                'plot_area' => request('plot_area') ?? $geolocation['plot_area'],
                'plot_real_area' => $geolocation['plot_real_area'] ?? null,
                'plot_percent_cultivated_land' => request('plot_percent_cultivated_land') ?? null,
                'plot_green_cover' => request('plot_green_cover') ?? null,
                'plot_pond' => request('plot_pond') ?? null,
                'plot_road' => request('plot_road') ?? null,
                //Crops parametters
                'crop_id' => request('crop_id') ?? null,
                'crop_variety_id' => request('crop_variety_id') ?? null,
                'crop_variety_type' => request('crop_variety_type') ?? null,
                'plot_crop_quantity' => self::setQuantity($geolocation['plot_real_area']),
                'plot_crop_training' => request('plot_crop_training') ?? null,
            ]);

            //Create geolocation
            $plot->geolocation()->create([
                'geo_sigpac_region' => request('geolocation_geo_sigpac_region'),
                'geo_sigpac_city' => request('geolocation_geo_sigpac_city'),
                'geo_sigpac_polygon' => request('geolocation_geo_sigpac_polygon'),
                'geo_sigpac_plot' => request('geolocation_geo_sigpac_plot'),
                'geo_sigpac_aggregate' => $geolocation['sigpac_aggregate'],
                'geo_sigpac_zone' => $geolocation['sigpac_zone'],
                'geo_sigpac_precinct' => $geolocation['geolocation_geo_sigpac_precinct'] ?? null,
                'geo_height' => $geolocation['geo_height'],
                'geo_catastro' => $geolocation['geo_catastro'],
                'geo_catastro_url' => $geolocation['geo_catastro_url'],
                'geo_lat' => $geolocation['geo_lat'],
                'geo_lng' => $geolocation['geo_lng'],
                'geo_x' => $geolocation['geo_x'],
                'geo_y' => $geolocation['geo_y'],
                'geo_srs' => $geolocation['geo_srs'],
            ]);

            return $plot ?? false;
        });
    }

    /**
     * Store into database
     *
     * @param array $data
     * @return void
     */
    public function toUpdate($id) {

        //Store with a transaction
        return DB::transaction(function () use ($id) {

            //Update plot
            $plot = Plot::find($id);
            $plot->update(request()->all());

            //Update geolocation
            $plot->geolocation()->update([
                'geo_sigpac_region' => request('geolocation_geo_sigpac_region'),
                'geo_sigpac_city' => request('geolocation_geo_sigpac_city'),
                'geo_sigpac_polygon' => request('geolocation_geo_sigpac_polygon'),
                'geo_sigpac_plot' => request('geolocation_geo_sigpac_plot'),
                'geo_sigpac_precinct' => request('geolocation_geo_sigpac_precinct'),
                'geo_sigpac_aggregate' => request('geolocation_geo_sigpac_aggregate'),
                'geo_sigpac_zone' => request('geolocation_geo_sigpac_zone'),
                'geo_catastro' => request('geolocation_geo_catastro'),
                'geo_lat' => request('geolocation_geo_lat'),
                'geo_lng' => request('geolocation_geo_lng'),
                'geo_x' => request('geolocation_geo_x'),
                'geo_y' => request('geolocation_geo_y'),
                'geo_srs' => (request('geolocation_zone') >= 27 && request('geolocation_zone') <= 31) ? 'EPSG:326' . request('geolocation_zone') : null,
            ]);

            return $plot ?? false;
        });
    }

    /**
     * Get all the plots (in form select array) if the user has not the admin role
     *
     * @return  array
     */
    public function bySearch()
    {
        return $this->byName()
            ->filterByRole('plots')
            ->selectFilterByRequestClient(request('f_client_id'));
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */
    protected function setGeolocation()
    {
        //Get sigpac values from wms
        $sigpac = implode(',', [
            request('geolocation_geo_sigpac_region'),
            request('geolocation_geo_sigpac_city'),
            request('geolocation_geo_sigpac_aggregate') ?? 0,
            request('geolocation_geo_sigpac_zone') ?? 0,
            request('geolocation_geo_sigpac_polygon'),
            request('geolocation_geo_sigpac_plot')
        ]);

        $geolocation = Geolocation::server('sigpac')->params($sigpac)->get();

        //Set values
        $geo_catastro = $geolocation[0] ?? null;
        $geo_catastro_url = url_catastro($geo_catastro, request('geolocation_geo_sigpac_region'), request('geolocation_geo_sigpac_city'));
        $plot_area = $geolocation[1] ? calc_number($geolocation[1]) : null;
        $plot_real_area = (request('plot_real_area') > 0)
            ? request('plot_real_area')
            : (($plot_area * request('plot_percent_cultivated_land')) / 100);

        //Calculate latLng from catastro
        $coordenates = Geolocation::server('catastro')->params($geo_catastro)->get();

        //Get lat and lng
        $geo_lat = optional($coordenates[2])->__toString() ?? null;
        $geo_lng = optional($coordenates[3])->__toString() ?? null;

        //Convert coordenates
        $coordenatesConverter = Geolocation::gpsToUtm($geo_lat, $geo_lng);

        $geo_x = $coordenatesConverter[0] ?? null;
        $geo_y = $coordenatesConverter[1] ?? null;
        $geo_srs = $coordenatesConverter[2] ?? null;

        //Height
        $geo_height = ($geo_lat && $geo_lng)
            ? Geolocation::server('geonames')->params([$geo_lat, $geo_lng])->get()
            : null;

        return [
            'sigpac_region' => request('geolocation_geo_sigpac_region'),
            'sigpac_city' => request('geolocation_geo_sigpac_city'),
            'sigpac_aggregate' => request('geolocation_geo_sigpac_aggregate') ?? 0,
            'sigpac_zone' => request('geolocation_geo_sigpac_zone') ?? 0,
            'sigpac_polygon' => request('geolocation_geo_sigpac_polygon'),
            'sigpac_plot' => request('geolocation_geo_sigpac_plot'),
            'geo_catastro' => $geo_catastro,
            'geo_catastro_url' => $geo_catastro_url,
            'geo_height' => $geo_height,
            'plot_area' => $plot_area,
            'plot_real_area' => $plot_real_area,
            'geo_lat' => $geo_lat,
            'geo_lng' => $geo_lng,
            'geo_x' => $geo_x,
            'geo_y' => $geo_y,
            'geo_srs' => $geo_srs,
        ];
    }

    /**
     * Calculate the city, state, region,...
     *
     * @param integer $cityID
     * @return string
     */
    protected function setPlotLocalization()
    {
        //Calculate City from INE
        $city = City::query()
            ->where('sigpac', (integer) request('geolocation_geo_sigpac_city'))
            ->where('region_id', (integer) request('geolocation_geo_sigpac_region'))
            ->first();

        return [
            'state' => optional($city)->state_id,
            'region' => optional($city)->region_id,
            'city' => optional($city)->id,
        ];

    }

    /**
     * Calculate the total trees or crops
     *
     * @return string
     */
    protected function setQuantity($area)
    {
        if(!request('plot_crop_quantity') && ($area && request('plot_framework_x') && request('plot_framework_y'))) {
            return calc_framework($area * 10000, request('plot_framework_x'), request('plot_framework_y'));
        }

        return request('plot_crop_quantity');
    }
}
