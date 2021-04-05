<?php 

/**
 * Get the item title from a localization file
 * 
 * @param  object $model 
 * @return string
 */
if (!function_exists('cacheKey')) {
    function cacheKey($item, $prefix = 'select') : string
    {
        //We can pass the ClassName or directly the object (So we need to get the ClassName from the object)
        $item = is_object($item) 
            ? get_class($item)//ClassName from the object
            : $item;//ClassName directly
            
        return $prefix . '-' . md5($item);
    }
}