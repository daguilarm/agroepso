<?php

namespace App\Models\Plots;

trait PlotsScopes {

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeDownload($query)
    {
        return $query
            ->join('plot_geolocations', 'plots.id', '=', 'plot_geolocations.plot_id')
            ->select(
                'plots.plot_ref AS Referencia',
                'plots.user_id AS Usuario',
                'plots.plant_id AS Planta',
                'plots.warehouse_id AS Almacén',
                'plots.country_id AS País',
                'plots.state_id AS Comunidad',
                'plots.region_id AS Provincia',
                'plots.plot_name AS Nombre Parcela',
                'plots.plot_framework_x AS Marco x',
                'plots.plot_framework_y AS Marco y',
                'plots.plot_area AS Area',
                'plots.plot_percent_cultivated_land AS % Cultivado',
                'plots.plot_crop_quantity AS Total',
                'plots.plot_green_cover AS Cubierta',
                'plots.plot_pond AS Balsa',
                'plots.plot_road AS Carretera',
                'plots.plot_start_date AS Fecha',
                'plot_geolocations.geo_sigpac_region AS Region',
                'plot_geolocations.geo_sigpac_city AS Ciudad',
                'plot_geolocations.geo_sigpac_aggregate AS Agregado',
                'plot_geolocations.geo_sigpac_zone AS Zona',
                'plot_geolocations.geo_sigpac_polygon AS Polígono',
                'plot_geolocations.geo_sigpac_plot AS Parcela',
                'plot_geolocations.geo_sigpac_precinct AS Recinto',
                'plot_geolocations.geo_lat AS Latitud',
                'plot_geolocations.geo_lng AS Longitud',
                'plot_geolocations.geo_catastro AS Catastro',
                'plot_geolocations.geo_height AS Altitud'
            )
            ->filterByRole('plots')
            ->get();
    }

    /**
     * Get all the users order by name
     *
     * @return  array
     */
    public function scopeByRoleToSelect($query)
    {
        return ['' => ''] + $query
            ->filterByRole('plots')
            ->byName()
            ->pluck('plot_name', 'id')
            ->toArray();

    }

    /**
     * Get all the users order by name
     *
     * @return  array
     */
    public function scopeByName($query)
    {
        return $query->orderBy('plot_name', 'asc');
    }

    /**
    * Get user by request client
    *
    * @var array
    */
    public function scopeSelectFilterByRequestClient($query, $value)
    {
        return $query->when($value, function($query) use ($value) {
            return $query->where('client_id', $value);
        })
        ->pluck('plot_name', 'id')
        ->toArray();
    }
}
