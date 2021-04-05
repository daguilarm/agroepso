<?php

namespace App\Models\Images;

use App\Models\BaseModel;

class Image extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'images';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'model_id',
        'file',
    ];
}
