<?php

namespace App\Models\Users;

trait UsersPresenters {

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getRoleAttribute($value)
    {
        return $this->getRoleNames()->implode(', ');
    }

    public function getCreatedAtAttribute()
    {
        return $this->getDate($this->attributes['updated_at'] ?? $this->attributes['created_at']);
    }
}
