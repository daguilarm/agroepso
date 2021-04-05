<?php

namespace App\Models\Patterns;

use App\Models\BaseModel;
use App\Models\Patterns\PatternsRelationships;

class Pattern extends BaseModel  {

    use PatternsRelationships;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patterns';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crop_id',
        'pattern_name',
        'pattern_reference',
        'pattern_description',
    ];
}
