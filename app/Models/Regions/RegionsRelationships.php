<?php

namespace App\Models\Regions;

use App\Models\Cities\City;
use App\Models\Clients\Client;
use App\Models\Countries\Country;
use App\Models\States\State;

trait RegionsRelationships {

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

    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function client()
    {
        return $this->belongsToMany(Client::class);
    }
}
