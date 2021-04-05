<?php
// dusk tests/Browser/Feature/Crops/AccessTest.php

namespace Tests\Feature\Crops;

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
        $this->route = 'dashboard.tools.crops.index';
    }

    /**
     * Verify the crops access to the route
     *
     * @return void
     */
    function test_crops_access()
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
                ->assertVisible($this->responseMsgError)    // Conselleria CANNOT access
                //Dop
                ->loginAs($this->defaultDop())
                ->visit(route($this->route))
                ->assertVisible($this->responseMsgError)    // Dop CANNOT access
                //Inspector
                ->loginAs($this->defaultInspector())
                ->visit(route($this->route))
                ->assertVisible($this->responseMsgError)    // Inspector CANNOT access
                //Coop
                ->loginAs($this->defaultCoop())
                ->visit(route($this->route))
                ->assertVisible($this->responseMsgError)    // Coop CANNOT access
                //User
                ->loginAs($this->defaultUser())
                ->visit(route($this->route))
                ->assertVisible($this->responseMsgError)    // User CANNOT access
                //Comercial
                ->loginAs($this->defaultComercial())
                ->visit(route($this->route))
                ->assertVisible($this->responseMsgError);   // Comercial CANNOT access
        });
    }
}
