<?php
// dusk tests/Browser/Feature/Users/UpdateTest.php

namespace Tests\Feature\Users;

use App\Models\Users\User;
use Faker\Generator as Faker;
use Laravel\Dusk\Browser;
use Tests\CustomDuskTestCase;

class UpdateTest extends CustomDuskTestCase
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
        $this->last = User::orderBy('id', 'desc')->first();
        $this->faker = app(Faker::class);
        $this->route = route('dashboard.users.edit', $this->last->id);

        /**
         * @var data
         */
        $this->data = [
            'name' => $this->faker->name,
            'nif' => $this->faker->randomNumber(9),
            'email' => $this->faker->safeEmail,
            'locale' => 'es',
            'role' => 'user',
            'client' => 2,
            'password' => 'password',
            'active' => 'yes'
        ];
    }

    /**
     * CRUD: Create
     *
     * @return void
     */
    function test_update()
    {
        // Admin CAN create
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdmin())
                ->visit($this->route)
                ->type('name', $this->data['name'])
                ->type('nif', $this->data['nif'])
                ->type('email', $this->data['email'])
                ->type('password', $this->data['password'])
                ->type('password_confirmation', $this->data['password'])
                ->select('locale', $this->data['locale'])
                ->select('role', $this->data['role'])
                ->select('client_id', $this->data['client'])
                ->select('active', $this->data['active'])
                ->press(trans('buttons.edit'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('users', [
            'name' => $this->data['name'],
            'nif' => $this->data['nif'],
            'email' => $this->data['email'],
            'locale' => $this->data['locale'],
            'client_id' => $this->data['client'],
            'active' => $this->data['active']
        ]);

        // Check for roles
        $this->browse(function (Browser $browser) {
            $browser
                //Conselleria
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail)    //It's an error
                //Inspector
                ->loginAs($this->defaultInspector())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail)    //It's an error
                //Coop
                ->loginAs($this->defaultCoop())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail)    //It's an error
                //User
                ->loginAs($this->defaultUser())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail)    //It's an error
                //Comercial
                ->loginAs($this->defaultComercial())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail);    //It's an error
        });
    }

    /**
     * CRUD: Create for DOP.
     * It has special fields, because DOPs can't select fields like: client or role
     *
     * @return void
     */
    function test_dop_update()
    {
        // Dop can create users
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultDop())
                ->visit($this->route)
                ->type('name', $this->data['name'])
                ->type('nif', $this->data['nif'])
                ->type('email', $this->data['email'])
                ->type('password', $this->data['password'])
                ->type('password_confirmation', $this->data['password'])
                ->select('locale', $this->data['locale'])
                ->select('active', $this->data['active'])
                ->press(trans('buttons.edit'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('users', [
            'name' => $this->data['name'],
            'nif' => $this->data['nif'],
            'email' => $this->data['email'],
            'locale' => $this->data['locale'],
            'active' => $this->data['active']
        ]);
    }
}
