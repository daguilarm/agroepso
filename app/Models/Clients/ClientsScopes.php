<?php

namespace App\Models\Clients;

trait ClientsScopes {

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeSelectByName($query)
    {
        return ['' => ''] + $query->orderBy('client_name', 'asc')->pluck('client_name', 'id')->toArray();
    }
}
