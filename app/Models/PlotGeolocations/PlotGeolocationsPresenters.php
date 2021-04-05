<?php

namespace App\Models\PlotGeolocations;

trait PlotGeolocationsPresenters {

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */

    public function getSigpacAttribute($value)
    {
        return [
            'region' => $this->attributes['geo_sigpac_region'],
            'city' => $this->attributes['geo_sigpac_city'],
            'aggregate' => $this->attributes['geo_sigpac_aggregate'],
            'zone' => $this->attributes['geo_sigpac_zone'],
            'polygon' => $this->attributes['geo_sigpac_polygon'],
            'plot' => $this->attributes['geo_sigpac_plot'],
            'precinct' => $this->attributes['geo_sigpac_precinct'],
        ];
    }

    public function getZoneAttribute($value)
    {
        //Last 2 digits from the SRS
        return substr($this->attributes['geo_srs'], -2);
    }

    public function setZoneAttribute($value)
    {
        //Set SRS
        if($value >= 27 && $value <= 31) {
            $this->attributes['geo_srs'] = 'EPSG:326' . $value;
        }
    }
}
