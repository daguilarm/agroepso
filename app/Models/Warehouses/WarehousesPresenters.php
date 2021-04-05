<?php

namespace App\Models\Warehouses;

trait WarehousesPresenters {

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */
    public function setWarehouseLatAttribute($value)
    {
        $this->attributes['warehouse_lat'] = str_replace(',', '.', $value);
    }

    public function setWarehouseLngAttribute($value)
    {
        $this->attributes['warehouse_lng'] = str_replace(',', '.', $value);
    }
}
