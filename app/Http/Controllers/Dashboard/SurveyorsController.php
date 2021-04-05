<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\UsersRequest;
use App\Models\Clients\Client;
use App\Models\Users\User;
use App\Tables\UserTable;
use Credentials;

class SurveyorsController extends DashboardController
{
    /**
     * @var protected
     */
    protected $controller;
    protected $route;

    /**
     * @var protected
     * @return string
     */
    protected $role = 'dop';
    protected $section = 'surveyors';
    protected $msgTableField = 'name';

    /**
     * Constructo initialization
     */
    public function __construct(User $controller)
    {
        $this->controller = $controller;
        $this->route = 'dashboard.' . $this->role . '.' . $this->section;

        //Sharing in the view
        view()->share([
            'section'   => $this->section,
            'role'      => $this->role,
            'route'     => $this->route,
        ]);
    }

    /**
     * Display a listing of the resource and delete item.
     *
     * @param integer $delete
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(dashboard_path($this->section . '.index'));
    }

    /**
     * Display a listing of the resource and delete item.
     *
     * @param integer $delete
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view(dashboard_path($this->section . '.show'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param   App\Models\Clients\Client
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        return view(dashboard_path($this->section . '.create'))
            ->withClients($client->selects(['id', 'client_name']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   App\Models\Clients\Client
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, int $id)
    {
        $data = $this->controller
            ->findOrFail($id);

        return view(dashboard_path($this->section . '.edit'), compact('data'))
            ->withClients($client->selects(['id', 'client_name']));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, int $id)
    {
        //Update fields throw model scope
        $this->controller->toUpdate($id, $request);

        return redirect()
            ->route($this->route . '.index')
            ->withUpdated(trans_title('users') . ': ' . request($this->msgTableField));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Http\Requests\UsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //Create fields throw model scope
        $create = $this->controller->toStore($request);

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title('users') . ': ' . request($this->msgTableField));
    }
}
