<?php

namespace App\Models\Labels;

// use App\Models\Labels\LabelsEvents;
// use App\Models\Labels\LabelsHelpers;
// use App\Models\Labels\LabelsPresenters;
// use App\Models\Labels\LabelsRelationships;
// use App\Models\Labels\LabelsScopes;
use App\Models\BaseModel;
//use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Label extends BaseModel  {

    //use SoftCascadeTrait;
    //use LabelsEvents, LabelsHelpers, LabelsPresenters, LabelsRelationships, LabelsScopes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'labels';

    /**
     * The attributes for the cascade soft-deleting
     *
     * @var array
     */
    //protected $softCascade = ['relationship'];

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
        // 'user_id',
        // 'client_id',
        // 'plot_id',
        // 'crop_id',
        // 'agronomic_date',
        // 'agronomic_quantity',
        // 'agronomic_quantity_unit',
        // 'agronomic_observations',
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
