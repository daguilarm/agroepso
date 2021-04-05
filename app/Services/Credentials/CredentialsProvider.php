<?php

namespace App\Services\Credentials;

use Illuminate\Support\ServiceProvider;

class CredentialsProvider extends ServiceProvider
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
        $this->app->bind('CredentialsProvider', function()
        {
            return new \App\Services\Credentials\CredentialsClass;
        });
    }
}
