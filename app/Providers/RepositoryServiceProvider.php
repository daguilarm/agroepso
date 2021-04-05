<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
     * Register the application repositories.
     *
     * @return void
     */
    public function register()
    {
        // /** Climatic API */
        // $this->app->bind('App\Repositories\Climatics\Api\ClimaticContract', 'App\Repositories\Climatics\Api\Servers\DarkSky');

        /** Services */
        $this->app->bind('App\Services\Icons\IconsInterface', 'App\Services\Icons\Fonts\Awesome\IconBuilder');
    }
}
