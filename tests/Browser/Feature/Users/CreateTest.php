<?php
// dusk tests/Browser/Feature/Users/CreateTest.php

namespace Tests\Feature\Users;

use App\Models\Users\User;
use Faker\Generator as Faker;
use Laravel\Dusk\Browser;
use Tests\CustomDuskTestCase;

class CreateTest extends CustomDuskTestCase
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
        $this->faker = app(Faker::class);
        $this->routeIndex = route('dashboard.users.index');
        $this->routeCreate = route('dashboard.users.create');

        /**
         * @var data
         */
        $this->data = [
            'name' => $this->faker->name,
            'nif' => $this->faker->randomNumber(9),
            'email' => $this->faker->safeEmail,
            'locale' => 'es',
            'role' => 'dop',
            'client' => 3,
            'active' => 'yes',
            'password' => 'password',
        ];
    }

    /**
     * CRUD: Create
     *
     * @return void
     */
    function test_create()
    {
        // Admin CAN create
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdmin())
                ->visit($this->routeIndex)
                ->click('#dropdown-options')
                ->click('#button-create')
                ->type('name', $this->data['name'])
                ->type('nif', $this->data['nif'])
                ->type('email', $this->data['email'])
                ->type('password', $this->data['password'])
                ->type('password_confirmation', $this->data['password'])
                ->select('locale', $this->data['locale'])
                ->select('role', $this->data['role'])
                ->select('active', $this->data['active'])
                ->select('client_id', $this->data['client'])
                ->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        //Get last insert ID
        $getLastInserted = User::getLastId();

        $this->assertDatabaseHas('users', [
            'id' => $getLastInserted,
            'name' => $this->data['name'],
            'nif' => $this->data['nif'],
            'email' => $this->data['email'],
            'locale' => $this->data['locale'],
            'client_id' => $this->data['client'],
            'active' => $this->data['active']
        ]);

        $this->assertDatabaseHas('profiles', [
            'user_id' => $getLastInserted
        ]);

        // Check for roles
        $this->browse(function (Browser $browser) {
            $browser
                //Conselleria
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)    //It's an error
                //Inspector
                ->loginAs($this->defaultInspector())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)    //It's an error
                //Coop
                ->loginAs($this->defaultCoop())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)    //It's an error
                //User
                ->loginAs($this->defaultUser())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)    //It's an error
                //Comercial
                ->loginAs($this->defaultComercial())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail);    //It's an error
        });
    }

    /**
     * CRUD: Create for DOP.
     * It has special fields, because DOPs can't select fields like: client or role
     *
     * @return void
     */
    function test_dop_create($section = 'create')
    {
        // Dop can create users
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultDop())
                ->visit($this->routeIndex)
                ->click('#dropdown-options')
                ->click('#button-create')
                ->type('name', $this->data['name'])
                ->type('nif', $this->data['nif'])
                ->type('email', 'alt-' . $this->data['email'])
                ->type('password', $this->data['password'])
                ->type('password_confirmation', $this->data['password'])
                ->select('locale', $this->data['locale'])
                ->select('active', 'not')
                ->select('role', 'user')
                ->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        //Get last insert ID
        $getLastInserted = User::getLastId();

        $this->assertDatabaseHas('users', [
            'id' => $getLastInserted,
            'name' => $this->data['name'],
            'nif' => $this->data['nif'],
            'email' => 'alt-' . $this->data['email'],
            'locale' => $this->data['locale'],
            'client_id' => $this->defaultDop()->client_id,
            'active' => 'not'
        ]);

        $this->assertDatabaseHas('profiles', [
            'user_id' => $getLastInserted
        ]);
    }
}
