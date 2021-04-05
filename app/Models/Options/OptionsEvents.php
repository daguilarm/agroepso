<?php

namespace App\Models\Options;

//use Cache;

trait OptionsEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        // static::saved(function ($model) {
        //     //get_class($model) will output App\Models\Options\Option
        //     Cache::forget('select-filter-' . md5(get_class($model)));
        // });
    }
}
