<?php 

namespace App\Services\Icons;

interface IconsInterface {

    /**
     * Generate the html content
     * 
     * @param string $icon
     * @param string $class
     * 
     * @return string
     */
    public function htmlBuilder(string $icon, $class = '') : string;
}