<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Cities\City;
use App\Models\Users\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
            return view('dashboard.home.index')->with('section', null);
        }
        return redirect()->route('login');
    }
}
