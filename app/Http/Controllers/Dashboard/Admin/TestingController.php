<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\Request;
use App\Jobs\CreateCitiesFromExcel;
use App\Models\Cities\City;
use DB, Credentials, Excel;

class TestingController extends DashboardController {

    // public function __invoke()
    // {
    //     dispatch(new CreateCitiesFromExcel);
    // }

    public function __invoke()
    {
        $cities = app(City::class)->skip(6000)->take(3000)->get();
        return view('dashboard.home.testing.seed', compact('cities'))->with('section', null);
    }
}
