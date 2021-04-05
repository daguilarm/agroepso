<?php

namespace App\Models\Inspections;

//use Cache;

trait InspectionsEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        // static::saved(function ($model) {
        //     //get_class($model) will output App\Models\Inspections\Inspection
        //     Cache::forget(cacheKey($model));
        // });
    }
}
