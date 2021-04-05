<?php

/**
 * Return the position of a field in an array.
 *
 * @param array $array [The array to check]
 * @param string $field [The value to find into the array. Example: $array = ['url', 'name', 'casa'] will use get_position_in_array($array, 'casa')
 * @return string
 */
if (!function_exists('get_position_in_array')) {
    function get_position_in_array(array $array, string $field)
    {
        for ($x = 0; $x < count($array); $x++) {
            if ($field == $array[$x]) {
                return $x;
            }
        }
    }
}

/**
 * Return the array key for a position in the array
 *
 * @param array $array [The array to check]
 * @param int $position
 * @return string
 */
if (!function_exists('get_key_by_position')) {
    function get_key_by_position(array $array, int $position)
    {
        $position = $position - 1;

        return array_keys($array)[$position] ?? null;
    }
}

/**
 * Search wildcard in array
 *
 * @param string $search [The array to check]
 * @param array $array
 * @return bool
 */
if (!function_exists('in_array_wildcard')) {
    function in_array_wildcard(string $search, array $array)
    {
        $matches = [];
        foreach($array as $k => $v) {
            if(preg_match("/\b$search\b/i", $v)) {
                return true;
            }
        }
        return false;
    }
}

/**
 * Search wildcard in array
 *
 * @param string $search [The array to check]
 * @param array $array
 * @return bool
 */
if (!function_exists('rand_array_except')) {
    function rand_array_except(array $array, array $except)
    {
        do {
            $n = array_random($array);
        } while(in_array($n, $except));

        return $n;
    }
}
