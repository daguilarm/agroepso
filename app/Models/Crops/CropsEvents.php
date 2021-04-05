<?php

namespace App\Models\Crops;

use Cache;

trait CropsEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            //get_class($model) will output App\Models\Crops\Crop
            Cache::forget(cacheKey($model));
        });
    }
}
