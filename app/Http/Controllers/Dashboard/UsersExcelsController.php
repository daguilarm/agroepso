<?php
/**
 * @middleware: dop
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\ExcelRequest;
use App\Jobs\CreateUsersFromExcel;
use App\Models\Clients\Client;
use Excel, Gate;

class UsersExcelsController extends DashboardController
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
    public function __construct()
    {
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
    public function index(Client $client)
    {
        //Auth validation
        if(Gate::denies('upload excel')) {
            return errorNotAllowedAccess();
        }

        return view(dashboard_path($this->section . '.excel'))
            ->withClients($client->selects('client_name'));
    }

    /**
     * Store excel data into storage
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ExcelRequest $request)
    {
        //Auth validation
        if(Gate::denies('upload excel')) {
            return errorNotAllowedAccess();
        }

        Excel::load(request()->file('upload_excel'), function ($reader) use ($request) {
            $reader->each(function($row) use ($request) {
                dispatch(new CreateUsersFromExcel($row->toArray(), $request->except('upload_excel')));
            });
        });

        return back()->withSuccess(trans('alerts.excel.success'));
    }
}
