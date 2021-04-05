<?php

namespace App\Models\CropVarieties;

use App\Models\BaseModel;

class CropVariety extends BaseModel  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'crop_varieties';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crop_id',
        'crop_variety_name',
        'crop_variety_type',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    // public function crop()
    // {
    //     return $this->belongsTo(Crop::class);
    // }
}
