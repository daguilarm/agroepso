<?php

//For testing...
//php artisan make:dracarys --env=dusk

namespace App\Console\Commands\MakeDracarys;

use Illuminate\Console\Command;
use App, Artisan;

class Dracarys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dracarys';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate refresh and seed for the testing database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        $this->line('Your <fg=green>Database\Migrations\Seeds<fg=green> for the testing enviroment was a success!!!!'); 
    }
}
