<?php

namespace App\Console\Commands\MakeRepository\Traits;

use Illuminate\Support\Facades\Storage;

trait Files
{
    /**
     * Path to config file
     *
     * @var string
     */
    protected $config = 'Console/Commands/MakeRepository/Config.php';

    /**
     * Path to stub file
     *
     * @var string
     */
    protected $stubPath = 'app/Console/Commands/MakeRepository/stubs/';

    /**
     * Get the stub file.
     *
     * @param string $fileName ['controller', 'model',...]
     *
     * @return string
     */
    public function getStubTemplate($fileName = 'seed')
    {
        //Generate the global stub path
        $stub = $this->stubPath . $fileName . '.stub';

        //Get the stub template
        return Storage::disk($this->disk)->get($stub);
    }

    /**
     * Get the file from the Config.php
     *
     * @param string $type ['controller', 'model',...]
     *
     * @return string
     */
    public function getFile($type)
    {
        //The file path
        $pathToFile = app_path($this->config);

        //Get the value
        $value = data_get(include($pathToFile), $type);

        //Return the filter value
        return SELF::filter($value) . '.php';
    }
}
