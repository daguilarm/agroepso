<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

        /**
         * Determine whether the user can view the model.
         *
         * @return mixed
         */
        public function view()
        {
            return auth()->user()->can('view client');
        }

        /**
         * Determine whether the user can create models.
         *
         * @return mixed
         */
        public function create()
        {
            return auth()->user()->can('create client');
        }

        /**
         * Determine whether the user can update the model.
         * 
         * @return mixed
         */
        public function update()
        {
            return auth()->user()->can('edit client');
        }

        /**
         * Determine whether the user can delete the model.
         *
         * @return mixed
         */
        public function delete()
        {
            return auth()->user()->can('delete client');
        }
}