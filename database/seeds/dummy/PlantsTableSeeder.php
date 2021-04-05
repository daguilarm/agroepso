<?php

use App\Models\Clients\Client;
use App\Models\Plants\Plant;
use App\Models\Warehouses\Warehouse;
use Illuminate\Database\Seeder;

class PlantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plants')->delete();

        $clients = Client::all();

        foreach($clients as $client) {
            for($x = 1; $x <= rand(5, 50); $x++) {
                $plant[$x] = $this->createPlant($client, $x);
                if($plant[$x]) {
                    for($y = 1; $y <= rand(10, 50); $y++) {
                        $this->createWarehouse($client, $plant[$x], $y);
                        flush();
                    }
                }
                flush();
            }
        }
    }

    public function createPlant($client, $orden)
    {
        //Create plant
        return factory(Plant::class)->create([
            'plant_name' => 'Planta Nº ' . $orden . ' - ' . $client->client_name,
            'client_id' => $client->id,
            'plant_ref' => format_ref($orden)
        ]);
    }

    public function createWarehouse($client, $plant, $orden)
    {
       factory(Warehouse::class)->create([
           'warehouse_name' => $plant->plant_name . ': Almacen Nº ' . $orden . ' - ' . $client->client_name,
           'client_id' => $client->id,
           'plant_id' => $plant->id,
           'warehouse_ref' => format_ref($orden)
       ]);
    }
}
