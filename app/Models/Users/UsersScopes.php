<?php

namespace App\Models\Users;

use Credentials;

trait UsersScopes {

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

   /**
    * Get user by email
    *
    * @var array
    */
    public function scopeEmail($query, $email)
    {
        return $query
            ->whereEmail($email)
            ->first();
    }

    /**
    * Get user by email
    *
    * @var array
    */
    public function scopeSelectFilterByRequestClient($query, $value)
    {
        return $query->when($value, function($query) use ($value) {
            return $query->where('client_id', $value);
        })
        ->pluck('name', 'id')
        ->toArray();
    }

    /**
     * Get all the users by client id
     *
     * @return  array
     */
    public function scopeByClient($query, $client = null)
    {
        if($client) {
            return $query->whereClientId($client)->get();
        }

        return $query->whereClientId(Credentials::client())->get();
    }

    /**
     * Get all the users order by name
     *
     * @return  array
     */
    public function scopeByName($query)
    {
        return $query->orderBy('name', 'asc');
    }

    /**
     * Get all the users order by name
     *
     * @return  array
     */
    public function scopeToSelect($query)
    {
        return $query->filterByRole('users')->byName()->pluck('name', 'id')->toArray();
    }

    public function scopeDownload($query)
    {
        return $query
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select(
                'users.user_ref AS Referencia',
                'users.client_id AS Cliente',
                'users.active AS Activo',
                'users.name AS Nombre',
                'users.email AS Email',
                'users.nif AS NIF',
                'profiles.profile_birthdate AS Nacimiento',
                'profiles.profile_address AS Dirección',
                'profiles.profile_state AS Comunidad',
                'profiles.profile_region AS Provincia',
                'profiles.profile_city AS Ciudad',
                'profiles.profile_zip AS CP',
                'profiles.profile_telephone AS Teléfono'
            )
            ->filterByRole('users')
            ->get();
    }
}
