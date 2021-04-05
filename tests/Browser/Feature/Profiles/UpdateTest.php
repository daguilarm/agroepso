<?php
// dusk tests/Browser/Feature/Profiles/UpdateTest.php

namespace Tests\Feature\Profiles;

use App\Models\Users\User;
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
        $this->last = User::orderBy('id', 'desc')->first();
        $this->faker = app(Faker::class);
        $this->route = route('dashboard.profiles.edit', $this->last->id);

        /**
         * @var data
         */
        $this->data = [
            'id' => $this->last->id,
            'name' => $this->faker->name,
            'address' => clear_address($this->faker->address),
            'date' => $this->faker->date($format = 'd/m/Y', $max = 'now'),
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'zip' => $this->faker->postcode,
            'telephone' => $this->faker->tollFreePhoneNumber,
        ];
    }

    /**
     * CRUD: Create
     *
     * @return void
     */
    function test_update()
    {
        // Admin CAN create
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080)
                ->loginAs($this->last)
                ->visit($this->route)
                ->type('name', $this->data['name'])
                ->type('profile_address', $this->data['address'])
                ->type('profile_birthdate', $this->data['date'])
                ->type('profile_city', $this->data['city'])
                ->type('profile_country', $this->data['country'])
                ->type('profile_zip', $this->data['zip'])
                ->type('profile_telephone', $this->data['telephone'])
                ->press(trans('buttons.edit'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('users', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
        ]);

        $this->assertDatabaseHas('profiles', [
            'user_id' => $this->data['id'],
            'profile_address' => $this->data['address'],
            'profile_birthdate' => date_to_db($this->data['date']),
            'profile_city' => $this->data['city'],
            'profile_country' => $this->data['country'],
            'profile_zip' => $this->data['zip'],
            'profile_telephone' => $this->data['telephone'],
        ]);
    }
}
