<?php 

namespace App\Services\Icons\Fonts\Awesome;

use App\Services\Icons\IconsInterface;

class IconBuilder implements IconsInterface {

    /** 
    * @var string    
    */  
    public $folder       = 'Awesome';
    public $repository   = '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';

    /**
     * Generate the html content
     * 
     * @param string $icon
     * @param string $class
     * 
     * @return string
     */
    public function htmlBuilder(string $icon, $class = '', $prefix = 'fa') : string
    {
        //New js prefix filter
        $check = explode(':', $icon);
        if(count($check) > 1) {
            $prefix = $check[0];
            $icon = $check[1];
        }
        
        return sprintf('<i class="icon %s fa-%s %s" aria-hidden="true"></i>', $prefix, $icon, $class);
    }
}