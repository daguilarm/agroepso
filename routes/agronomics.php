<?php

/*
|--------------------------------------------------------------------------
| Download Routes
|--------------------------------------------------------------------------
*/

/**
 * Harvests
 */
Route::resource('dashboard/agronomics/harvests', 'Dashboard\Agronomic\HarvestsController');
Route::get('dashboard/agronomics/harvests/delete/{delete}', 'Dashboard\Agronomic\HarvestsController@index')->name('harvests.delete')->middleware('permission:delete harvest');
Route::get('dashboard/agronomics/harvests/restore/{restore}', 'Dashboard\Agronomic\HarvestsController@restore')->name('harvests.restore');
