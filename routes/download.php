<?php

/*
|--------------------------------------------------------------------------
| Download Routes
|--------------------------------------------------------------------------
*/

/** Dashboard Routes */
Route::group(['as' => 'dashboard.'], function () {

    /**
     * Download
     */
    Route::get('dashboard/download/excel/{file}', function($file) {
        return Excel::load(public_path('download/' . $file), function($excel){})->download('xls');
    })->name('download.excel');

});
