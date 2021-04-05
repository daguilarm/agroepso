<?php
// dusk tests/Browser/Feature/Roles/CrudTest.php

namespace Tests\Feature\Users;

use App\Models\Roles\Role;
use Faker\Generator as Faker;
use Laravel\Dusk\Browser;
use Tests\CustomDuskTestCase;

class CrudTest extends CustomDuskTestCase
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
        $this->faker = app(Faker::class);
        $this->route = 'dashboard.tools.roles.';
        $this->data = [
            'name' => $this->faker->word,
            'permissions' => ['#permissions-1', '#permissions-2', '#permissions-3'],
        ];
    }

    /**
     * CRUD: Create
     *
     * @return void
     */
    function test_create($section = 'create')
    {
        // Admin CAN create
        $this->browse(function (Browser $browser) use ($section) {
            $browser->loginAs($this->defaultAdmin())
                ->visit(route($this->route . $section))
                ->assertMissing($this->responseMsgError)
                ->type('name', $this->data['name']);
                $this->selectCheckBox($browser, $this->data['permissions']);
            $browser->driver->executeScript('window.scrollTo(0, 500);');
            $browser->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('roles', [
            'name' => $this->data['name']
        ]);

        // Admin Conselleria CANNOT create
        $this->browse(function (Browser $browser) use ($section) {
            $browser
                //Conselleria
                ->loginAs($this->defaultAdminValencia())
                ->visit(route($this->route . $section))
                ->assertSee($this->responseAuthFail)
                //Dop
                ->loginAs($this->defaultDop())
                ->visit(route($this->route . $section))
                ->assertSee($this->responseAuthFail)
                //User
                ->loginAs($this->defaultUser())
                ->visit(route($this->route . $section))
                ->assertSee($this->responseAuthFail);
        });
    }

    /**
     * CRUD: Create
     *
     * @return void
     */
    function test_update($section = 'edit')
    {
        //Create the edit route for the last item
        $roleID = Role::orderBy('id', 'desc')->first()->id;

        // Admin CAN create
        $this->browse(function (Browser $browser) use ($section, $roleID) {
            $browser->loginAs($this->defaultAdmin())
                ->visit(route($this->route . $section, $roleID))
                ->assertMissing($this->responseMsgError)
                ->type('name', $this->data['name']);
                $this->selectCheckBox($browser, $this->data['permissions']);
            $browser->driver->executeScript('window.scrollTo(0, 500);');
            $browser->press(trans('buttons.edit'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('roles', [
            'name' => $this->data['name']
        ]);

        // Admin Conselleria CANNOT create
        $this->browse(function (Browser $browser) use ($section, $roleID) {
            $browser
                //Conselleria
                ->loginAs($this->defaultAdminValencia())
                ->visit(route($this->route . $section, $roleID))
                ->assertSee($this->responseAuthFail)
                //Dop
                ->loginAs($this->defaultDop())
                ->visit(route($this->route . $section, $roleID))
                ->assertSee($this->responseAuthFail)
                //User
                ->loginAs($this->defaultUser())
                ->visit(route($this->route . $section, $roleID))
                ->assertSee($this->responseAuthFail);
        });
    }
}
