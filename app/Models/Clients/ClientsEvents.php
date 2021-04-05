<?php

namespace App\Models\Clients;

use Cache;

trait ClientsEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            //Delete the client cache
            Cache::forget('clients-configuration-module-' . md5($model->id));
            Cache::forget('clients-configuration-option-' . md5($model->id));
        });
    }
}
