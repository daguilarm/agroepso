<?php
// dusk tests/Browser/Feature/Harvests/ShowTest.php
//
namespace Tests\Feature\Harvests;

use App\Models\Users\User;
use Laravel\Dusk\Browser;
//use PHPUnit\Framework\Assert as PHPUnit;
use Tests\CustomDuskTestCase;

class ShowTest extends CustomDuskTestCase
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
        $this->route = route('dashboard.harvests.index');
    }

    /**
     * CRUD: Can see
     *
     * @return void
     */
    function test_can_see()
    {
        //Admin
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdmin())
                ->visit($this->route);
                $this->assertCanSeeClientsInTable($browser);
        });

        //Admin valencia
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultAdminValencia())
                ->visit($this->route);
                $this->assertCanSeeClientsInTable($browser);
        });
    }

    /**
     * CRUD: Can not see
     *
     * @return void
     */
    function test_can_or_cant_see()
    {
        //Dop
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultDop())
                ->visit($this->route);
                $this->assertCanNotSeeClientsInTable($browser, $seeInTable = ['valencia'], $dontSeeInTable = ['epso', 'conselleria', 'granada']);
        });

        //Inspector
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultInspector())
                ->visit($this->route);
                $this->assertCanNotSeeClientsInTable($browser, $seeInTable = ['valencia'], $dontSeeInTable = ['epso', 'conselleria', 'granada']);
        });

        //Coop
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->defaultCoop())
                ->visit($this->route);
                $this->assertCanNotSeeClientsInTable($browser, $seeInTable = ['valencia'], $dontSeeInTable = ['epso', 'conselleria', 'granada']);
        });
    }
}
