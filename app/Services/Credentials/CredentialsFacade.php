<?php

namespace App\Services\Credentials;

use Illuminate\Support\Facades\Facade;

class CredentialsFacade extends Facade
{
    protected static function getFacadeAccessor() 
    { 
        return 'CredentialsProvider'; 
    }
}