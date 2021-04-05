<?php

use App\Models\Clients\Client;
use App\Models\Modules\Module;
use App\Models\Options\Option;
use Illuminate\Database\Seeder;

class ClientsConfigurationsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        //Default values
        $array = [];
        $clients = Client::all();
        $modules = Module::all();
        $options = Option::all();

        //Reset DB
        DB::table('client_module')->delete();
        DB::table('client_option')->delete();

        //Run all the clients
        foreach($clients as $client) {

            //Get all the modules
            foreach($modules as $module) {
                $arrayModules[] = [
                    'client_id' => $client->id,
                    'module_id' => $module->id
                ];
            }

            //Get all the options
            foreach($options as $option) {
                $arrayOptions[] = [
                    'client_id' => $client->id,
                    'option_id' => $option->id
                ];
            }
        }

        //Add items
        DB::table('client_module')->insert($arrayModules);
        DB::table('client_option')->insert($arrayOptions);
    }
}
