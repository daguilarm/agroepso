<?php
// dusk tests/Browser/Feature/Modules/UpdateTest.php

namespace Tests\Feature\Modules;

use App\Models\Modules\Module;
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
        $this->last = Module::orderBy('id', 'desc')->first();
        $this->faker = app(Faker::class);
        $this->route = route('dashboard.tools.modules.edit', $this->last->id);

        /**
         * @var data
         */
        $this->data = [
            'name' => $this->faker->word,
            'key' => $this->faker->word,
            'description' => $this->faker->catchPhrase,
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
                ->type('module_name', $this->data['name'])
                ->type('module_key', $this->data['key'])
                ->type('module_description', $this->data['description'])
                ->press(trans('buttons.edit'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('modules', [
            'module_name' => $this->data['name'],
            'module_key' => $this->data['key'],
            'module_description' => $this->data['description'],
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
