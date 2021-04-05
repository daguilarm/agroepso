<?php

namespace App\Models\Patterns;

//use Cache;

trait PatternsEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        // static::saved(function ($model) {
        //     //get_class($model) will output App\Models\Patterns\Pattern
        //     Cache::forget('select-filter-' . md5(get_class($model)));
        // });
    }
}
