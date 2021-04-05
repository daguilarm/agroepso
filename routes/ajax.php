<?php

/** Ajax Routes */
Route::group([
        'as' => 'ajax.',
    ], function () {
        // Client refrente total ajax response
        Route::get('dashboard/ajax/clients', 'Dashboard\Ajax\ClientsController')->name('clients');
        Route::get('dashboard/ajax/total', 'Dashboard\Ajax\ClientReferenceTotalController')->name('total');
        // Crops ajax response
        Route::get('dashboard/ajax/crops', 'Dashboard\Ajax\CropsController')->name('crops');
        // Plants ajax response
        Route::get('dashboard/ajax/plants', 'Dashboard\Ajax\PlantsController')->name('plants');
        // Regions ajax response
        Route::get('dashboard/ajax/regions', 'Dashboard\Ajax\RegionsController')->name('regions');
        // Seeds ajax response
        Route::get('dashboard/ajax/seeds', 'Dashboard\Ajax\SeedsController')->name('seeds')->middleware('role:admin');
        // Users ajax response
        Route::get('dashboard/ajax/users', 'Dashboard\Ajax\UsersController')->name('users');
        // Warehouses ajax response
        Route::get('dashboard/ajax/warehouses', 'Dashboard\Ajax\WarehousesController')->name('warehouses');

        //Load files
        Route::get('dashboard/inspections/ajax/document/{folder}/{file}', function($folder, $file) {
            return view('dashboard.inspections.custom.' . $folder . '.' . $file);
        });
});
