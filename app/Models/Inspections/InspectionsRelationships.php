<?php

namespace App\Models\Inspections;

use App\Models\Cities\City;
use App\Models\Clients\Client;
use App\Models\Plots\Plot;
use App\Models\Users\User;

trait InspectionsRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
   public function city()
   {
       return $this->belongsTo(City::class);
   }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
