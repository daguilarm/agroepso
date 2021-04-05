<?php
/**
 * @middleware: dop
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Models\Plots\Plot;
use Excel, Gate;

class PlotsDownloadsController extends DashboardController
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
    protected $section = 'plots';
    protected $msgTableField = 'plot_name';

    /**
     * Constructor initialization
     */
    public function __construct(Plot $controller)
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
        if(Gate::denies('create plot')) {
            return errorNotAllowedAccess();
        }

        //Get sql
        $rows = $this->controller->download();

        return parent::toExcel($rows);
    }
}
