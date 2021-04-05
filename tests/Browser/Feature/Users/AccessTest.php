<?php
// dusk tests/Browser/Feature/Users/AccessTest.php

namespace Tests\Feature\Users;

use Laravel\Dusk\Browser;
use Tests\CustomDuskTestCase;

class AccessTest extends CustomDuskTestCase
{
    /**
     * @var protected
     * Responses
     */
    protected $responseAuthFail;        // See (in <html> <body>) the not authorized message
    protected $responseMsgError;        // See (in <html> <body>) the error message alert
    protected $responseMsgSuccess;      // See (in <html> <body>) an success message
    protected $responseMsgWarning;      // See (in <html> <body>) a warning message
    protected $response404;             // See a 404 error in title tag

    /**
     * Set up our testing environment
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        //Vars
        $this->route = route('dashboard.users.index');
    }

    function test_users_access()
    {
        // Roles access
        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultAdmin())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)    //It's correct
                //Conselleria
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)    //It's correct
                //Dop
                ->loginAs($this->defaultDop())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)    //It's correct
                //Inspector
                ->loginAs($this->defaultInspector())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)    //It's correct
                //Coop
                ->loginAs($this->defaultCoop())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)    //It's correct
                //User
                ->loginAs($this->defaultUser())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError)    //It's an error
                //Comercial
                ->loginAs($this->defaultComercial())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError);   //It's an error
        });
    }
}
