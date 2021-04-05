<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class InspectionroutePolicy
{
    use HandlesAuthorization;

        /**
         * Determine whether the user can view the model.
         *
         * @return mixed
         */
        public function view()
        {
            return auth()->user()->can('view inspectionroute');
        }

        /**
         * Determine whether the user can create models.
         *
         * @return mixed
         */
        public function create()
        {
            return auth()->user()->can('create inspectionroute');
        }

        /**
         * Determine whether the user can update the model.
         * 
         * @return mixed
         */
        public function update()
        {
            return auth()->user()->can('edit inspectionroute');
        }

        /**
         * Determine whether the user can delete the model.
         *
         * @return mixed
         */
        public function delete()
        {
            return auth()->user()->can('delete inspectionroute');
        }
}
