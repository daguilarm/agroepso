<?php
// dusk tests/Browser/Feature/Options/CreateTest.php

namespace Tests\Feature\Options;

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
        $this->routeIndex = route('dashboard.tools.options.index');
        $this->routeCreate = route('dashboard.tools.options.create');

        /**
         * @var data
         */
        $this->data = [
            'name' => $this->faker->word,
            'key' => $this->faker->word,
            'category' => 'plot',
            'description' => $this->faker->catchPhrase,
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
                ->type('option_name', $this->data['name'])
                ->type('option_key', $this->data['key'])
                ->type('option_category', $this->data['category'])
                ->type('option_description', $this->data['description'])
                ->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('options', [
            'option_name' => $this->data['name'],
            'option_key' => $this->data['key'],
            'option_category' => $this->data['category'],
            'option_description' => $this->data['description'],
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
