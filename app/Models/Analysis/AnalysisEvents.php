<?php

namespace App\Models\Analysis;

//use Cache;

trait AnalysisEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        // static::saved(function ($model) {
        //     //get_class($model) will output App\Models\Analysis\Analysi
        //     Cache::forget('select-filter-' . md5(get_class($model)));
        // });
    }
}
