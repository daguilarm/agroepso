<?php

namespace App\Models\Cities;

use App\Models\BaseModel;
use App\Models\Cities\CitiesRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends BaseModel  {

    use CitiesRelationships;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'state_id',
        'region_id',
        'city_name',
        'city_lat',
        'city_lng',
        'ine_id',
        'sigpac',
        'catastro',
    ];
}
