<?php
// dusk tests/Browser/Feature/Users/ExcelTest.php

namespace Tests\Feature\Users;

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
        $this->routeIndex = route('dashboard.users.index');
        $this->route = route('dashboard.users.excel');
        $this->file = 'usuarios.xls';
        $this->email = 'testing@testing.com';
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
        $delete = DB::table('users')->where('id', '>', 100)->delete();

        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultAdmin())
                ->visit($this->route)
                ->select('client_id', 1)
                ->attach('upload_excel', storage_path('app/tests/' . $this->file))
                ->press(trans('buttons.excel'))
                ->assertMissing($this->responseMsgError);
        });

        $this->assertDatabaseHas('users', [
            'email' => $this->email,
        ]);
    }

    function test_excel_access()
    {
        $this->browse(function (Browser $browser) {
            $browser
                //Admin
                ->loginAs($this->defaultDop())
                ->visit($this->routeIndex)
                ->assertVisible('#button-excel')
                ->loginAs($this->defaultCoop())
                ->visit($this->routeIndex)
                ->assertMissing('#button-excel')
                ->loginAs($this->defaultInspector())
                ->visit($this->routeIndex)
                ->assertMissing('#button-excel')
                ->loginAs($this->defaultUser())
                ->visit($this->routeIndex)
                ->assertMissing('#button-excel')
                ->loginAs($this->defaultComercial())
                ->visit($this->routeIndex)
                ->assertMissing('#button-excel');
        });
    }
}
