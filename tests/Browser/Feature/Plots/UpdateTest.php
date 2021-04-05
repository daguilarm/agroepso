<?php
// dusk tests/Browser/Feature/Plots/UpdateTest.php

namespace Tests\Feature\Plots;

use App\Models\Plots\Plot;
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
        $this->faker = app(Faker::class);
        $this->plot = Plot::where('client_id', '>', 2)->orderBy('id', 'desc')->first();
        $this->route = route('dashboard.plots.edit', $this->plot->id);

        /**
         * @var data
         */
        $this->data = [
            'client' => rand_array_except([3, 4, 5, 6], [$this->plot->client_id]),
            'ref' => str_random(8),
            'name' => sprintf('Parcela <<%s>> del cliente', $this->faker->company),
            'framework_x' => mt_rand(1 * 10, 10 * 10) / 10,
            'framework_y' => mt_rand(1 * 10, 10 * 10) / 10,
            'sigpac_region' => 5,
            'sigpac_city' => 17,
            'sigpac_polygon' => 6,
            'sigpac_plot' => 102,
            'date' => $this->faker->year($max = 'now'),
            'road' => array_random([1, 2, 3]),
            'training' => array_random([1, 2, 3]),
            'pond' => array_random(['yes', 'not']),
            'cover' => array_random(['yes', 'not']),
            'active' => array_random(['yes', 'not']),
            'area' => 10.54,
            'percent' => 82,
            'lat' => 34.601321,
            'lng' => -0.340444,
            'x' => 249020.60,
            'y' => 5276415.08,
            'z' => 'EPSG:32631',
            'height' => 42.00,
            'catastro' => '99909A00600104',
        ];
    }

    /**
     * CRUD: Update
     *
     * @return void
     */
    function test_update_as_admin()
    {
        // Admin CAN update
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdmin())
            ->visit($this->route)
            ->select('client_id', null)
            ->select('client_id', $this->data['client'])
            ->pause(1000)
            ->select('user_id', $this->getValueFromSelector($browser, $selector = '#user_id option:first-child'))
            ->select('plant_id', $this->getValueFromSelector($browser, $selector = '#plant_id option:last-child'))
            ->pause(1000)
            ->select('warehouse_id', $this->getValueFromSelector($browser, $selector = '#warehouse_id option:last-child'))
            ->type('plot_name', $this->data['name'])
            ->type('plot_ref', $this->data['ref'])
            ->select('plot_pond', $this->data['pond'])
            ->select('plot_road', $this->data['road'])
            ->select('plot_active', $this->data['active'])
            ->type('plot_framework_x', $this->data['framework_x'])
            ->type('plot_framework_y', $this->data['framework_y'])
            ->type('plot_area', $this->data['area'])
            ->type('plot_percent_cultivated_land', $this->data['percent'])
            ->pause(1000)
                //Second tab
            ->click('#tab-container li:nth-child(2)')
            ->type('plot_start_date', $this->data['date'])
            ->select('plot_crop_training', $this->data['training'])
            ->select('plot_green_cover', $this->data['cover'])
                //Fourth tab
            ->click('#tab-container li:nth-child(4)')
            ->type('#geolocation_sigpac_region', $this->data['sigpac_region'])
            ->type('#geolocation_sigpac_city', $this->data['sigpac_city'])
            ->type('#geolocation_sigpac_polygon', $this->data['sigpac_polygon'])
            ->type('#geolocation_sigpac_plot', $this->data['sigpac_plot'])
            ->press(trans('buttons.edit'))
            ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('plots', [
            'client_id' => $this->data['client'],
            'plot_ref' => $this->data['ref'],
            'plot_name' => $this->data['name'],
            'plot_framework_x' => $this->data['framework_x'],
            'plot_framework_y' => $this->data['framework_y'],
            'plot_active' => $this->data['active'],
            'plot_area' => $this->data['area'],
            'plot_percent_cultivated_land' => $this->data['percent'],
            'plot_start_date' => $this->data['date'],
            'plot_road' => $this->data['road'],
            'plot_pond' => $this->data['pond'],
            'plot_crop_training' => $this->data['training'],
            'plot_green_cover' => $this->data['cover'],
        ]);

        $this->assertDatabaseHas('plot_geolocations', [
            'geo_sigpac_region' => $this->data['sigpac_region'],
            'geo_sigpac_city' => $this->data['sigpac_city'],
            'geo_sigpac_polygon' => $this->data['sigpac_polygon'],
            'geo_sigpac_plot' => $this->data['sigpac_plot'],
        ]);
    }

    /**
     * CRUD: Update
     *
     * @return void
     */
    function test_update_as_dop()
    {
        $plot = Plot::whereClientId($this->defaultDop()->client_id)->orderBy('id', 'desc')->first();
        $route = route('dashboard.plots.edit', $plot->id);

        // Admin CAN update
        $this->browse(function (Browser $browser) use ($route) {
            $browser->loginAs($this->defaultDop())
            ->visit($route)
            ->assertMissing('#client_id')
            ->pause(1000)
            ->select('user_id', $this->getValueFromSelector($browser, $selector = '#user_id option:last-child'))
            ->select('plant_id', $this->getValueFromSelector($browser, $selector = '#plant_id option:last-child'))
            ->pause(1000)
            ->select('warehouse_id', $this->getValueFromSelector($browser, $selector = '#warehouse_id option:last-child'))
            ->type('plot_name', $this->data['name'])
            ->type('plot_ref', $this->data['ref'])
            ->select('plot_pond', $this->data['pond'])
            ->select('plot_road', $this->data['road'])
            ->select('plot_active', $this->data['active'])
            ->type('plot_framework_x', $this->data['framework_x'])
            ->type('plot_framework_y', $this->data['framework_y'])
            ->type('plot_area', $this->data['area'])
            ->type('plot_percent_cultivated_land', $this->data['percent'])
            ->pause(1000)
                //Second tab
            ->click('#tab-container li:nth-child(2)')
            ->type('plot_start_date', $this->data['date'])
            ->select('plot_crop_training', $this->data['training'])
            ->select('plot_green_cover', $this->data['cover'])
                //Fourth tab
            ->click('#tab-container li:nth-child(4)')
            ->type('#geolocation_sigpac_region', $this->data['sigpac_region'])
            ->type('#geolocation_sigpac_city', $this->data['sigpac_city'])
            ->type('#geolocation_sigpac_polygon', $this->data['sigpac_polygon'])
            ->type('#geolocation_sigpac_plot', $this->data['sigpac_plot'])
            ->press(trans('buttons.edit'))
            ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('plots', [
            'plot_ref' => $this->data['ref'],
            'plot_name' => $this->data['name'],
            'plot_framework_x' => $this->data['framework_x'],
            'plot_framework_y' => $this->data['framework_y'],
            'plot_active' => $this->data['active'],
            'plot_area' => $this->data['area'],
            'plot_percent_cultivated_land' => $this->data['percent'],
            'plot_start_date' => $this->data['date'],
            'plot_road' => $this->data['road'],
            'plot_pond' => $this->data['pond'],
            'plot_crop_training' => $this->data['training'],
            'plot_green_cover' => $this->data['cover'],
        ]);

        $this->assertDatabaseHas('plot_geolocations', [
            'geo_sigpac_region' => $this->data['sigpac_region'],
            'geo_sigpac_city' => $this->data['sigpac_city'],
            'geo_sigpac_polygon' => $this->data['sigpac_polygon'],
            'geo_sigpac_plot' => $this->data['sigpac_plot'],
        ]);
    }

    /**
     * Check for roles
     *
     * @return void
     */
    function test_roles()
    {
        $this->browse(function (Browser $browser) {
            $browser
                //Conselleria: Not authorized
            ->loginAs($this->defaultAdminValencia())
            ->visit($this->route)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Dop: Authorized
                ->loginAs($this->defaultDop())
                ->visit($this->route)
                ->assertMissing($this->responseMsgError)   //Authorized
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
