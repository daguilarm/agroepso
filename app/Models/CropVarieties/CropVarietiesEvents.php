<?php

namespace App\Models\CropVarieties;

//use Cache;

trait CropVarietiesEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        // static::saved(function ($model) {
        //     //get_class($model) will output App\Models\CropVarieties\Cropvariety
        //     Cache::forget('select-filter-' . md5(get_class($model)));
        // });
    }
}
