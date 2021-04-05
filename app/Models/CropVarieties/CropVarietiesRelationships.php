<?php

namespace App\Models\CropVarieties;

use App\Models\Crops\Crop;

trait CropVarietiesRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}
