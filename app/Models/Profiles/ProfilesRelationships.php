<?php

namespace App\Models\Profiles;

use App\Models\Users\User;

trait ProfilesRelationships {
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongTo(User::class);
    }
}