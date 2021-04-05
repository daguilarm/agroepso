<?php

namespace App\Policies;

use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Credentials;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @return mixed
     */
    public function view()
    {
        return auth()->user()->can('view user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @return mixed
     */
    public function create()
    {
        return auth()->user()->can('create user');
    }

    /**
     * Determine whether the user can update the model.
     * 
     * @return mixed
     */
    public function update()
    {
        return auth()->user()->can('edit user');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return mixed
     */
    public function delete()
    {
        return auth()->user()->can('delete user');
    }
}
