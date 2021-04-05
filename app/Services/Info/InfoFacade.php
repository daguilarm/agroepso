<?php

namespace App\Services\Info;

use Illuminate\Support\Facades\Facade;

class InfoFacade extends Facade
{
    protected static function getFacadeAccessor() 
    { 
        return 'InfoProvider'; 
    }
}