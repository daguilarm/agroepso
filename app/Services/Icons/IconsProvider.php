<?php

namespace App\Services\Icons;

use Illuminate\Support\ServiceProvider;

class IconsProvider extends ServiceProvider
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
        $this->app->bind('IconsProvider', function()
        {
            return new \App\Services\Icons\IconsClass;
        });
    }
}
