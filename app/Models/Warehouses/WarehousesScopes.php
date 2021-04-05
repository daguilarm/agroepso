<?php

namespace App\Models\Warehouses;

use Credentials;

trait WarehousesScopes {

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
    * Filter query by data
    *
    * @param string $data
    * @return \Illuminate\Database\Eloquent\Model
    */
    public function scopeByClient($query, $data = null)
    {
        if(is_null($data)) {
            return collect([]);
        }

    $client = optional($data)->client_id;
    $plant = optional($data)->plant_id;

    return $query
        ->where('client_id', $client)
        ->where('plant_id', $plant)
        ->select('id', 'warehouse_name')
        ->orderBy('warehouse_name', 'asc')
        ->get();
   }
}
