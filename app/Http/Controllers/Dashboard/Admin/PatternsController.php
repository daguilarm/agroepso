<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\PatternsRequest;
use App\Models\Crops\Crop;
use App\Models\Patterns\Pattern;
use App\Tables\PatternTable;
use Credentials, Gate;

class PatternsController extends DashboardController
{
    /**
     * @var protected
     */
    protected $controller;
    protected $crop;
    protected $delete;
    protected $path;
    protected $route;

    /**
     * @var protected
     * @return string
     */
    protected $section = 'patterns';
    protected $msgTableField = 'pattern_name';

    public function __construct(Pattern $controller)
    {
        $this->controller = $controller;
        $this->path = 'z_admin.';
        $this->route = 'dashboard.tools.' . $this->section;
        $this->crop = url_integer('crop_id') ?? url_integer('_key');

        //Sharing in the view
        $this->passVariablesToView();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get the table values
        $table = $this->getTable(PatternTable::class, $params = ['id' => $id]);

        //Get the crop
        $crop = app(Crop::class)->findOrFail(request('pattern'));

        return view(dashboard_path($this->path . $this->section . '.show'), compact('crop', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get the crop
        $crop = app(Crop::class)->findOrFail(request('_key'));

        return view(dashboard_path($this->path . $this->section . '.create'), compact('crop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //Get the data & the crop
        $data = $this->controller->findOrFail($id);
        $crop = app(Crop::class)->findOrFail($this->crop);

        return view(dashboard_path($this->path . $this->section . '.edit'), compact('crop', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PatternsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatternsRequest $request, int $id)
    {
        $this->controller->findOrFail($id)->update($request->all());

        return redirect()
            ->route($this->route . '.show', ['id' => $this->crop])
            ->withUpdated(trans_title($this->section) . ': ' . request($this->msgTableField));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatternsRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PatternsRequest $request)
    {
        $create = $this->controller->create(request()->all());

        return redirect()
            ->route($this->route . '.show', ['id' => $this->crop])
            ->withSuccess(trans_title($this->section) . ': ' . request($this->msgTableField));
    }
}
