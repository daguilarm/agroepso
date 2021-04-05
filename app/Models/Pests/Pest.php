<?php

namespace App\Models\Pests;

use App\Models\BaseModel;
use App\Models\Pests\PestsRelationships;

class Pest extends BaseModel  {

    use PestsRelationships;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pests';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crop_id',
        'pest_name',
        'pest_description'
    ];
}
