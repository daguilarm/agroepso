<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class PlotPolicy
{
    use HandlesAuthorization;

        /**
         * Determine whether the user can view the model.
         *
         * @return mixed
         */
        public function view()
        {
            return auth()->user()->can('view plot');
        }

        /**
         * Determine whether the user can create models.
         *
         * @return mixed
         */
        public function create()
        {
            return auth()->user()->can('create plot');
        }

        /**
         * Determine whether the user can update the model.
         * 
         * @return mixed
         */
        public function update()
        {
            return auth()->user()->can('edit plot');
        }

        /**
         * Determine whether the user can delete the model.
         *
         * @return mixed
         */
        public function delete()
        {
            return auth()->user()->can('delete plot');
        }
}
