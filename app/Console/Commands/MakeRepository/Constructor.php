<?php

namespace App\Console\Commands\MakeRepository;

use App\Console\Commands\MakeRepository\Traits\Files;
use App\Console\Commands\MakeRepository\Traits\Filters;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

abstract class Constructor extends Command
{
    use Filters, Files;

    /**
     * generate all the repository files
     *
     * @param string $type ['controller', 'model',...]
     * 
     * @return mixed
     */
    public function generate(string $type)
    {
        //Generate all the files: default method
        if($type === 'all') {
            $files = include(app_path($this->config));
            foreach($files as $key => $value) {
                $this->generateFile($key);
            }
        //Generate a target file
        } else {
            $this->generateFile($type);
        }
    }

    /**
     * Generate the target repository file
     *
     * @param string $type ['controller', 'model',...]
     * 
     * @return mixed
     */
    public function generateFile($type)
    {
        $storagePath    = SELF::getFile($type);
        $stubTemplate   = SELF::getStubTemplate($type);

        return Storage::disk($this->disk)
            ->put($storagePath, $stubTemplate);
    }
}