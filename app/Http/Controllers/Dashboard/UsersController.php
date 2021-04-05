<?php
/**
 * @middleware: dop
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\UsersRequest;
use App\Models\Users\User;
use App\Tables\UserTable;
use Credentials, Gate;

class UsersController extends DashboardController
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
    protected $section = 'users';
    protected $msgTableField = 'name';

    /**
     * Constructo initialization
     */
    public function __construct(User $controller)
    {
        $this->controller = $controller;
        $this->route = 'dashboard.' . $this->section;

        //Sharing in the view
        $this->passVariablesToView();
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
        //Auth validation
        if(Gate::denies('view ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Get the table values
        $table = $this->getTable(UserTable::class);

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

        //Get parametters
        list($clients) = getValuesFromEloquent(['clients']);

        return view(dashboard_path($this->section . '.create'), compact('clients'));
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

        //Get values
        $data = $this->controller->findOrFail($id);
        list($clients) = getValuesFromEloquent(['clients']);

        return view(dashboard_path($this->section . '.edit'), compact('clients', 'data'));
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
        //Auth validation
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        /**
        * Update fields throw model helper
        */
        if(!$this->controller->toUpdate($id, $request)) {
            return errorDataBase('update');
        }

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
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        /**
        * Create fields throw model helper
        */
        if(!$this->controller->toStore($request)) {
            return errorDataBase('create');
        }

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title('users') . ': ' . request($this->msgTableField));
    }
}
