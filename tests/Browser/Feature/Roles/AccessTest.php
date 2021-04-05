<?php
// dusk tests/Browser/Feature/Roles/AccessTest.php

namespace Tests\Feature\Roles;

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
        $this->route = route('dashboard.tools.roles.index');
    }

    /**
     * Verify the users access to the route
     *
     * @return void
     */
    function test_users_access()
    {
        // Admin CAN access
        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultAdmin())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)    //It's correct
                //Conselleria
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError)   //It's an error
                //Dop
                ->loginAs($this->defaultDop())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError)   //It's an error
                //Inspector
                ->loginAs($this->defaultInspector())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError)   //It's an error
                //Coop
                ->loginAs($this->defaultCoop())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError)   //It's an error
                //User
                ->loginAs($this->defaultUser())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError)   //It's an error
                //Comercial
                ->loginAs($this->defaultComercial())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError);   //It's an error
        });
    }

    /**
     * Verify the users can update its role
     *
     * @return void
     */
    function test_change_role()
    {
        // Admin CAN access
        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultAdmin())
                ->visit($this->routeChange())
                ->assertVisible($this->responseMsgSuccess)    //It's correct
                //Conselleria
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->routeChange())
                ->assertSee($this->responseAuthFail)    //It's an error
                //Dop
                ->loginAs($this->defaultDop())
                ->visit($this->routeChange())
                ->assertSee($this->responseAuthFail)    //It's an error
                //Inspector
                ->loginAs($this->defaultInspector())
                ->visit($this->routeChange())
                ->assertSee($this->responseAuthFail)    //It's an error
                //User
                ->loginAs($this->defaultUser())
                ->visit($this->routeChange())
                ->assertSee($this->responseAuthFail)    //It's an error
                //Coop
                ->loginAs($this->defaultCoop())
                ->visit($this->routeChange())
                ->assertSee($this->responseAuthFail)    //It's an error
                //Comercial
                ->loginAs($this->defaultComercial())
                ->visit($this->routeChange())
                ->assertSee($this->responseAuthFail)    //It's an error
                //Admin
                ->loginAs($this->defaultAdmin())
                ->visit($this->routeChange('admin'))
                ->assertVisible($this->responseMsgSuccess);    //Return the value
        });
    }

    private function routeChange($role = 'user')
    {
        return  route('dashboard.tools.roles.change', $role);
    }
}
