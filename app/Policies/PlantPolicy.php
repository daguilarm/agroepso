<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class PlantPolicy
{
    use HandlesAuthorization;

        /**
         * Determine whether the user can view the model.
         *
         * @return mixed
         */
        public function view()
        {
            return auth()->user()->can('view plant');
        }

        /**
         * Determine whether the user can create models.
         *
         * @return mixed
         */
        public function create()
        {
            return auth()->user()->can('create plant');
        }

        /**
         * Determine whether the user can update the model.
         * 
         * @return mixed
         */
        public function update()
        {
            return auth()->user()->can('edit plant');
        }

        /**
         * Determine whether the user can delete the model.
         *
         * @return mixed
         */
        public function delete()
        {
            return auth()->user()->can('delete plant');
        }
}
