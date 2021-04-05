<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Merkeleon\Table\Table;
use Credentials;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get the table html to export
     *
     * @param string $table
     * @return Merkeleon\Table\Table
     */
    public function getTable(string $table, $params = []) : Table
    {
        return $table::create($this->section, $params);
    }

    /**
     * Get the Table repository for the controller
     *
     * @return string
     */
    public function getTableRepository() : string
    {
        return '\\App\\Tables\\' . studly_case(str_singular($this->section)) . 'Table';
    }

    /**
     * Get the delete string messsage
     *
     * @return string
     */
    public function passVariablesToView()
    {
        return view()->share([
            'section'   => $this->section,
            'route'     => $this->route,
        ]);
    }
}
