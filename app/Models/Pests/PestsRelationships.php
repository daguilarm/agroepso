<?php

namespace App\Models\Pests;

use App\Models\Crops\Crop;

trait PestsRelationships {

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
