<?php

namespace App\Models\Plants;

use App\Models\BaseModel;
use App\Models\Plants\PlantsEvents;
use App\Models\Plants\PlantsHelpers;
use App\Models\Plants\PlantsPresenters;
use App\Models\Plants\PlantsRelationships;
use App\Models\Plants\PlantsScopes;

class Plant extends BaseModel  {

    use PlantsRelationships, PlantsHelpers, PlantsEvents, PlantsPresenters, PlantsScopes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plants';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'plant_name',
        'plant_company',
        'plant_ref',
        'plant_nif',
        'plant_telephone',
        'plant_address',
        'plant_state',
        'plant_region',
        'plant_city',
        'plant_zip',
        'plant_contact',
        'plant_email',
        'plant_nif_alt',
        'plant_address_alt',
        'plant_telephone_alt',
        'plant_state_alt',
        'plant_region_alt',
        'plant_city_alt',
        'plant_zip_alt',
        'plant_contact_alt',
        'plant_email_alt',
        'plant_observations',
        'plant_lat',
        'plant_lng',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['id'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'is_god'    => 'boolean',
    // ];
}
