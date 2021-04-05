<?php
// dusk tests/Browser/Feature/Users/ShowTest.php

namespace Tests\Feature\Users;

use App\Models\Clients\Client;
use App\Models\Users\User;
use Laravel\Dusk\Browser;
use Tests\CustomDuskTestCase;

class ShowTest extends CustomDuskTestCase
{
    /**
     * @var protected
     * Responses
     */
    protected $responseAuthFail;        // See (in <html> <body>) the not authorized message
    protected $responseErrorMessage;    // See (in <html> <body>) the error message alert
    protected $responseErrorSuccess;    // See (in <html> <body>) an success message
    protected $responseErrorWarning;    // See (in <html> <body>) a warning message
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
        $this->route = route('dashboard.users.index');
        $this->last = User::orderBy('id', 'desc')->first();
        $this->routeEdit = route('dashboard.users.edit', $this->last->id);
    }

    /**
     * CRUD: Show
     *
     * @return void
     */
    function test_can_see()
    {
        //Admin can see
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdmin())
                ->visit($this->route)
                ->click('.table-arrow-up');
                $this->assertCanSeeClientsInTable($browser);
        });

        //Admin valencia can see
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdminValencia())
                ->visit($this->route)
                ->click('.table-arrow-up');
                $this->assertCanSeeClientsInTable($browser);
        });
    }

    /**
     * CRUD: Show
     *
     * @return void
     */
    function test_cant_see()
    {
        //Dop user name
        $user = User::whereClientId($this->defaultDop()->client_id)->orderBy('id', 'asc')->first();

        //Admin user name
        $admin = $this->defaultAdmin()->name;

        //Admin can or cant see
        $this->browse(function (Browser $browser) use ($user, $admin) {
            $browser->loginAs($this->defaultDop())
                ->visit($this->route)
                ->assertSee($user->name)
                ->assertMissing($admin);
        });

        //Inspector can or cant see
        $this->browse(function (Browser $browser) use ($user, $admin) {
            $browser->loginAs($this->defaultInspector())
                ->visit($this->route)
                ->assertSee($user->name)
                ->assertMissing($admin);
        });

        //Coop can or cant see
        $this->browse(function (Browser $browser) use ($user, $admin) {
            $browser->loginAs($this->defaultCoop())
                ->visit($this->route)
                ->assertSee($user->name)
                ->assertMissing($admin);
        });
    }

    /**
     * CRUD: Show custom fields in form
     *
     * @return void
     */
    function test_show_custom_fields_in_forms()
    {
        $clients = app(Client::class)->pluck('id')->toArray();
        $roles = get_roles();
        //Remove first role (admin), because you can see your own role...
        array_shift($roles);

        // Admin CAN see fields
        $this->browse(function (Browser $browser) use ($clients, $roles) {
            $browser->loginAs($this->defaultAdmin())
                ->visit($this->routeEdit)
                ->assertSelectHasOptions('role', $roles)
                ->assertSelectHasOptions('client_id', $clients)
                //Access to the admin profile as admin
                //Admin can update its own role => must be disabled
                ->visit(route('dashboard.users.edit', 1))
                ->assertMissing('role');
        });

        // Dop CAN see some fields
        $this->browse(function (Browser $browser) use ($clients, $roles) {
            $filter = array_except($roles, [0, 1, 2]);
            $browser->loginAs($this->defaultDop())
                ->visit($this->routeEdit)
                ->assertSelectHasOptions('role', $filter)
                ->assertMissing('client_id');
        });
    }
}
