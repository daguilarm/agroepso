<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('states')->delete();
        
        \DB::table('states')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Andalucía',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Aragón',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Principado de Asturias',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Illes Balears',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Islas Canarias',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Cantabria',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Castilla y León',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Castilla - La Mancha',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Cataluña',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Comunitat Valenciana',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Extremadura',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Galicia',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Comunidad de Madrid ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Región de Murcia',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Comunidad Foral de Navarra',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'País Vasco',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'La Rioja',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Ceuta',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'country_id' => 1,
                'state_lat' => '0.000000',
                'state_lng' => '0.000000',
                'state_name' => 'Melilla',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}