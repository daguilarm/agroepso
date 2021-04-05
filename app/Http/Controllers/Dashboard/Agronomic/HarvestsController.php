<?php

namespace App\Http\Controllers\Dashboard\Agronomic;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\HarvestsRequest;
use App\Models\Harvests\Harvest;
use App\Models\Plots\Plot;
use App\Tables\HarvestTable;
use Gate;

class HarvestsController extends DashboardController
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
    protected $section = 'harvests';
    protected $msgTableField = '';

    public function __construct(Harvest $controller)
    {
        $this->controller = $controller;
        $this->path = 'z_agronomics.';
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
        $table = $this->getTable(HarvestTable::class);

        return view(dashboard_path($this->path . $this->section . '.index'), compact('table'))->withReadonly(false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Plot $plot)
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        $plots = $plot->byRoleToSelect();

        return view(dashboard_path($this->path . $this->section . '.create'), compact('plots'))->withReadonly(false);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, Plot $plot)
    {
        //Auth validation
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        $data = $this->controller->findOrFail($id);
        $plots = $plot->byRoleToSelect();

        return view(dashboard_path($this->path . $this->section . '.edit'), compact('data', 'plots'))->withReadonly(false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\HarvestsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HarvestsRequest $request, int $id)
    {
        //Auth validation
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
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
     * @param  \App\Http\Requests\HarvestsRequest
     * @return \Illuminate\Http\Response
     */
    public function store(HarvestsRequest $request)
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        if(!$this->controller->create($request->all())) {
            return errorDataBase('create');
        }

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title($this->section) . ': ' . request($this->msgTableField));
    }

    /**
     * Show the the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, Plot $plot)
    {
        //Auth validation
        if(Gate::denies('view ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        $data = $this->controller->findOrFail($id);
        $plots = $plot->byRoleToSelect();

        return view(dashboard_path($this->path . $this->section . '.edit'), compact('data', 'plots'))->withReadonly(true);
    }
}
