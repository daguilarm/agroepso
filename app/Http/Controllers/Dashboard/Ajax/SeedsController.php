<?php

namespace App\Http\Controllers\Dashboard\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Schema;

class SeedsController extends Controller
{
    /**
     * Get an ajax response
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke()
    {
        $columns = $columns = Schema::getColumnListing(request('table'));
        sort($columns);

        return response()->json($columns);
    }
}
