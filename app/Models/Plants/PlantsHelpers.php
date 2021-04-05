<?php

namespace App\Models\Plants;

use Credentials;

trait PlantsHelpers {

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Filter query by data
     *
     * @param string $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function selectsByData($data)
    {
        $id = is_numeric($data)
            ? $data
            : optional($data)->client_id;

        return ['' => ''] + $this
            ->where('client_id', $id)
            ->orderBy('plant_name', 'asc')->pluck('plant_name', 'id')
            ->toArray();
    }

    /**
     * Get all the clients (in form select array) if the user has the admin role
     *
     * @return  array
     */
    public function clientsIfAdmin() : array
    {
         return Credentials::isAdmin()
             ? $this->selects(['id', 'client_name'])
             : [];
    }
}
