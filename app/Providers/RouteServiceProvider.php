<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::pattern('biocide', '[0-9]+');
        Route::pattern('city', '[0-9]+');
        Route::pattern('client', '[0-9]+');
        Route::pattern('crop', '[0-9]+');
        Route::pattern('crop_variety', '[0-9]+');
        Route::pattern('delete', '[0-9]+');
        Route::pattern('id', '[0-9]+');
        Route::pattern('irrigation', '[0-9]+');
        Route::pattern('module', '[0-9]+');
        Route::pattern('option', '[0-9]+');
        Route::pattern('pattern', '[0-9]+');
        Route::pattern('pest', '[0-9]+');
        Route::pattern('plot', '[0-9]+');
        Route::pattern('profile', '[0-9]+');
        Route::pattern('role', '[0-9]+');
        Route::pattern('training', '[0-9]+');
        Route::pattern('user', '[0-9]+');
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapAuthRoutes();
        $this->mapWebRoutes();
        $this->mapDownloadRoutes();
        $this->mapImageRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "Auth" routes for the application.
     *
     * @return void
     */
    protected function mapAuthRoutes()
    {
        Route::middleware(['web', 'auth', 'noFrames', 'https', 'locale'])
             ->namespace($this->namespace)
             ->group(base_path('routes/auth.php'));
    }

    /**
     * Define the "Auth" routes for the application.
     *
     * @return void
     */
    protected function mapDownloadRoutes()
    {
        Route::middleware(['web', 'auth', 'noFrames', 'https', 'locale'])
             ->namespace($this->namespace)
             ->group(base_path('routes/download.php'));
    }

    /**
     * Define the "Auth" routes for the application.
     *
     * @return void
     */
    protected function mapImageRoutes()
    {
        Route::middleware(['web', 'auth', 'noFrames', 'https'])
             ->namespace($this->namespace)
             ->group(base_path('routes/image.php'));
    }
}
