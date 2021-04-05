<?php

namespace App\Models\InspectionRoutes;

//use Cache;

trait InspectionRoutesEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        // static::saved(function ($model) {
        //     //get_class($model) will output App\Models\InspectionRoutes\Inspectionroute
        //     Cache::forget(cacheKey($model));
        // });
    }
}
