<?php

namespace App\Models\States;

use App\Models\BaseModel;
use App\Models\States\StatesRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends BaseModel  {

    use StatesRelationships;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'state_name',
        'state_lat',
        'state_lng',
    ];
}
