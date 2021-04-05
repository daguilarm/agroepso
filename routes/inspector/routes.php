<?php

/*
|--------------------------------------------------------------------------
| Inspector Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "inspector" middleware group. Now create something great!
|
*/

/** Inspection Routes */
Route::group(['as' => ''], function () {

    /**
     * Inspections
     */
    Route::resource('dashboard/certificates', 'Dashboard\CertificatesController', ['except' => ['show', 'destroy']]);

    /**
     * Inspections
     */
    Route::resource('dashboard/inspections', 'Dashboard\InspectionsController', ['except' => ['show', 'destroy']]);
    Route::resource('dashboard/inspection_routes', 'Dashboard\InspectionRoutesController', ['except' => ['show', 'destroy', 'create']]);
    Route::get('dashboard/inspection_routes/delete/{delete}', 'Dashboard\InspectionRoutesController@index')->name('inspection_routes.delete')->middleware('permission:delete inspection');
    Route::get('dashboard/inspection_routes/restore/{restore}', 'Dashboard\InspectionRoutesController@restore')->name('inspection_routes.restore');
    Route::post('dashboard/inspection_routes/create', 'Dashboard\InspectionRoutesController@create')->name('inspection_routes.create');
});
