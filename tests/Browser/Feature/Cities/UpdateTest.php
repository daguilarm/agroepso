<?php
// dusk tests/Browser/Feature/Cities/UpdateTest.php

namespace Tests\Feature\Cities;

use App\Models\Cities\City;
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
        $this->last = City::orderBy('id', 'desc')->first();
        $this->faker = app(Faker::class);
        $this->route = route('dashboard.tools.cities.edit', $this->last->id);

        /**
         * @var data
         */
        $this->data = [
            'name' => $this->faker->word,
            'lat' => $this->faker->latitude($min = -90, $max = 90),
            'lng' => $this->faker->longitude($min = -180, $max = 180),
            'ine' => $this->faker->postcode,
            'country' => 1,
            'state' => 3,
            'region' => 33,
        ];
    }

    /**
     * CRUD: Update
     *
     * @return void
     */
    function test_update($section = 'edit')
    {
        // Admin CAN update
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdmin())
                ->visit($this->route)
                ->type('city_name', $this->data['name'])
                ->type('city_lat', $this->data['lat'])
                ->type('city_lng', $this->data['lng'])
                ->type('ine_id', $this->data['ine'])
                ->select('country_id', $this->data['country'])
                ->select('state_id', $this->data['state'])
                ->waitFor('#region_id')
                ->select('region_id', $this->data['region'])
                ->press(trans('buttons.edit'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('cities', [
            'city_name' => $this->data['name'],
            'city_lat' => $this->data['lat'],
            'city_lng' => $this->data['lng'],
            'ine_id' => $this->data['ine'],
            'country_id' => $this->data['country'],
            'state_id' => $this->data['state'],
            'region_id' => $this->data['region'],
        ]);

        // Check for roles
        $this->browse(function (Browser $browser) {
            $browser
                //Conselleria: Not authorized
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Dop: Not authorized
                ->loginAs($this->defaultDop())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Inspector: Not authorized
                ->loginAs($this->defaultInspector())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Coop: Not authorized
                ->loginAs($this->defaultCoop())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //User: Not authorized
                ->loginAs($this->defaultUser())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Comercial: Not authorized
                ->loginAs($this->defaultComercial())
                ->visit($this->route)
                ->assertSee($this->responseAuthFail);        //Not authorized
        });
    }
}
