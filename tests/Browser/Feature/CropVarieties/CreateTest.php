<?php
// dusk tests/Browser/Feature/CropVarieties/CreateTest.php

namespace Tests\Feature\CropVarieties;

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
        $this->routeShow = route('dashboard.tools.crop_varieties.show', 1);
        $this->routeCreate = route('dashboard.tools.crop_varieties.create', ['_key=' => 1]);

        /**
         * @var data
         */
        $this->data = [
            'name' => $this->faker->word,
            'select' => 2,
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
                ->visit($this->routeShow)
                ->click('#button-create')
                ->assertVisible('#crop_name')
                ->assertVisible('#crop_variety_type')
                ->type('crop_variety_name', $this->data['name'])
                ->select('crop_variety_type', $this->data['select'])
                ->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('crop_varieties', [
            'crop_variety_name' => $this->data['name'],
            'crop_variety_type' => $this->data['select'],
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
