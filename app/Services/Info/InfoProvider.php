<?php

namespace App\Services\Info;

use Illuminate\Support\ServiceProvider;

class InfoProvider extends ServiceProvider
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
        $this->app->bind('InfoProvider', function()
        {
            return new \App\Services\Info\InfoClass;
        });
    }
}
