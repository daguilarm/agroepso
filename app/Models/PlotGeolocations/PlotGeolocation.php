<?php

namespace App\Models\PlotGeolocations;

use App\Models\BaseModel;
use App\Models\PlotGeolocations\PlotGeolocationsEvents;
use App\Models\PlotGeolocations\PlotGeolocationsHelpers;
use App\Models\PlotGeolocations\PlotGeolocationsPresenters;
use App\Models\PlotGeolocations\PlotGeolocationsRelationships;
use App\Models\PlotGeolocations\PlotGeolocationsScopes;

class PlotGeolocation extends BaseModel  {

    use PlotGeolocationsEvents, PlotGeolocationsPresenters, PlotGeolocationsRelationships, PlotGeolocationsScopes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plot_geolocations';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'geo_sigpac_region' => 'integer',
        'geo_sigpac_city' => 'integer',
        'geo_height' => 'integer',
        'geo_lat' => 'float',
        'geo_lng' => 'float',
        'geo_x' => 'float',
        'geo_y' => 'float',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'climatic_station_id',
        'climatic_station_distance',
        'geo_lat',
        'geo_lng',
        'geo_x',
        'geo_y',
        'geo_srs',
        'geo_bbox',
        'geo_sigpac_region',
        'geo_sigpac_city',
        'geo_sigpac_aggregate',
        'geo_sigpac_zone',
        'geo_sigpac_polygon',
        'geo_sigpac_plot',
        'geo_sigpac_precinct',
        'geo_sigpac_url',
        'geo_catastro',
        'geo_catastro_url',
        'geo_zip',
        'geo_height',
        'frame_width',
        'frame_height',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['plot_id'];
}
