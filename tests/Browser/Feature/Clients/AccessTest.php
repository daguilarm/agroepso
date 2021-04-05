<?php
// dusk tests/Browser/Feature/Clients/AccessTest.php

namespace Tests\Feature\Clients;

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
        $this->route = 'dashboard.clients.index';
    }

    /**
     * Verify the clients access to the route
     *
     * @return void
     */
    function test_clients_access()
    {
        // Verify the role access
        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultAdmin())
                ->visit(route($this->route))
                ->assertMissing($this->responseMsgError)    // Admin CAN access
                //Conselleria
                ->loginAs($this->defaultAdminValencia())
                ->visit(route($this->route))
                ->assertMissing($this->responseMsgError)    // Conselleria CAN access
                //Dop
                ->loginAs($this->defaultDop())
                ->visit(route($this->route))
                ->assertSee($this->responseAuthFail)    // Dop CANNOT access
                //Inspector
                ->loginAs($this->defaultInspector())
                ->visit(route($this->route))
                ->assertSee($this->responseAuthFail)    // Inspector CANNOT access
                //Coop
                ->loginAs($this->defaultCoop())
                ->visit(route($this->route))
                ->assertSee($this->responseAuthFail)    // Coop CANNOT access
                //User
                ->loginAs($this->defaultUser())
                ->visit(route($this->route))
                ->assertSee($this->responseAuthFail)    // User CANNOT access
                //Comercial
                ->loginAs($this->defaultComercial())
                ->visit(route($this->route))
                ->assertSee($this->responseAuthFail);   // Comercial CANNOT access
        });
    }
}
