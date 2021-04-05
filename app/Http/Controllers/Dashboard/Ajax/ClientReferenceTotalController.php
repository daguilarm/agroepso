<?php

namespace App\Http\Controllers\Dashboard\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Plots\Plot;
use Illuminate\Http\Request;

class ClientReferenceTotalController extends Controller
{
    /**
     * Get an ajax response
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke()
    {
        //Get the request reference for this client: plot, warehosuse,...
        $value = getReferenceFromClient(request('field'), request('id'));

        return response()->json($value);
    }
}
