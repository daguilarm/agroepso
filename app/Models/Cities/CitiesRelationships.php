<?php

namespace App\Models\Cities;

use App\Models\Countries\Country;
use App\Models\Regions\Region;
use App\Models\States\State;


trait CitiesRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function crop()
    {
        return $this->belongsToMany(Crop::class);
    }
}
