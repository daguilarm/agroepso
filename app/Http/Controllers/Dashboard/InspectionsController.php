<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\InspectionsRequest;
use App\Models\Inspections\Inspection;
use App\Models\Users\User;
use App\Tables\InspectionTable;
use Credentials, Gate, Storage;

class InspectionsController extends DashboardController
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
    protected $section = 'inspections';
    protected $msgTableField = 'inspection_name';

    public function __construct(Inspection $controller)
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
        $table = $this->getTable(InspectionTable::class);

        return view(dashboard_path($this->section . '.index'), compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //List of associates
        $users = $user->toSelect();

        //Documents
        $files = getFilesFromFolder('inspections/custom/' . Credentials::cropKey());

        return view(dashboard_path($this->section . '.create'), compact('files', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, User $user)
    {
        //Auth validation
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        $data = $this->controller->findOrFail($id);
        //List of associates
        $users = $user->toSelect();

        return view(dashboard_path($this->section . '.edit'), compact('data', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InspectionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InspectionsRequest $request, int $id)
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
     * @param  \App\Http\Requests\InspectionsRequest
     * @return \Illuminate\Http\Response
     */
    public function store(InspectionsRequest $request)
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
