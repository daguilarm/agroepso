<?php

namespace App\Http\Controllers\Dashboard\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Clients\Client;
use App\Models\CropVarieties\CropVariety;
use Illuminate\Http\Request;

class CropsController extends Controller
{
    /**
     * Get an ajax response
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke(CropVariety $crop)
    {
        $cropID = optional(Client::find(request('search')))->crop_id;

        return response()->json($crop->lists($cropID));
    }
}
