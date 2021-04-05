<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model\Install;
use Carbon\Carbon;

class GrapePatternsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patterns')->insert([
            ['crop_id' => 2, 'pattern_name' => '1 Blachard', 'pattern_reference' => 17030014, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pattern_name' => '101 14 Millardet Grasset', 'pattern_reference' => 17030019, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pattern_name' => '110 Ritcher', 'pattern_reference' => 17030001, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pattern_name' => '1103 Paulsen', 'pattern_reference' => 17030010, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 2, 'pattern_name' => '13 5 Eve Jerez', 'pattern_reference' => 17030017, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        ]);
    }
}
