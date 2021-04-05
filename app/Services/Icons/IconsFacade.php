<?php

namespace App\Services\Icons;

use Illuminate\Support\Facades\Facade;

class IconsFacade extends Facade
{
    protected static function getFacadeAccessor() 
    { 
        return 'IconsProvider'; 
    }
}