<?php

namespace App\Http\Controllers\Dashboard\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Get an ajax response
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke(User $plant)
    {
        return $plant->ajax(
            $id = request('search'),
            $row = 'client_id',
            $columns = ['id', 'name']);
    }
}
