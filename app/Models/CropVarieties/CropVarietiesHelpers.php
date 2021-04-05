<?php

namespace App\Models\CropVarieties;

use App\Models\Clients\Client;
use Credentials;

trait CropVarietiesHelpers {

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function lists($crop)
    {
        return $this
            ->whereCropId($crop)
            ->orderBy('crop_variety_name', 'asc')
            ->select('id', 'crop_id', 'crop_variety_name', 'crop_variety_type')
            ->get();
    }
}
