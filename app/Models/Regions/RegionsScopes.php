<?php

namespace App\Models\Regions;

trait RegionsScopes {

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
   
    /**
     * Get all the results for the Region in a State
     * @param  string $state
     * @return  collection
     */
    public function scopeSelectsByState($query, $state)
    {
        return $query->where('state_id', $state)
            ->orderBy('region_name', 'asc')
            ->pluck('region_name', 'id')
            ->toArray();
    }


}
