<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\DashboardController;
use Credentials;

class ClientsController extends DashboardController
{
    /**
     * Display a listing of the resource and delete item.
     *
     * @param integer $delete
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $client)
    {
        //Get the table values
        $user = auth()->user();
        $user->update(['client_id' => $client]);

        return redirect()->back()->withSuccess('El cliente del usuario, se ha actualizado correctamente');
    }
}
