<?php

namespace App\Http\Controllers\Dashboard\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Clients\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Get an ajax response
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke(Client $client)
    {
        $value = Client::select('id', 'client_name')->where('client_name', 'like', '%' . request('search') . '%')->get();

        return response()->json($value);
    }
}
