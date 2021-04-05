<?php
// dusk tests/Browser/Feature/Profiles/AccessTest.php

namespace Tests\Feature\Profiles;

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
        $this->route = 'dashboard.profiles.edit';
    }

    function test_profiles_access()
    {
        // Admin only can update its own profile
        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultAdmin())
                ->visit(route($this->route, $this->defaultAdmin()->id))
                ->assertMissing($this->responseMsgError)    //It's correct
                //Dop
                ->visit(route($this->route, $this->defaultDop()->id))
                ->assertVisible($this->responseMsgError)    //It's an error
                //User
                ->visit(route($this->route, $this->defaultUser()->id))
                ->assertVisible($this->responseMsgError)    //It's an error
                //Comercial
                ->visit(route($this->route, $this->defaultComercial()->id))
                ->assertVisible($this->responseMsgError);   //It's an error
        });

        // User only can update its own profile
        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultUser())
                ->visit(route($this->route, $this->defaultUser()->id))
                ->assertMissing($this->responseMsgError)    //It's correct
                //Dop
                ->visit(route($this->route, $this->defaultDop()->id))
                ->assertVisible($this->responseMsgError)   //It's an error
                //User
                ->visit(route($this->route, $this->defaultAdmin()->id))
                ->assertVisible($this->responseMsgError)   //It's an error
                //Comercial
                ->visit(route($this->route, $this->defaultComercial()->id))
                ->assertVisible($this->responseMsgError);   //It's an error;
        });
    }
}
