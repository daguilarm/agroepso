<?php

namespace App\Models\Plots;

use App\Models\BaseModel;
use App\Models\Plots\PlotsEvents;
use App\Models\Plots\PlotsHelpers;
use App\Models\Plots\PlotsPresenters;
use App\Models\Plots\PlotsRelationships;
use App\Models\Plots\PlotsScopes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Plot extends BaseModel  {

    use PlotsEvents, PlotsHelpers, PlotsPresenters, PlotsRelationships, PlotsScopes, SoftCascadeTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plots';

    /**
     * The attributes for the cascade soft-deleting
     *
     * @var array
     */
    protected $softCascade = ['geolocation', 'harvest', 'inspection'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'plot_framework_x' => 'float',
        'plot_framework_y' => 'float',
        'plot_start_date' => 'integer',
        'plot_percent_cultivated_land' => 'integer',
        'plot_area' => 'float',
        'plot_real_area' => 'float',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plot_ref',
        'user_id',
        'plant_id',
        'warehouse_id',
        'client_id',
        'city_id',
        'country_id',
        'region_id',
        'state_id',
        'plot_name',
        'plot_start_date',
        'plot_framework_x',
        'plot_framework_y',
        'plot_area',
        'plot_real_area',
        'plot_percent_cultivated_land',
        'plot_last_production',
        'plot_green_cover',
        'plot_pond',
        'plot_road',
        'plot_active',

        'crop_id',
        'crop_variety_id',
        'crop_variety_type',
        'plot_crop_quantity',
        'plot_crop_training',
        'pattern_id',

        'plot_quality_igp',
        'plot_quality_dop'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['id'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'is_god'    => 'boolean',
    // ];
}
