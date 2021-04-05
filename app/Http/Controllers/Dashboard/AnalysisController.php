<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\AnalysisRequest;
use App\Models\Analysis\Analysi;
use App\Tables\AnalysiTable;
use Gate;

class AnalysisController extends DashboardController
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
    protected $section = 'analysis';
    protected $msgTableField = '';

    public function __construct(Analysi $controller)
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
        $table = $this->getTable(AnalysiTable::class);

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
        if(Gate::denies('update ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        $data = $this->controller->findOrFail($id);

        return view(dashboard_path($this->section . '.edit'), compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\AnalysisRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnalysisRequest $request, int $id)
    {
        //Auth validation
        if(Gate::denies('update ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        $this->controller->findOrFail($id)->update($request->all());

        return redirect()
            ->route($this->route . '.index')
            ->withUpdated(trans_title($this->section) . ': ' . request($this->msgTableField));
    }
    
    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Http\Requests\AnalysisRequest
     * @return \Illuminate\Http\Response
     */
    public function store(AnalysisRequest $request)
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        $create = $this->controller->create(request()->all());

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title($this->section) . ': ' . request($this->msgTableField));
    }
}