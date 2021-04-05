<?php
/**
 * @middleware: dop
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Models\Users\User;
use Excel, Gate;

class UsersDownloadsController extends DashboardController
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
     * Constructor initialization
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
    public function __invoke()
    {
        //Auth validation
        if(Gate::denies('create user')) {
            return errorNotAllowedAccess();
        }

        //Get sql
        $rows = $this->controller->download();

        return parent::toExcel($rows);
    }
}
