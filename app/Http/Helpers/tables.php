<?php

/**
 * Return the position of a field in an array.
 *
 * @param array $array [The array to check]
 * @param string $field [The value to find into the array. Example: $array = ['url', 'name', 'casa'] will use get_position_in_array($array, 'casa')
 * @return string
 */
if (!function_exists('table_row')) {
    function table_row(array $array, string $field)
    {
        for ($x = 0; $x < count($array); $x++) {
            if ($field == $array[$x]) {
                return $x;
            }
        }
    }
}

/**
 * Return the colored cell and the text sentence
 *
 * @param array $value
 * @param string $field
 * @return string
 */
if (!function_exists('table_color_filter')) {
    function table_color_filter($value, string $field)
    {
        $container = '%s';

        if($value == 1) {
            $container = '<span class="alert table-danger">%s</span>';
        }
        if($value == 2) {
            $container = '<span class="alert table-warning">%s</span>';
        }
        if($value == 3) {
            $container = '<span class="alert table-success">%s</span>';
        }

        $value = configurationValue($field, $value);

        return [$value, $container];
    }
}
