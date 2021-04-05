<?php
/**
 * @middleware: dop
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Models\Plots\Plot;
use Gate;

class PlotsResetsController extends DashboardController
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
    public function __invoke(Plot $plot)
    {
        //Set client
        $client = (!empty(request()->client_id) && is_numeric(request()->client_id))
            ? request()->client_id
            : null;

        //Auth validation
        if(Gate::denies('reset plot') || !$client) {
            return errorNotAllowedAccess();
        }

        //Reset plots
        $plot->whereClientId($client)
            ->update([
                'plot_active' => 'not'
            ]);

        return redirect()
            ->back()
            ->withSuccess(request()->delete_message);
    }
}
