<?php

namespace App\Services\Tables;

use Illuminate\Support\Facades\Facade;

class TableFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'TableProvider';
    }
}
