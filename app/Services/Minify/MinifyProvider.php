<?php

namespace App\Services\Minify;

use Illuminate\Support\ServiceProvider;

class MinifyProvider extends ServiceProvider
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
        $this->app->bind('MinifyProvider', function()
        {
            return new \App\Services\Minify\MinifyClass;
        });
    }
}
