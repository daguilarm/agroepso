<?php

namespace App\Models\Crops;

use App\Models\BaseModel;
use App\Models\Crops\CropsEvents;
use App\Models\Crops\CropsRelationships;

class Crop extends BaseModel  {

    use CropsEvents, CropsRelationships;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'crops';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'crop_type' => 'boolean',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crop_name',
        'crop_key',
        'crop_description'
    ];
}
