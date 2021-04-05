<?php

namespace App\Models\Profiles;

trait ProfilesPresenters {

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */
    public function setProfileBirthdateAttribute($value)
    {
        if(is_string($value)){
            $this->attributes['profile_birthdate'] = $this->setDate($value);
        } else {
            $this->attributes['profile_birthdate'] = null;
        }
    }

    public function getProfileBirthdateAttribute($value)
    {
        return $this->getDate($value);
    }

    public function setProfileAddressAttribute($value)
    {
        $this->attributes['profile_address'] = preg_replace('/[\r\n|\n|\r]+/', ' ', $value);
    }
}
