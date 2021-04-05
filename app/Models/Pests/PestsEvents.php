<?php

namespace App\Models\Pests;

//use Cache;

trait PestsEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        // static::saved(function ($model) {
        //     //get_class($model) will output App\Models\Pests\Pest
        //     Cache::forget('select-filter-' . md5(get_class($model)));
        // });
    }
}
