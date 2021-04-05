<?php

namespace App\Models\Profiles;

use App\Models\BaseModel;
use App\Models\Profiles\ProfilesPresenters;
use App\Models\Profiles\ProfilesRelationships;

class Profile extends BaseModel
{
    use ProfilesPresenters, ProfilesRelationships;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_address',
        'profile_birthdate',
        'profile_city',
        'profile_region',
        'profile_state',
        'profile_country',
        'profile_zip',
        'profile_telephone',
        'profile_url',
    ];
}
