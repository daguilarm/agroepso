<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\WarehousesRequest;
use App\Models\Clients\Client;
use App\Models\Plants\Plant;
use App\Models\Warehouses\Warehouse;
use App\Tables\WarehouseTable;
use Gate;

class WarehousesController extends DashboardController
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
    protected $section = 'warehouses';
    protected $msgTableField = 'warehouse_name';

    public function __construct(Warehouse $controller)
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
        $table = $this->getTable(WarehouseTable::class);

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

        //Get values
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

        //Get parametters
        list($clients, $plants) = getValuesFromEloquent(['clients', 'plants']);

        return view(dashboard_path($this->section . '.create'), compact('clients', 'plants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, Client $client, Plant $plant)
    {
        //Auth validation
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Get parametters
        $data = $this->controller->findOrFail($id);
        list($clients, $plants) = getValuesFromEloquent(['clients', 'plants']);

        return view(dashboard_path($this->section . '.edit'), compact('clients', 'data', 'plants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\WarehousesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WarehousesRequest $request, int $id)
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
     * @param  \App\Http\Requests\WarehousesRequest
     * @return \Illuminate\Http\Response
     */
    public function store(WarehousesRequest $request)
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
}
