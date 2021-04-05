<?php
// dusk tests/Browser/Feature/Plots/CreateTest.php

namespace Tests\Feature\Plots;

use App\Models\Plots\Plot;
use App\Models\Users\User;
use DB;
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

    protected $listOf;

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
        $this->routeIndex = route('dashboard.plots.index');
        $this->routeCreate = route('dashboard.plots.create');

        //List of users
        $this->listOf = User::whereClientId(3)->pluck('name', 'id')->toArray();

        /**
         * @var data
         */
        $this->data = [
            'client' => 3,
            'ref' => 'test101',
            'ref_alt' => 'test202',
            'name' => sprintf('Parcela <<%s>> del cliente', $this->faker->company),
            'framework_x' => mt_rand(1 * 10, 10 * 10) / 10,
            'framework_y' => mt_rand(1 * 10, 10 * 10) / 10,
            'sigpac_region' => 3,
            'sigpac_city' => 107,
            'sigpac_polygon' => 6,
            'sigpac_plot' => 104,
            'variety' => rand(1, 90),
            'date' => $this->faker->year($max = 'now'),
            'road' => array_random([1, 2, 3]),
            'training' => array_random([1, 2, 3]),
            'pond' => array_random(['yes', 'not']),
            'cover' => array_random(['yes', 'not']),
            'area' => 4.19,
            'percent' => 100,
            'lat' => 38.601321,
            'lng' => -0.140444,
            'x' => 749020.60,
            'y' => 4276415.08,
            'z' => 'EPSG:32630',
            'height' => 242.00,
            'catastro' => '03107A00600104',
        ];
    }

    /**
     * CRUD: Create
     *
     * @return void
     */
    function test_create_as_admin()
    {
        // Admin CAN create
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->defaultAdmin())
                ->visit($this->routeIndex)
                ->click('#dropdown-options')
                ->assertVisible('#button-excel')
                ->click('#button-create')
                ->assertVisible('#client_id')
                //Check than the users are empty, before select clients
                ->assertSelectMissingOptions('user_id', $this->listOf)
                ->select('client_id', $this->data['client'])
                ->waitFor('#plant_id')
                //The client has been selected, now the users are not empty
                ->select('user_id', $this->getValueFromSelector($browser, $selector = '#user_id option:last-child'))
                ->select('plant_id', $this->getValueFromSelector($browser, $selector = '#plant_id option:first-child'))
                ->waitFor('#warehouse_id')
                ->select('warehouse_id', $this->getValueFromSelector($browser, $selector = '#warehouse_id option:first-child'))
                ->type('plot_name', $this->data['name'])
                ->type('plot_ref', $this->data['ref'])
                ->select('plot_pond', $this->data['pond'])
                ->select('plot_road', $this->data['road'])
                ->type('plot_framework_x', $this->data['framework_x'])
                ->type('plot_framework_y', $this->data['framework_y'])
                //Second tab
                ->click('#tab-container li:nth-child(2)')
                ->select('crop_variety_id', $this->data['variety'])
                ->type('plot_start_date', $this->data['date'])
                ->select('plot_crop_training', $this->data['training'])
                ->select('plot_green_cover', $this->data['cover'])
                //Fourth tab
                ->click('#tab-container li:nth-child(4)')
                ->type('#geolocation_sigpac_region', $this->data['sigpac_region'])
                ->type('#geolocation_sigpac_city', $this->data['sigpac_city'])
                ->type('#geolocation_sigpac_polygon', $this->data['sigpac_polygon'])
                ->type('#geolocation_sigpac_plot', $this->data['sigpac_plot'])
                ->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        $this->assertDatabaseHas('plots', [
            'client_id' => $this->data['client'],
            'plot_ref' => $this->data['ref'],
            'plot_name' => $this->data['name'],
            'plot_framework_x' => $this->data['framework_x'],
            'plot_framework_y' => $this->data['framework_y'],
            'plot_active' => 'yes',
            'plot_area' => $this->data['area'],
            'plot_percent_cultivated_land' => $this->data['percent'],
            'plot_real_area' => $this->data['area'],
            'crop_variety_id' => $this->data['variety'],
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
            'geo_lat' => $this->data['lat'],
            'geo_lng' => $this->data['lng'],
            'geo_x' => $this->data['x'],
            'geo_y' => $this->data['y'],
            'geo_srs' => $this->data['z'],
            'geo_height' => $this->data['height'],
            'geo_catastro' => $this->data['catastro'],
        ]);

        //Delete items
        Plot::wherePlotRef($this->data['ref'])
            ->delete();
    }

    /**
     * CRUD: Create
     *
     * @return void
     */
    function test_create_as_dop()
    {
        // Admin CAN create
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->defaultDop())
                ->visit($this->routeIndex)
                ->click('#dropdown-options')
                ->assertVisible('#button-excel')
                ->click('#button-create')
                //Not client available for select
                ->assertMissing('#client_id')
                //Check than the users are not empty
                ->assertVisible('#user_id')
                ->select('user_id', $this->getValueFromSelector($browser, $selector = '#user_id option:last-child'))
                ->type('plot_ref', $this->data['ref_alt'])
                //Fourth tab
                ->click('#tab-container li:nth-child(4)')
                ->type('#geolocation_sigpac_region', $this->data['sigpac_region'])
                ->type('#geolocation_sigpac_city', $this->data['sigpac_city'])
                ->type('#geolocation_sigpac_polygon', $this->data['sigpac_polygon'])
                ->type('#geolocation_sigpac_plot', $this->data['sigpac_plot'])
                ->press(trans('buttons.new'))
                ->assertVisible($this->responseMsgSuccess);
        });

        //Delete items
        Plot::wherePlotRef($this->data['ref_alt'])
            ->delete();
    }

    /**
     * CRUD: Create
     *
     * @return void
     */
    function test_create_as_user()
    {
        // Admin CAN create
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->defaultUser())
                ->visit($this->routeIndex)
                ->assertMissing('#button-excel')
                ->assertMissing('#button-create');
        });
    }

    /**
     * Auth by role
     *
     * @return void
     */
    function test_access_by_role()
    {
        $this->browse(function (Browser $browser) {
            $browser
                //Dop: Authorized
                ->loginAs($this->defaultDop())
                ->visit($this->routeCreate)
                ->assertMissing($this->responseMsgError)         //Authorized
                //Coop: Not authorized
                ->loginAs($this->defaultCoop())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //User: Not authorized
                ->loginAs($this->defaultUser())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)    //Not authorized
                //Conselleria: Not authorized
                ->loginAs($this->defaultAdminValencia())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Inspector: Not authorized
                ->loginAs($this->defaultInspector())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail)        //Not authorized
                //Comercial: Not authorized
                ->loginAs($this->defaultComercial())
                ->visit($this->routeCreate)
                ->assertSee($this->responseAuthFail);        //Not authorized
        });
    }
}
