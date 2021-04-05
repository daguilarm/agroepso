<?php

/*
|--------------------------------------------------------------------------
| Tools Routes
|--------------------------------------------------------------------------
*/
/** Dashboard Routes */
Route::group(['as' => 'tools.', 'middleware' => ['isGod:admin']], function () {

    Route::group(['middleware' => 'role:admin'], function () {
        /**
         * Biocides
         */
        Route::resource('dashboard/tools/biocides', 'Dashboard\Admin\BiocidesController', ['except' => ['show', 'destroy']]);
        Route::get('dashboard/tools/biocides/excel', 'Dashboard\Admin\BiocidesExcelsController')->name('biocides.excel');

        /**
         * Cities
         */
        Route::resource('dashboard/tools/cities', 'Dashboard\Admin\CitiesController', ['except' => ['show', 'destroy']]);

        /**
         * Crops
         */
        Route::resource('dashboard/tools/crops', 'Dashboard\Admin\CropsController', ['except' => ['show', 'destroy']]);

        /**
         * Crops varieties
         */
        Route::resource('dashboard/tools/crop_varieties', 'Dashboard\Admin\CropVarietiesController', ['except' => ['index', 'destroy']]);

        /**
         * Modules
         */
        Route::resource('dashboard/tools/modules', 'Dashboard\Admin\ModulesController', ['except' => ['show', 'destroy']]);

        /**
         * Options
         */
        Route::resource('dashboard/tools/options', 'Dashboard\Admin\OptionsController', ['except' => ['show', 'destroy']]);

        /**
         * Patterns
         */
        Route::resource('dashboard/tools/patterns', 'Dashboard\Admin\PatternsController', ['except' => ['index', 'destroy']]);

        /**
         * Pests
         */
        Route::resource('dashboard/tools/pests', 'Dashboard\Admin\PestsController', ['except' => ['index', 'destroy']]);

        /**
         * Roles
         */
        Route::resource('dashboard/tools/roles', 'Dashboard\Admin\RolesController', ['except' => ['show', 'destroy']]);
    });

     /*
     | Database seed
     */
    Route::get('dashboard/tools/seed', 'Dashboard\Admin\SeedController@index')->name('seed');
    Route::post('dashboard/tools/seed', 'Dashboard\Admin\SeedController@create')->name('seed.create');

    /**
     * Role update tool
     */
    Route::get('dashboard/tools/roles/{change}', 'Dashboard\Admin\RolesController@change')->name('roles.change');

    /**
     * Clients
     */
    Route::get('dashboard/tools/clients/{client}', 'Dashboard\Admin\ClientsController');
});
