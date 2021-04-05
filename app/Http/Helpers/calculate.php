<?php

/**
 * Return the position of a field in an array.
 *
 * @param integer $area [The total area]
 * @param integer $percent [The percent from total]
 * @return integer
 */
if (!function_exists('calc_percent')) {
    function calc_percent(int $area, int $percent) : int
    {
        return ($area * $percent) / 100;
    }
}

/**
 * Calculate the trees per area base on the framework
 *
 * @param integer $area [The total area]
 * @param integer $framework_x
 * @param integer $framework_y
 * @return integer
 */
if (!function_exists('calc_framework')) {
    function calc_framework(int $area, int $framework_x, int $framework_y) : int
    {
        return $area / ($framework_x * $framework_y);
    }
}

/**
 * Calculate a number with x decimals
 *
 * @param integer $number
 * @param integer $decimals
 * @return integer
 */
if (!function_exists('calc_number')) {
    function calc_number($number, int $decimals = 2) : float
    {
        return number_format(calc_sanitize($number), $decimals, '.', '');
    }
}

/**
 * Sanitize a number
 *
 * @param integer $number
 * @return integer
 */
if (!function_exists('calc_sanitize')) {
    function calc_sanitize($number)
    {
        return trim(str_replace(',', '.', $number));
    }
}
