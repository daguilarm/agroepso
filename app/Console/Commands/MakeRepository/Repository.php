<?php

namespace App\Console\Commands\MakeRepository;

use App\Console\Commands\MakeRepository\Constructor;

class Repository extends Constructor
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {repoName}  {--only=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a full repository structure: models, folders, traits, repository,...';

    /**
     * Storage disk
     *
     * @var string
     */
    protected $disk = 'base';

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
        $option = $this->option('only') ?? 'all';

        $this->generate($option);
    }
}
