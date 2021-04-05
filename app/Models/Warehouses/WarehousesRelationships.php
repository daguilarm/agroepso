<?php

namespace App\Models\Warehouses;

use App\Models\Clients\Client;
use App\Models\Plants\Plant;

trait WarehousesRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
