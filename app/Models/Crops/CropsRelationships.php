<?php

namespace App\Models\Crops;

use App\Models\Clients\Client;
use App\Models\CropVarieties\CropVariety;

trait CropsRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function client()
    {
        return $this->belongsToMany(Client::class);
    }

    public function variety()
    {
        return $this->hasMany(CropVariety::class);
    }

    // public function pattern()
    // {
    //     return $this->hasMany(Pattern::class);
    // }

    // public function pest()
    // {
    //     return $this->hasMany(Pest::class);
    // }

    // public function plot()
    // {
    //     return $this->hasOne(Plot::class);
    // }
}
