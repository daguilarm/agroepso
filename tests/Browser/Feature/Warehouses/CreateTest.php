<?php
// dusk tests/Browser/Feature/Warehouses/CreateTest.php

namespace Tests\Feature\Warehouses;

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
        $this->routeIndex = route('dashboard.warehouses.index');
        $this->routeCreate = route('dashboard.warehouses.create');

        /**
         * @var data
         */
        $this->data = [
            'client' => 1,
            'ref' => getReferenceFromClient('warehouse', 1),
            'name' => $this->faker->word,
            'nif' => $this->faker->swiftBicNumber,
            'telephone' => $this->faker->tollFreePhoneNumber,
            'address' => clear_address($this->faker->address),
            'state' => $this->faker->state,
            'region' => $this->faker->state,
            'city' => $this->faker->city,
            'zip' => $this->faker->postcode,
            'contact' => $this->faker->name,
            'lat' => $this->faker->latitude($min = 36.7, $max = 43.5),
            'lng' => $this->faker->latitude($min = -5.9, $max = 2.15),
            'observations' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
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
                ->select('client_id', $this->data['client'])
                ->waitFor('#plant_id')->pause(100)
                ->select('plant_id', $this->getValueFromSelector($browser, $selector = '#plant_id option:last-child'))
                ->waitFor('#warehouse_ref')
                ->type('warehouse_name', $this->data['name'])
                ->type('warehouse_nif', $this->data['nif'])
                ->type('warehouse_telephone', $this->data['telephone'])
                ->type('warehouse_address', $this->data['address'])
                ->type('warehouse_state', $this->data['state'])
                ->type('warehouse_region', $this->data['region'])
                ->type('warehouse_city', $this->data['city'])
                ->type('warehouse_zip', $this->data['zip'])
                ->type('warehouse_contact', $this->data['contact'])
                ->type('warehouse_lat', $this->data['lat'])
                ->type('warehouse_lng', $this->data['lng'])
                ->assertInputValue('warehouse_ref', $this->data['ref'])
                ->clickLink(trans('system.observations'))
                ->type('warehouse_observations', $this->data['observations'])
                ->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('warehouses', [
            'client_id' => $this->data['client'],
            'warehouse_ref' => $this->data['ref'],
            'warehouse_name' => $this->data['name'],
            'warehouse_nif' => $this->data['nif'],
            'warehouse_telephone' => $this->data['telephone'],
            'warehouse_address' => $this->data['address'],
            'warehouse_state' => $this->data['state'],
            'warehouse_region' => $this->data['region'],
            'warehouse_city' => $this->data['city'],
            'warehouse_zip' => $this->data['zip'],
            'warehouse_contact' => $this->data['contact'],
            'warehouse_lat' => $this->data['lat'],
            'warehouse_lng' => $this->data['lng'],
            'warehouse_observations' => $this->data['observations']
        ]);

        // Auth by role
        $this->browse(function (Browser $browser) {
            $browser
                //Conselleria: Not authorized
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Dop: Authorized
                ->loginAs($this->defaultDop())
                ->visit($this->routeCreate)
                ->assertVisible('form#form-create')         //Authorized
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
