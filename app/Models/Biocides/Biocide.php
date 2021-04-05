<?php

namespace App\Models\Biocides;

use App\Models\BaseModel;

class Biocide extends BaseModel  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'biocides';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'biocide_num',
        'biocide_name',
        'biocide_company',
        'biocide_formula',
    ];
}
