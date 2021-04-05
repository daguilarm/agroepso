<?php
// dusk tests/Browser/Feature/Plants/CreateTest.php

namespace Tests\Feature\Plants;

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
        $this->routeIndex = route('dashboard.plants.index');
        $this->routeCreate = route('dashboard.plants.create');

        /**
         * @var data
         */
        $this->data = [
            'client' => 1,
            'ref' => getReferenceFromClient('plant', 1),
            'name' => $this->faker->word,
            'nif' => $this->faker->swiftBicNumber,
            'telephone' => $this->faker->tollFreePhoneNumber,
            'address' => clear_address($this->faker->address),
            'state' => $this->faker->state,
            'region' => $this->faker->state,
            'city' => $this->faker->city,
            'zip' => $this->faker->postcode,
            'contact' => $this->faker->name,
            'email' => $this->faker->safeEmail,
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
                ->waitFor('#plant_ref')
                ->assertInputValue('plant_ref', $this->data['ref'])
                ->type('plant_name', $this->data['name'])
                ->type('plant_nif', $this->data['nif'])
                ->type('plant_telephone', $this->data['telephone'])
                ->type('plant_address', $this->data['address'])
                ->type('plant_state', $this->data['state'])
                ->type('plant_region', $this->data['region'])
                ->type('plant_city', $this->data['city'])
                ->type('plant_zip', $this->data['zip'])
                ->type('plant_contact', $this->data['contact'])
                ->type('plant_email', $this->data['email'])
                ->type('plant_lat', $this->data['lat'])
                ->type('plant_lng', $this->data['lng'])
                ->clickLink(sections('plants.table.production'))
                ->type('plant_nif_alt', $this->data['nif'])
                ->type('plant_telephone_alt', $this->data['telephone'])
                ->type('plant_address_alt', $this->data['address'])
                ->type('plant_state_alt', $this->data['state'])
                ->type('plant_region_alt', $this->data['region'])
                ->type('plant_city_alt', $this->data['city'])
                ->type('plant_zip_alt', $this->data['zip'])
                ->type('plant_contact_alt', $this->data['contact'])
                ->type('plant_email_alt', $this->data['email'])
                ->clickLink(trans('system.observations'))
                ->type('plant_observations', $this->data['observations'])
                ->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('plants', [
            'client_id' => $this->data['client'],
            'plant_ref' => $this->data['ref'],
            'plant_name' => $this->data['name'],
            'plant_nif' => $this->data['nif'],
            'plant_telephone' => $this->data['telephone'],
            'plant_address' => $this->data['address'],
            'plant_state' => $this->data['state'],
            'plant_region' => $this->data['region'],
            'plant_city' => $this->data['city'],
            'plant_zip' => $this->data['zip'],
            'plant_contact' => $this->data['contact'],
            'plant_email' => $this->data['email'],
            'plant_email_alt' => $this->data['email'],
            'plant_telephone_alt' => $this->data['telephone'],
            'plant_nif_alt' => $this->data['nif'],
            'plant_address_alt' => $this->data['address'],
            'plant_state_alt' => $this->data['state'],
            'plant_region_alt' => $this->data['region'],
            'plant_city_alt' => $this->data['city'],
            'plant_zip_alt' => $this->data['zip'],
            'plant_contact_alt' => $this->data['contact'],
            'plant_lat' => $this->data['lat'],
            'plant_lng' => $this->data['lng'],
            'plant_observations' => $this->data['observations'],
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
