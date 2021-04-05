<?php

namespace App\Services\Minify;

use Illuminate\Support\Facades\Facade;

class MinifyFacade extends Facade
{
    protected static function getFacadeAccessor() 
    { 
        return 'MinifyProvider'; 
    }
}