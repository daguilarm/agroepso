<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model\Install;
use Carbon\Carbon;

class VineyardPatternsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patterns')->insert([
            ['crop_id' => 1, 'pattern_name' => '1 Blachard', 'pattern_reference' => 17030014, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '101 14 Millardet Grasset', 'pattern_reference' => 17030019, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '110 Ritcher', 'pattern_reference' => 17030001, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '1103 Paulsen', 'pattern_reference' => 17030010, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '13 5 Eve Jerez', 'pattern_reference' => 17030017, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '140 Ruggeri', 'pattern_reference' => 17030020, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '161 49 Couderc', 'pattern_reference' => 17030005, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '1616 Couderc', 'pattern_reference' => 17030022, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '19 62 Millardet Grasset', 'pattern_reference' => 17030008, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '196 17 Castel', 'pattern_reference' => 17030004, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '31 Ritcher', 'pattern_reference' => 17030018, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '3309 Couderc', 'pattern_reference' => 17030006, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '333 Escuela de Montpellier', 'pattern_reference' => 17030021, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '41 B Millardet Grasset', 'pattern_reference' => 17030007, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '420 Millardet Grasset', 'pattern_reference' => 17030009, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '5 A Martinez Zaporta', 'pattern_reference' => 17030015, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '5 BB Teleki Kober', 'pattern_reference' => 17030016, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '6736 Castel', 'pattern_reference' => 17030003, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => '99 Ritcher', 'pattern_reference' => 17030002, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => 'Fercal', 'pattern_reference' => 20000154, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => 'Ressegier Selec Birolleau Nº1', 'pattern_reference' => 17030023, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => 'Riparia Gloria de Montpellier', 'pattern_reference' => 17030024, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => 'Rupestris de Lot', 'pattern_reference' => 17030012, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['crop_id' => 1, 'pattern_name' => 'Selec. Oppenheim de Telek Nº4', 'pattern_reference' => 17030013, 'created_at' => new DateTime, 'updated_at' => new DateTime]
        ]);
    }
}
