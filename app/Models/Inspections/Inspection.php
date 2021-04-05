<?php

namespace App\Models\Inspections;

use App\Models\Inspections\InspectionsHelpers;
use App\Models\Inspections\InspectionsPresenters;
use App\Models\Inspections\InspectionsRelationships;
use App\Models\BaseModel;

class Inspection extends BaseModel  {

    use InspectionsHelpers, InspectionsPresenters, InspectionsRelationships;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inspections';

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
        'plot_id',
        'client_id',
        'crop_id',
        'user_id',
        'city_id',
        'inspection_date',
        'inspection_type',
        'inspection_data',
        'inspection_observations',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'is_god'    => 'boolean',
    // ];
}
