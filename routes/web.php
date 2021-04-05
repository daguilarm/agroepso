<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Website urls
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    Auth::logout();
    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Logout in local env
|--------------------------------------------------------------------------
*/
if(env('APP_ENV') === 'local') {
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('dashboard.logout');
}
