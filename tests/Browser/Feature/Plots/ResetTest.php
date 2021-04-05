<?php
// dusk tests/Browser/Feature/Plots/ResetTest.php

namespace Tests\Feature\Plots;

use App\Models\Plots\Plot;
use DB;
use Faker\Generator as Faker;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Assert as PHPUnit;
use Tests\CustomDuskTestCase;

class ResetTest extends CustomDuskTestCase
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

    protected $client;

    /**
     * Set up our testing environment
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        /**
         * @var custom
         */
        $this->faker = app(Faker::class);
        $this->routeIndex = route('dashboard.plots.index');
        $this->client = 1;
    }

    /**
     * CRUD: Create
     *
     * @return void
     */
    function test_reset_as_admin()
    {
        // Admin CAN reset
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->defaultAdmin())
                ->visit($this->routeIndex)
                ->assertVisible('#button-reset')
                ->click('#button-reset')
                ->assertVisible('#client_id')
                ->select('client_id', $this->client)
                ->press(trans('buttons.reset'))
                ->assertVisible($this->responseMsgSuccess);

            //Get all the plots with status active
            $totalPlots = Plot::whereClientId($this->client)->wherePlotActive('yes')->count();

            //Check total plots are 0
            PHPUnit::assertEquals(0, $totalPlots);
        });
    }

    /**
     * Auth by role
     *
     * @return void
     */
    function test_reset_by_role()
    {
        $this->browse(function (Browser $browser) {
            $browser
                //Dop: Authorized
                ->loginAs($this->defaultDop())
                ->visit($this->routeIndex)
                ->assertVisible('#button-reset')         //Authorized
                //Coop: Not authorized
                ->loginAs($this->defaultCoop())
                ->visit($this->routeIndex)
                ->assertMissing('#button-reset')         //Not authorized
                //User: Not authorized
                ->loginAs($this->defaultUser())
                ->visit($this->routeIndex)
                ->assertMissing('#button-reset')        //Not authorized
                //Conselleria: Not authorized
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->routeIndex)
                ->assertMissing('#button-reset')        //Not authorized
                //Inspector: Not authorized
                ->loginAs($this->defaultInspector())
                ->visit($this->routeIndex)
                ->assertVisible('#button-reset')        //Not authorized
                //Comercial: Not authorized
                ->loginAs($this->defaultComercial())
                ->visit($this->routeIndex)
                ->assertMissing('#button-reset');        //Not authorized
        });
    }
}
