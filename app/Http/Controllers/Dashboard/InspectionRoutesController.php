<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\InspectionRoutesRequest;
use App\Models\InspectionRoutes\InspectionRoute;
use App\Models\PlotGeolocations\PlotGeolocation;
use App\Tables\InspectionRouteTable;
use Gate;

class InspectionRoutesController extends DashboardController
{
    /**
     * @var protected
     */
    protected $controller;
    protected $delete;
    protected $route;

    /**
     * @var protected
     * @return string
     */
    protected $section = 'inspection_routes';
    protected $msgTableField = 'id';

    public function __construct(InspectionRoute $controller)
    {
        $this->controller = $controller;
        $this->route = 'dashboard.' . $this->section;

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
        //Auth validation
        if(Gate::denies('view inspection', $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Get the table values
        $table = $this->getTable(InspectionRouteTable::class);

        return view(dashboard_path($this->section . '.index'), compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Auth validation
        if(Gate::denies('create inspection', $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Get plots coordenates
        $coordenates = PlotGeolocation::whereIn('plot_id', request('item'))->select('geo_lat', 'geo_lng')->get();

        return view(dashboard_path($this->section . '.create'), compact('coordenates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //Auth validation
        if(Gate::denies('edit inspection', $this->controller)) {
            return errorNotAllowedAccess();
        }

        $data = $this->controller->findOrFail($id);

        return view(dashboard_path($this->section . '.edit'), compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InspectionRoutesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InspectionRoutesRequest $request, int $id)
    {
        //Auth validation
        if(Gate::denies('edit inspection', $this->controller)) {
            return errorNotAllowedAccess();
        }

        if(!$this->controller->updateId($id, $request)) {
            return errorDataBase('update');
        }

        return redirect()
            ->route($this->route . '.index')
            ->withUpdated(trans_title($this->section) . ': ' . request($this->msgTableField));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InspectionRoutesRequest
     * @return \Illuminate\Http\Response
     */
    public function store(InspectionRoutesRequest $request)
    {
        //Auth validation
        if(Gate::denies('create inspection', $this->controller)) {
            return errorNotAllowedAccess();
        }

        if(!$this->controller->create($request->all())) {
            return errorDataBase('create');
        }

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title($this->section) . ': ' . request($this->msgTableField));
    }
}
