<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CropsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crops')->delete();

        DB::table('crops')->insert([
            [
                'id' => 1,
                'crop_name' => 'Viñedos',
                'crop_key' => '',
                'crop_description' => 'Cultivos de vid para vinificación.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 2,
                'crop_name' => 'Uva de Mesa',
                'crop_key' => '',
                'crop_description' => 'Cultivos de vid para uva de mesa',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 3,
                'crop_name' => 'Granada',
                'crop_key' => '',
                'crop_description' => 'Cultivos de granada',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 4,
                'crop_name' => 'Cereza',
                'crop_key' => '',
                'crop_description' => 'Cultivos de cereza',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 5,
                'crop_name' => 'Alcachofa',
                'crop_key' => '',
                'crop_description' => 'Cultivos de alcachofa',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
        ]);
    }
}
