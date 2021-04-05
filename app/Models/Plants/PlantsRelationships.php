<?php

namespace App\Models\Plants;

use App\Models\Cities\City;
use App\Models\Clients\Client;
use App\Models\Regions\Region;

trait PlantsRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
