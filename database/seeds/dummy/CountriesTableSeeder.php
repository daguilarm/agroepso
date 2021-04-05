<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_lat' => '40.416691',
                'country_lng' => '-3.700138',
                'country_name' => 'España',
                'deleted_at' => NULL,
                'created_at' => '2017-09-19 10:12:41',
                'updated_at' => '2017-09-19 10:12:41',
            ),
        ));
        
        
    }
}