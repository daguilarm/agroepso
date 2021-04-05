<?php

namespace App\Http\Controllers\Dashboard\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Warehouses\Warehouse;
use Illuminate\Http\Request;

class WarehousesController extends Controller
{
    /**
     * Get an ajax response
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke(Warehouse $warehouse)
    {
        return $warehouse->ajax(
            $id = request('search'),
            $row = 'plant_id',
            $columns = ['id', 'warehouse_name AS name']);
    }
}
