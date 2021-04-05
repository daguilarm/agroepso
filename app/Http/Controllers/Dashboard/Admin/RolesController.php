<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\RolesRequest;
use App\Models\Roles\Role;
use App\Tables\RoleTable;
use Spatie\Permission\Models\Permission;
use Credentials, Gate;

class RolesController extends DashboardController
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
    protected $section = 'roles';
    protected $msgTableField = 'name';

    /**
     * Constructor initialization
     */
    public function __construct(Role $controller)
    {
        $this->controller = $controller;
        $this->path = 'z_admin.';
        $this->route = 'dashboard.tools.' . $this->section;

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
        $table = $this->getTable(RoleTable::class);

        return view(dashboard_path($this->path . $this->section . '.index'), compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param   Spatie\Permission\Models\Permission
     * @return \Illuminate\Http\Response
     */
    public function create(Permission $permissions)
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //List all the permissions and the permissions for the role (empty in this case, because the role don't exists yect)
        list($rolePermissions, $allPermissions) = [collect([]), Permission::all()];

        return view(dashboard_path($this->path . $this->section . '.create'), compact('allPermissions', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   Spatie\Permission\Models\Permission
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Auth validation
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        $data = $this->controller->findOrFail($id);

        //List all the permissions and the permissions for the role
        list($rolePermissions, $allPermissions) = [$this->controller->permissionsByRole($data), Permission::all()];

        return view(dashboard_path($this->path . $this->section . '.edit'), compact('allPermissions', 'data', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request, int $id)
    {
        //Auth validation
        if(Gate::denies('edit ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Update roles and permissions
        $roles = $this->controller->toUpdate($request, $id);

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
    public function store(RolesRequest $request)
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Create roles and permissions
        $roles = $this->controller->toStore($request);

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title('users') . ': ' . request($this->msgTableField));
    }

    /**
     * Role change for admin
     *
     * @param string $role
     * @return \Illuminate\Http\Response
     */
    public function change($role)
    {
        //Auth validation
        if(Credentials::God()) {
            $sync = auth()->user()->syncRoles($role);
            return redirect()->route('dashboard')->withSuccess('Perfecto!!!');
        }
        return errorNotAllowedAccess();
    }
}
