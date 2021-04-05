<?php

namespace App\Http\Controllers\Dashboard\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Plants\Plant;
use Illuminate\Http\Request;

class PlantsController extends Controller
{
    /**
     * Get an ajax response
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke(Plant $plant)
    {
        return $plant->ajax(
            $id = request('search'),
            $row = 'client_id',
            $columns = ['id', 'plant_name AS name']);
    }
}
