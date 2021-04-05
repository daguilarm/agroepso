<?php

namespace App\Models\Certificates;

//use Cache;

trait CertificatesEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        // static::saved(function ($model) {
        //     //get_class($model) will output App\Models\Certificates\Certificate
        //     Cache::forget(cacheKey($model));
        // });
    }
}
