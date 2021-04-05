<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Credentials, DB, Gate;

class SeedController extends DashboardController
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
    protected $section = 'seed';
    protected $msgTableField = '';

    /**
     * Constructor initialization
     */
    public function __construct()
    {
        $this->path = 'z_admin.';
        $this->route = 'dashboard.tools.' . $this->section;

        //Sharing in the view
        $this->passVariablesToView();
    }

    /**
     * Create a seed
     *
     * @param integer $delete
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = DB::select('SHOW TABLES');
        $db = 'Tables_in_' . env('DB_DATABASE');

        return view(dashboard_path($this->path . $this->section . '.index'), compact('db', 'tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param   Spatie\Permission\Models\Permission
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $seeder = '')
    {
        $table = $request->tableName;
        $file = $request->fileName;
        $rows = $request->rowName;

        //Get the values
        $results = DB::table($table)
            ->select($rows)
            ->get();

        //Set the options
        foreach($results as $key_item => $result) {
            $fields = '';
            foreach($result as $key => $value) {
                $first = $key === key($result) ? '' : ' ';
                $last = end($result);
                $last = key($result);
                $last = $key === $last ? '' : ',';
                $fields .= $first . $key . ' = "' . $value . '"' . $last;
            }
            $seeder .= '[' . $fields . '],' . '\n';
        }

        return view(dashboard_path($this->path . $this->section . '.seeder'), compact('file', 'table', 'seeder'));
    }
}
