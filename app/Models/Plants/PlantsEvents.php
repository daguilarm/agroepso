<?php

namespace App\Models\Plants;

//use Cache;

trait PlantsEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            //Updated the client autoincrement
            $model->client->increment('plant_total');
        });
    }
}
