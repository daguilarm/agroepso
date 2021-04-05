<?php

namespace Tests;

use App;
use App\Models\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Browser\_Helpers\CustomClientsTestCase;
use Tests\Browser\_Helpers\CustomDeleteCase;
use Tests\Browser\_Helpers\CustomHelpersTestCase;
use Tests\Browser\_Helpers\CustomUsersTestCase;
use Tests\CreatesApplication;
use Tests\DuskTestCase;

class CustomDuskTestCase extends DuskTestCase
{
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

    /**
     * @var protected
     * Clients
     */
    protected $defaultClient;

    use CreatesApplication;
    use CustomUsersTestCase, CustomClientsTestCase, CustomHelpersTestCase, CustomDeleteCase;

    /**
     * Set up our testing environment
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        //Vars
        $this->responseMsgError = '.alert-danger';
        $this->responseMsgSuccess = '.alert-success';
        $this->responseMsgWarning = '.alert-warning';
        $this->responseAuthFail = trans('alerts.errors.notAllowed')[0];
        $this->response404 = 'Page Not Found';
    }
}
