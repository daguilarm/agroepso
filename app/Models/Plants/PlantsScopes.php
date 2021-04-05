<?php

namespace App\Models\Plants;

use Credentials;

trait PlantsScopes {

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

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
}
