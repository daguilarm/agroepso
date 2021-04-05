<?php
// dusk tests/Browser/Feature/Crops/CreateTest.php

namespace Tests\Feature\Crops;

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
        $this->routeIndex = route('dashboard.tools.crops.index');
        $this->routeCreate = route('dashboard.tools.crops.create');

        /**
         * @var data
         */
        $this->data = [
            'name' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
            'description' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'module' => $this->faker->word
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
                ->type('crop_name', $this->data['name'])
                ->type('crop_description', $this->data['description'])
                ->type('crop_key', $this->data['module'])
                ->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('crops', [
            'crop_name' => $this->data['name'],
            'crop_description' => $this->data['description'],
            'crop_key' => $this->data['module'],
        ]);

        // Auth by role
        $this->browse(function (Browser $browser) {
            $browser
                //Conselleria: Not authorized
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
