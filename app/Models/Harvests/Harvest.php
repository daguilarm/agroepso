<?php

namespace App\Models\Harvests;

use App\Models\Harvests\HarvestsEvents;
use App\Models\Harvests\HarvestsHelpers;
use App\Models\Harvests\HarvestsPresenters;
use App\Models\Harvests\HarvestsRelationships;
use App\Models\Harvests\HarvestsScopes;
use App\Models\BaseModel;

class Harvest extends BaseModel  {

    use HarvestsEvents, HarvestsHelpers, HarvestsPresenters, HarvestsRelationships, HarvestsScopes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'harvests';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'custom_parameters' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'plot_id',
        'crop_id',
        'agronomic_date',
        'agronomic_quantity',
        'agronomic_quantity_unit',
        'agronomic_observations',
        'custom_parameters',
    ];
}
