<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model\Install;
use Carbon\Carbon;

class VineyardVarietyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crop_variety_types')->insert([
            ['crop_id' => 1, 'crop_variety_type_name' => 'Blanco', 'crop_variety_type_code' => '2', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'crop_variety_type_name' => 'Tinto', 'crop_variety_type_code' => '1', 'created_at' => new DateTime, 'updated_at' => new DateTime]
        ]);
    }
}
