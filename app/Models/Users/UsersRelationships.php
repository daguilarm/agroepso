<?php

namespace App\Models\Users;

use App\Models\Clients\Client;
use App\Models\Plots\Plot;
use App\Models\Profiles\Profile;

trait UsersRelationships {
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

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
