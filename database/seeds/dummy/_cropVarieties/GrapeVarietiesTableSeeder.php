<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model\Install;
use Carbon\Carbon;

class GrapeVarietiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Create on: 28-09-2015
     *
     * @return void
     */
    public function run()
    {
        DB::table('crop_varieties')->insert([
            ['crop_id' => 2, 'crop_variety_name' => 'Ejemplo 1', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'crop_variety_name' => 'Ejemplo 2', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'crop_variety_name' => 'Ejemplo 3', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'crop_variety_name' => 'Ejemplo 4', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        ]);
    }
}
