<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\CitiesRequest;
use App\Models\Cities\City;
use App\Models\Countries\Country;
use App\Models\Regions\Region;
use App\Models\States\State;
use App\Tables\CityTable;
use Credentials, Gate;

class CitiesController extends DashboardController
{
    /**
     * @var protected
     */
    protected $controller;
    protected $delete;
    protected $path;
    protected $route;

    /**
     * @var protected
     * @return string
     */
    protected $section = 'cities';
    protected $msgTableField = 'city_name';

    public function __construct(City $controller)
    {
        $this->controller = $controller;
        $this->path = 'z_admin.';
        $this->route = 'dashboard.tools.' . $this->section;

        //Sharing in the view
        $this->passVariablesToView();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Get the table values
        $table = $this->getTable(CityTable::class);

        return view(dashboard_path($this->path . $this->section . '.index'), compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Country $country, State $state)
    {
        //Get all the dates
        $countries = $country->selects(['id', 'country_name']);
        $states = $state->selects(['id', 'state_name']);

        return view(dashboard_path($this->path . $this->section . '.create'), compact('countries', 'states'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, Country $country, Region $region, State $state)
    {
        //Get all the dates
        $data = $this->controller->findOrFail($id);
        $countries = $country->selects(['id', 'country_name']);
        $states = $state->selects(['id', 'state_name']);
        $regions = $region->selectsByState($data->state_id);

        return view(dashboard_path($this->path . $this->section . '.edit'), compact('countries', 'data', 'regions', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CountriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CitiesRequest $request, int $id)
    {
        $this->controller->findOrFail($id)->update($request->all());

        return redirect()
            ->route($this->route . '.index')
            ->withUpdated(trans_title($this->section) . ': ' . request($this->msgTableField));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CountriesRequest
     * @return \Illuminate\Http\Response
     */
    public function store(CitiesRequest $request)
    {
        $create = $this->controller->create(request()->all());

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title($this->section) . ': ' . request($this->msgTableField));
    }
}
