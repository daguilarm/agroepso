<?php

namespace App\Models\CropVarieties;

trait CropVarietiesPresenters {

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */
    public function getCropVarietyTypeTextAttribute()
    {
        return $this->attributes['crop_variety_type'] 
            ? trans('_config.crop_variety_types.' . $this->attributes['crop_variety_type']) 
            : null;
    }
}
