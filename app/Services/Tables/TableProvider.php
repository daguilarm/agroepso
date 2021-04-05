<?php

namespace App\Services\Tables;

use Illuminate\Support\ServiceProvider;

class TableProvider extends ServiceProvider
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
        $this->app->bind('TableProvider', function()
        {
            return new \App\Services\Tables\TableClass;
        });
    }
}
