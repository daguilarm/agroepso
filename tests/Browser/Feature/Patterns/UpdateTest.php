<?php
// dusk tests/Browser/Feature/Patterns/UpdateTest.php

namespace Tests\Feature\Patterns;

use App\Models\Patterns\Pattern;
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
        $this->last = Pattern::orderBy('id', 'desc')->first();
        $this->faker = app(Faker::class);
        $this->route = route('dashboard.tools.patterns.edit', ['id' => $this->last->id, '_key' => 2]);

        /**
         * @var data
         */
        $this->data = [
            'name' => $this->faker->word,
            'reference' => $this->faker->postcode,
            'description' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
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
                ->type('pattern_name', $this->data['name'])
                ->type('pattern_reference', $this->data['reference'])
                ->type('pattern_description', $this->data['description'])
                ->press(trans('buttons.edit'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('patterns', [
            'pattern_name' => $this->data['name'],
            'pattern_reference' => $this->data['reference'],
            'pattern_description' => $this->data['description'],
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
