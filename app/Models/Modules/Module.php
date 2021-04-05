<?php

namespace App\Models\Modules;

use App\Models\BaseModel;

class Module extends BaseModel  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modules';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_name',
        'module_key',
        'module_description',
    ];
}
