<?php
// dusk tests/Browser/Feature/Inspections/AccessTest.php

namespace Tests\Feature\Inspections;

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
        $this->route = route('dashboard.inspections.index');
    }

    /**
     * Verify the inspections access to the route
     *
     * @return void
     */
    function test_inspections_access()
    {
        // Verify the role access
        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultAdmin())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)    // Admin CAN access
                //Conselleria
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)    // Conselleria CAN access
                //Dop
                ->loginAs($this->defaultDop())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)    // Dop CAN access
                //Inspector
                ->loginAs($this->defaultInspector())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)    // Inspector CAN access
                //Coop
                ->loginAs($this->defaultCoop())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError)    // Coop CANNOT access
                //User
                ->loginAs($this->defaultUser())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError)    // User CANNOT access
                //Comercial
                ->loginAs($this->defaultComercial())
                ->visit($this->route)
                ->assertVisible($this->responseMsgError);   // Comercial CANNOT access
        });
    }
}
