<?php

namespace App\Models\Harvests;

//use Cache;

trait HarvestsEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        // static::saved(function ($model) {
        //     //get_class($model) will output App\Models\Harvests\Harvest
        //     Cache::forget(cacheKey($model));
        // });
    }
}
