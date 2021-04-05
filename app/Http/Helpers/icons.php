<?php 

/**
 * Get the item title from a localization file
 * 
 * @param  string $item 
 * @param  string $type 
 * @param  string $folder 
 * 
 * @return string
 */
if (!function_exists('icon')) {
    function icon(string $icon, $text = null, $class = null)
    {
        $icon = (new App\Services\Icons\IconsClass)->get($icon, $class);

        return $text ? $icon . ' ' . $text : $icon;
    }
}