<?php

namespace App\Models\Patterns;

use App\Models\Crops\Crop;

trait PatternsRelationships {

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
