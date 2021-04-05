<?php

namespace App\Models\Plants;

trait PlantsPresenters {

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */
    public function setPlantLatAttribute($value)
    {
        $this->attributes['plant_lat'] = str_replace(',', '.', $value);
    }

    public function setPlantLngAttribute($value)
    {
        $this->attributes['plant_lng'] = str_replace(',', '.', $value);
    }
}
