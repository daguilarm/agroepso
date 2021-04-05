<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Reset directory images
        $success = File::cleanDirectory(storage_path('app/public/clients'));

        //Delete the DBs
        DB::table('clients')->delete();

        //Seed the DBs
        DB::table('clients')->insert([
            [
                //
            ]
        ]);
    }
}
