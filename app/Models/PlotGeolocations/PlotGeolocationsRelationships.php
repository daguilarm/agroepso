<?php

namespace App\Models\PlotGeolocations;

use App\Models\Plots\Plot;

trait PlotGeolocationsRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function plot()
    {
        return $this->hasOne(Plot::class);
    }
}
