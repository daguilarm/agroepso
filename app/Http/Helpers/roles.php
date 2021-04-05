<?php 

/**
 * Get all the allowed roles
 * 
 * @return string
 */
if (!function_exists('get_roles')) {
    function get_roles()
    {
        return configuration('roles');
    }
}