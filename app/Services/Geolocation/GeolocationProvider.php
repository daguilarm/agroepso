<?php

namespace App\Services\Geolocation;

use Illuminate\Support\ServiceProvider;

class GeolocationProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GeolocationProvider', function()
        {
            return new \App\Services\Geolocation\GeolocationClass;
        });
    }
}
