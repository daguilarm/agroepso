<?php
// dusk tests/Browser/Feature/Plots/ExcelTest.php

namespace Tests\Feature\Plots;

use Laravel\Dusk\Browser;
use Tests\CustomDuskTestCase;
use DB;

class Excel extends CustomDuskTestCase
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
    protected $file;
    protected $email;
    protected $route;
    protected $routeIndex;

    /**
     * Set up our testing environment
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        //Vars
        $this->routeIndex = route('dashboard.plots.index');
        $this->route = route('dashboard.plots.excel');
        $this->file = 'plots.xls';
        $this->ref = 'AA0987';
        $this->plotName = 'Parcela 2';
        $this->client = 3;
        $this->crop = 105;
        $this->type = 2;
        $this->region = 3;
        $this->city = 142;
        $this->aggregate = 0;
        $this->zone = 0;
        $this->polygon = 5;
        $this->plot = 81;
    }

    function test_excel_download()
    {
        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultAdmin())
                ->visit($this->route)
                ->assertVisible('#client_id')
                ->assertVisible('#upload_excel')
                ->click('#download-excel')
                ->assertMissing($this->responseMsgError);
        });

        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultDop())
                ->visit($this->route)
                ->assertMissing('#client_id')
                ->assertVisible('#upload_excel');
        });
    }

    function test_excel_upload()
    {
        $delete = DB::table('plots')->where('id', '>', 70)->delete();

        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultAdmin())
                ->visit($this->route)
                ->select('#client_id', $this->client)
                ->waitFor('#crop_variety_id')
                ->select('#crop_variety_id', $this->crop)
                ->attach('upload_excel', storage_path('app/tests/' . $this->file))
                ->press(trans('buttons.excel'))
                ->assertMissing($this->responseMsgError);
        });

        $this->assertDatabaseHas('plots', [
            'plot_ref' => $this->ref,
            'plot_name' => $this->plotName,
            'client_id' => $this->client,
            'crop_variety_id' => $this->crop,
            'crop_variety_type' => $this->type
        ]);

        $this->assertDatabaseHas('plot_geolocations', [
            'geo_sigpac_region' => $this->region,
            'geo_sigpac_city' => $this->city,
            'geo_sigpac_aggregate' => $this->aggregate,
            'geo_sigpac_polygon' => $this->polygon,
            'geo_sigpac_plot' => $this->plot
        ]);
    }

    function test_excel_access()
    {
        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultDop())
                ->visit($this->routeIndex)
                ->click('#dropdown-options')
                ->assertVisible('#button-excel')
                ->loginAs($this->defaultCoop())
                ->visit($this->routeIndex)
                ->click('#dropdown-options')
                ->assertMissing('#button-excel')
                ->loginAs($this->defaultInspector())
                ->visit($this->routeIndex)
                ->click('#dropdown-options')
                ->assertMissing('#button-excel')
                ->loginAs($this->defaultUser())
                ->visit($this->routeIndex)
                ->click('#dropdown-options')
                ->assertMissing('#button-excel')
                ->loginAs($this->defaultComercial())
                ->visit($this->routeIndex)
                ->click('#dropdown-options')
                ->assertMissing('#button-excel');
        });
    }
}
