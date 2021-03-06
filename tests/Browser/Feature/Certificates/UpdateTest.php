<?php
// dusk tests/Browser/Feature/Certificates/UpdateTest.php

namespace Tests\Feature\Certificates;

use App\Models\Certificates\Certificate;
use Faker\Generator as Faker;
use Laravel\Dusk\Browser;
//use PHPUnit\Framework\Assert as PHPUnit;
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
        $this->last = Certificate::orderBy('id', 'desc')->first();
        $this->faker = app(Faker::class);
        $this->route = route('dashboard.certificates.edit', $this->last->id);

        /**
         * @var data
         */
        $this->data = [
            'name' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'address' => clear_address($this->faker->address),
            'date' => $this->faker->date($format = 'd/m/Y', $max = 'now'),
        ];
    }

    /**
     * CRUD: Update
     *
     * @return void
     */
    function test_update()
    {
        // Admin CAN update
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdmin())
                ->visit($this->route)
                ->type('name', $this->data['name'])
                ->press(trans('buttons.edit'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('certificates', [
            'name' => $this->data['name'],
            'date' => date_to_db($this->data['date']),
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
