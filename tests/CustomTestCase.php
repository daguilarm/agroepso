<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\Browser\_Helpers\CustomUsersTestCase;
use Tests\CreatesApplication;

class CustomTestCase extends TestCase
{
    use CreatesApplication, CustomUsersTestCase;

    /**
     * @var protected
     * Users
     */
    protected $customUser;
    protected $defaultAdmin;
    protected $defaultAdminValencia;
    protected $defaultDop;
    protected $defaultInspector;
    protected $defaultCoop;
    protected $defaultUser;
    protected $defaultComercial;
}
