<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\BiocidesRequest;
use App\Models\Biocides\Biocide;
use App\Tables\BiocideTable;
use Credentials, Gate;

class BiocidesController extends DashboardController
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
    protected $section = 'biocides';
    protected $msgTableField = 'biocide_name';

    public function __construct(Biocide $controller)
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
        $table = $this->getTable(BiocideTable::class);

        return view(dashboard_path($this->path . $this->section . '.index'), compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(dashboard_path($this->path . $this->section . '.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $data = $this->controller->findOrFail($id);

        return view(dashboard_path($this->path . $this->section . '.edit'), compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BiocidesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BiocidesRequest $request, int $id)
    {
        $this->controller->findOrFail($id)->update($request->all());

        return redirect()
            ->route($this->route . '.index')
            ->withUpdated(trans_title($this->section) . ': ' . request($this->msgTableField));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BiocidesRequest
     * @return \Illuminate\Http\Response
     */
    public function store(BiocidesRequest $request)
    {
        $create = $this->controller->create(request()->all());

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title($this->section) . ': ' . request($this->msgTableField));
    }
}
