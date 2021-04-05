<?php

namespace App\Models\Users;

use Credentials, DB;

trait UsersHelpers {

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Create user and sync roles
     *
     * @var array
     */
     public function toStore($request)
     {
        return DB::transaction(function() use ($request) {
            //Format the request
            $request = self::handle($request);

            //Create values
            $user = $this->create($request->all());
            $user->profile()->create();

            //Sync roles
            if($request->role) {
                $user->syncRoles($request->role);
            }

            return $user;
        });
     }

   /**
    * Update values and sync roles
    *
    * @var array
    */
    public function toUpdate($id, $request)
    {
        return DB::transaction(function() use ($id, $request) {
            //Get the user
            $user = $this->findOrFail($id);

            //Sync roles
            if($request->role) {
                $user->syncRoles($request->role);
            }

            //Format the request
            $request = self::handle($request);

            //If password is null dont change the database
            $data = is_null($request->password) ? $request->except('password') : $request->all();

            //Update values
            return $user->update($data);
        });
    }

    /**
     * Get all the users (in form select array) if the user has not the admin role
     *
     * @return  array
     */
    public function bySearch()
    {
        return $this->byName()
            ->filterByRole('users')
            ->selectFilterByRequestClient(request('f_client_id'));
    }

    /*
    |--------------------------------------------------------------------------
    | Auxiliar methods
    |--------------------------------------------------------------------------
    */

    /**
     * Handle request
     *
     * @param object $request
     */
    private function handle($request)
    {
        //Get the plant values
        if($request->plant_id) {
            $request['plant_ref'] = format_ref(DB::table('plants')->find($request->plant_id)->plant_ref);
        } else {
            $request['plant_ref'] = $request['plant_id'] = null;
        }

        //Get the warehouse values
        if($request->warehouse_id) {
            $request['warehouse_ref'] = format_ref(DB::table('warehouses')->find($request->warehouse_id)->warehouse_ref);
        } else {
            $request['warehouse_id'] = $request['warehouse_ref'] = null;
        }

        return $request;
    }
}
