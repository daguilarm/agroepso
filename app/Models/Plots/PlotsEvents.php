<?php

namespace App\Models\Plots;

//use Cache;

trait PlotsEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            //Get the client model
            $client = $model->client;

            //Increment the number of plots
            $client->increment('plot_total');
        });
    }
}
