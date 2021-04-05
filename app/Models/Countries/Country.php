<?php

namespace App\Models\Countries;

use App\Models\BaseModel;


class Country extends BaseModel  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_name',
        'country_lat',
        'country_lng'
    ];
}
