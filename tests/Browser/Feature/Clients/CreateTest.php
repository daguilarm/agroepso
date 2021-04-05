<?php
// dusk tests/Browser/Feature/Clients/CreateTest.php

namespace Tests\Feature\Clients;

use DB;
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
        $this->routeIndex = route('dashboard.clients.index');
        $this->routeCreate = route('dashboard.clients.create');

        /**
         * @var data
         */
        $this->data = [
            'crop' => rand(1, 3),
            'name' => $this->faker->word,
            'contact' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'address' => clear_address($this->faker->address),
            'phone' => $this->faker->tollFreePhoneNumber,
            'nif' => $this->faker->swiftBicNumber,
            'state' => $this->faker->state,
            'region' => $this->faker->state,
            'city' => $this->faker->city,
            'zip' => $this->faker->postcode,
            //Relationships
            'modules' => ['#modules-1', '#modules-3'],
            'regions' => ['#regions-1', '#regions-10', '#regions-40'],
            'options' => ['#options-1', '#options-3'],//The test only can test this items, because the numbers are repeated in the view (due to category filter)
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
            $browser
                ->loginAs($this->defaultAdmin())
                ->visit($this->routeIndex)
                ->click('#button-create')
                ->type('client_name', $this->data['name'])
                ->select('crop_id', $this->data['crop'])
                ->type('client_contact', $this->data['contact'])
                ->type('client_email', $this->data['email'])
                ->type('client_address', $this->data['address'])
                ->type('client_telephone', $this->data['phone'])
                ->type('client_nif', $this->data['nif'])
                ->type('client_state', $this->data['state'])
                ->type('client_region', $this->data['region'])
                ->type('client_city', $this->data['city'])
                ->type('client_zip', $this->data['zip']);
            //Create modules
            $browser->clickLink(sections('clients.tabs.options'));
            $this->selectCheckBox($browser, $this->data['modules']);
            $this->selectCheckBox($browser, $this->data['regions']);
            $this->selectCheckBox($browser, $this->data['options']);
            //Scroll and submit
            $browser->element('#mandatory-msg')->getLocationOnScreenOnceScrolledIntoView();
            $browser->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('clients', [
            'client_name' => $this->data['name'],
            'crop_id' => $this->data['crop'],
            'client_contact' => $this->data['contact'],
            'client_email' => $this->data['email'],
            'client_telephone' => $this->data['phone'],
            'client_nif' => $this->data['nif'],
            'client_region' => $this->data['region'],
            'client_city' => $this->data['city'],
            'client_zip' => $this->data['zip'],
        ]);

        //Get the last client ID
        $lastClientId = DB::table('clients')
            ->whereClientName($this->data['name'])
            ->whereClientEmail($this->data['email'])
            ->select('id')
            ->first()
            ->id;

        //Assert regions
        $this->assertDatabaseHas('client_region', [
            'client_id' => $lastClientId,
            'region_id' => 1
        ])->assertDatabaseHas('client_region', [
            'client_id' => $lastClientId,
            'region_id' => 10
        ])->assertDatabaseHas('client_region', [
            'client_id' => $lastClientId,
            'region_id' => 40
        ]);

        //Assert modules
        $this->assertDatabaseHas('client_module', [
            'client_id' => $lastClientId,
            'module_id' => 1
        ])->assertDatabaseHas('client_module', [
            'client_id' => $lastClientId,
            'module_id' => 3
        ]);

        //Assert Options
        $this->assertDatabaseHas('client_option', [
            'client_id' => $lastClientId,
            'option_id' => 1
        ])->assertDatabaseHas('client_option', [
            'client_id' => $lastClientId,
            'option_id' => 3
        ]);

        // Auth by role
        $this->browse(function (Browser $browser) {
            $browser
                //Conselleria: OK
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Dop: Not authorized
                ->loginAs($this->defaultDop())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Inspector: Not authorized
                ->loginAs($this->defaultInspector())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Coop: Not authorized
                ->loginAs($this->defaultCoop())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //User: Not authorized
                ->loginAs($this->defaultUser())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Comercial: Not authorized
                ->loginAs($this->defaultComercial())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail);        //Not authorized
        });
    }
}
