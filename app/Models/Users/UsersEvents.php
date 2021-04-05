<?php

namespace App\Models\Users;

trait UsersEvents {

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        /**
         * Increment the value
         */
        static::created(function ($model) {
            //Updated the client autoincrement
            $model->client->increment('user_total');
        });
    }
}
