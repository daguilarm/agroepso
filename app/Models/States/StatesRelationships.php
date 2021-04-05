<?php

namespace App\Models\States;

trait StatesRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->hasMany(Region::class);
    }

    public function city()
    {
        return $this->hasMany(City::class);
    }
}
