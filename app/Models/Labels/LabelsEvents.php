<?php

namespace App\Models\Labels;

//use Cache;

trait LabelsEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        // static::saved(function ($model) {
        //     //get_class($model) will output App\Models\Labels\Label
        //     Cache::forget(cacheKey($model));
        // });
    }
}
