<?php

namespace App\Models\Warehouses;

use App\Models\BaseModel;
use App\Models\Warehouses\WarehousesEvents;
use App\Models\Warehouses\WarehousesHelpers;
use App\Models\Warehouses\WarehousesPresenters;
use App\Models\Warehouses\WarehousesRelationships;
use App\Models\Warehouses\WarehousesScopes;

class Warehouse extends BaseModel  {

    use WarehousesEvents, WarehousesHelpers, WarehousesPresenters, WarehousesRelationships, WarehousesScopes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'warehouses';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'plant_id',
        'warehouse_name',
        'warehouse_company',
        'warehouse_ref',
        'warehouse_address',
        'warehouse_nif',
        'warehouse_city',
        'warehouse_state',
        'warehouse_region',
        'warehouse_country',
        'warehouse_zip',
        'warehouse_telephone',
        'warehouse_contact',
        'warehouse_observations',
        'warehouse_lat',
        'warehouse_lng',
    ];
}
