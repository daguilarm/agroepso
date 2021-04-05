<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\ClientsRequest;
use App\Models\Clients\Client;
use App\Models\Crops\Crop;
use App\Tables\ClientTable;
use Gate, Image, Response;
use DB;

class ClientsController extends DashboardController
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
    protected $section = 'clients';
    protected $msgTableField = 'client_name';

    public function __construct(Client $controller)
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
        $table = $this->getTable(ClientTable::class);

        return view(dashboard_path($this->section . '.index'), compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param object $crop App\Models\Crops\Crop
     * @return \Illuminate\Http\Response
     */
    public function create(Crop $crop)
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Get the rest of the data
        $crops = $crop->selects(['id', 'crop_name']);
        $relationships = $this->controller->dataFromRelationships();

        return view(dashboard_path($this->section . '.create'), compact('crops', 'relationships'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param object $crop App\Models\Crops\Crop
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, Crop $crop)
    {
        //Auth validation
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Get all the data
        $data = $this->controller->findOrFail($id);
        
        //Get the rest of the data
        $crops = $crop->selects(['id', 'crop_name']);
        $relationships = $this->controller->dataFromRelationships($data);

        return view(dashboard_path($this->section . '.edit'), compact('crops', 'data', 'relationships'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\ClientsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientsRequest $request, int $id)
    {
        //Auth validation
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Update
        $update = $this->controller->toUpdate($request, $id);

        return redirect()
            ->route($this->route . '.index')
            ->withUpdated(trans_title('clients') . ': ' . request($this->msgTableField));
    }
    
    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Http\Requests\ClientsRequest
     * @return \Illuminate\Http\Response
     */
    public function store(ClientsRequest $request)
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Create
        $create = $this->controller->toCreate($request);

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title('clients') . ': ' . request($this->msgTableField));
    }
}