<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Auth" middleware group. Now create something great!
|
*/

/*
| Default dashboard
*/
Route::get('/dashboard', 'Dashboard\HomeController@index')->name('dashboard');

/*
| Error 404
*/
// Route::get('/404', function() {
//     return view('errors.404');
// })->name('dashboard.error.404');

/** Dashboard Routes */
Route::group(['as' => 'dashboard.'], function () {

    /**
     * Admin Tools
     * If running tests... fixing the route problem...
     * App::environment('local') for DUSK
     * App::runningUnitTests() for phpUnit
     */
    if(App::environment('local') || App::runningUnitTests()) {
        require(base_path() . '/routes/admin/tools.php');
        require(base_path() . '/routes/ajax.php');
        require(base_path() . '/routes/inspector/routes.php');
        require(base_path() . '/routes/agronomics.php');
    } else {
        //Regular routing...
        require_once(base_path() . '/routes/admin/tools.php');
        require_once(base_path() . '/routes/ajax.php');
        require_once(base_path() . '/routes/inspector/routes.php');
        require_once(base_path() . '/routes/agronomics.php');
    }

    /**
     * Clients
     */
    Route::resource('dashboard/clients', 'Dashboard\ClientsController', ['except' => ['show']]);
    Route::get('dashboard/clients/delete/{delete}', 'Dashboard\ClientsController@index')->name('clients.delete')->middleware('permission:delete client');
    Route::get('dashboard/clients/restore/{restore}', 'Dashboard\ClientsController@restore')->name('clients.restore');

    /**
     * Labels
     */
    Route::resource('dashboard/labels', 'Dashboard\LabelsController', ['except' => ['show']]);
    Route::get('dashboard/labels/delete/{delete}', 'Dashboard\LabelsController@index')->name('labels.delete')->middleware('permission:delete client');

    /**
     * Plants
     */
    Route::resource('dashboard/plants', 'Dashboard\PlantsController');
    Route::get('dashboard/plants/delete/{delete}', 'Dashboard\PlantsController@index')->name('plants.delete')->middleware('permission:delete plant');
    Route::get('dashboard/plants/restore/{restore}', 'Dashboard\PlantsController@restore')->name('plants.restore');

    /**
     * Plots
     */
    Route::get('dashboard/plots/download', 'Dashboard\PlotsDownloadsController')->name('plots.download');
    Route::get('dashboard/plots/excel', 'Dashboard\PlotsExcelsController@index')->name('plots.excel');
    Route::post('dashboard/plots/excel', 'Dashboard\PlotsExcelsController@store')->name('plots.excel.store');
    Route::get('dashboard/plots/geolocate', 'Dashboard\PlotsGeolocateController@index')->name('plots.geolocate');
    Route::post('dashboard/plots/geolocate', 'Dashboard\PlotsGeolocateController@geolocate')->name('plots.geolocate');
    Route::post('dashboard/plots/geolocate/store', 'Dashboard\PlotsGeolocateController@store')->name('plots.geolocate.store');
    Route::resource('dashboard/plots', 'Dashboard\PlotsController');
    Route::get('dashboard/plots/delete/{delete}', 'Dashboard\PlotsController@index')->name('plots.delete')->middleware('permission:delete plot');
    Route::get('dashboard/plots/restore/{restore}', 'Dashboard\PlotsController@restore')->name('plots.restore');
    Route::post('dashboard/plots/reset', 'Dashboard\PlotsResetsController')->name('plots.reset');


    /**
     * Profiles
     */
    Route::resource('dashboard/profiles', 'Dashboard\ProfilesController', ['only' => ['edit', 'update']]);

    /**
     * Users
     */
    Route::get('dashboard/users/excel', 'Dashboard\UsersExcelsController@index')->name('users.excel');
    Route::post('dashboard/users/excel', 'Dashboard\UsersExcelsController@store')->name('users.excel.store');
    Route::get('dashboard/users/download', 'Dashboard\UsersDownloadsController')->name('users.download');
    Route::resource('dashboard/users', 'Dashboard\UsersController', ['except' => ['show']]);
    Route::get('dashboard/users/delete/{delete}', 'Dashboard\UsersController@index')->name('users.delete')->middleware('permission:delete user');
    Route::get('dashboard/users/restore/{restore}', 'Dashboard\UsersController@restore')->name('users.restore');

    /**
     * Warehouses
     */
    Route::resource('dashboard/warehouses', 'Dashboard\WarehousesController');
    Route::get('dashboard/warehouses/delete/{delete}', 'Dashboard\WarehousesController@index')->name('warehouses.delete')->middleware('permission:delete warehouse');
    Route::get('dashboard/warehouses/restore/{restore}', 'Dashboard\WarehousesController@restore')->name('warehouses.restore');
});
