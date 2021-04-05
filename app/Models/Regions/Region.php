<?php

namespace App\Models\Regions;

use App\Models\BaseModel;
use App\Models\Regions\RegionsRelationships;
use App\Models\Regions\RegionsScopes;

class Region extends BaseModel  {

    use RegionsRelationships, RegionsScopes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'regions';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'state_id',
        'region_name',
        'region_lat',
        'region_lng',
    ];
}
