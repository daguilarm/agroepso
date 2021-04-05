<?php

namespace App\Models\Options;

use App\Models\BaseModel;
use App\Models\Options\OptionsRelationships;

class Option extends BaseModel  {

    use OptionsRelationships;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'options';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option_name',
        'option_description',
        'option_key',
        'option_category',
    ];
}
