<?php

namespace App\Models\Warehouses;

//use Cache;

trait WarehousesEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        /**
         * Increment the value
         */
        static::created(function ($model) {
            //Updated the client autoincrement
            $model->client->increment('warehouse_total');
        });
    }
}
