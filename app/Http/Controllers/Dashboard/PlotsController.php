<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\PlotsRequest;
use App\Jobs\CreatePlots;
use App\Models\Clients\Client;
use App\Models\Plants\Plant;
use App\Models\Plots\Plot;
use App\Models\Users\User;
use App\Tables\PlotTable;
use Gate;

class PlotsController extends DashboardController
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
    protected $section = 'plots';
    protected $msgTableField = 'plot_name';

    public function __construct(Plot $controller)
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
        if(Gate::denies('view ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Get the table values
        $table = $this->getTable(PlotTable::class);

        return view(dashboard_path($this->section . '.index'), compact('table'));
    }

    /**
     * Show the info for the resource resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Auth validation
        if(Gate::denies('view ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        $data = $this->controller->findOrFail($id);

        return view(dashboard_path($this->section . '.show'), compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        return view(dashboard_path($this->section . '.create'));
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
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        $data = $this->controller->findOrFail($id);

        return view(dashboard_path($this->section . '.edit'), compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PlotsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlotsRequest $request, int $id)
    {
        //Auth validation
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        if(!$this->controller->toUpdate($id)) {
            return errorDataBase('update');
        }

        return redirect()
            ->route($this->route . '.index')
            ->withUpdated(trans_title($this->section) . ': ' . request($this->msgTableField));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PlotsRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PlotsRequest $request)
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Create plot
        $this->controller->toStore();

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title($this->section) . ': ' . request($this->msgTableField));
    }
}
