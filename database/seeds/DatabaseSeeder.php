<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Default
         */
        $this->call(RolesTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PlantsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CropsTableSeeder::class);
        $this->call(BiocidesTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(ClientsConfigurationsTableSeeder::class);
        /**
         * Crops varieties
         */
        $this->call(VineyardVarietiesTableSeeder::class);
        $this->call(GrapeVarietiesTableSeeder::class);
        /**
         * Patterns
         */
        $this->call(VineyardPatternsTableSeeder::class);
        $this->call(GrapePatternsTableSeeder::class);
        /**
         * Pests
         */
        $this->call(VineyardPestsTableSeeder::class);
        $this->call(GrapePestsTableSeeder::class);
        /**
         * Plots
         */
        $this->call(PlotsTableSeeder::class);
    }
}
