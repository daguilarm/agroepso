<?php

namespace Tests\Browser\_Helpers;

use App\Models\Clients\Client;
use Laravel\Dusk\Browser;

trait CustomClientsTestCase
{
    /**
     * Get the clients
     *
     * @param string $name
     * @return App\Models\Clients\Client
     */
    public function defaultClient($clientName = 'valencia')
    {
        return Client::findOrFail(self::getClientId($clientName));
    }

    /**
     * Get the client's ID
     *
     * @param string $name
     * @return App\Models\Clients\Client
     */
    public function getClientId($clientName = 'valencia')
    {
        if($clientName === 'epso') {
            return 1;
        }

        if($clientName === 'conselleria') {
            return 2;
        }

        if($clientName === 'valencia') {
            return 3;
        }

        if($clientName === 'granada') {
            return 4;
        }

        if($clientName === 'cereza') {
            return 5;
        }

        if($clientName === 'alcachofa') {
            return 6;
        }
    }

    /**
     * Assert an see all the clients in table
     *
     * @param object $browser
     * @return bool
     */
    public function assertCanSeeClientsInTable($browser, array $list = ['valencia', 'epso', 'conselleria', 'granada'])
    {
        return $browser
            ->with('.table', function ($table) use ($list) {
                foreach($list as $value) {
                    $table->assertSee($this->defaultClient($value)->client_name);
                }
            });
    }

    /**
     * Assert cannot see clients in table (only can see its own client)
     *
     * @param object $browser
     * @return bool
     */
    public function assertCanNotSeeClientsInTable($browser, $seeInTable, $dontSeeInTable)
    {
        return $browser
            ->with('.table', function ($table) use ($seeInTable, $dontSeeInTable) {
                //See in table
                foreach($seeInTable as $value) {
                    $table->assertSee($this->defaultClient($value)->client_name);
                }
                //Dont see in table
                foreach($dontSeeInTable as $value) {
                    $table->assertDontSee($this->defaultClient($value)->client_name);
                }
            });
    }
}
