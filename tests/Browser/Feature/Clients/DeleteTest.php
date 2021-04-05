<?php
// dusk tests/Browser/Feature/Clients/DeleteTest.php

namespace Tests\Feature\Clients;

use App\Models\Clients\Client;
use Laravel\Dusk\Browser;
use Tests\CustomDuskTestCase;

class DeleteTest extends CustomDuskTestCase
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

        /**
         * @var custom
         */
        $this->path = '/dashboard/clients';
        $this->route = route('dashboard.clients.index');
    }

    /**
     * Can delete
     *
     * @return void
     */
    function test_can_delete()
    {
        // Admin CAN delete
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdmin())
                ->visit($this->route);
                $this->assertCanDelete($browser);
        });
    }

    /**
     * Can delete
     *
     * @return void
     */
    function test_can_restore()
    {
        // Admin CAN restore
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdmin())
                ->visit($this->route);
                $this->assertCanRestore($browser);
        });

        // Dop CAN NOT restore
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultDop())
                ->visit($this->route)
                ->assertMissing('.button-restore');
        });
    }

    /**
     * Can not delete
     *
     * @return void
     */
    function test_cant_delete()
    {
        // Valencia CANT delete
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdminValencia())
                ->visit($this->route)
                ->assertMissing(trans('buttons.delete'));
        });

        // Inspector CANT delete
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultInspector())
                ->visit($this->route)
                ->assertMissing(trans('buttons.delete'));
        });

        // Coop CANT delete
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultCoop())
                ->visit($this->route)
                ->assertMissing(trans('buttons.delete'));
        });

        // User CANT delete
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultUser())
                ->visit($this->route)
                ->assertMissing(trans('buttons.delete'));
        });

        // Comercial CANT delete
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultComercial())
                ->visit($this->route)
                ->assertMissing(trans('buttons.delete'));
        });
    }
}
