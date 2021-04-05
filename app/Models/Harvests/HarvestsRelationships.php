<?php

namespace App\Models\Harvests;

use App\Models\Clients\Client;
use App\Models\Plots\Plot;
use App\Models\Users\User;

trait HarvestsRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
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
