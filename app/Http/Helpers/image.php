<?php

/**
 * Create a date with the spanish fomart
 *
 * @param  string $image
 * @return string
 */
if (!function_exists('getLabel')) {
    function getLabel($dns, $number, $format)
    {
        return call_user_func_array($dns . '::getBarcodeSVG', [$number, $format]);
    }
}
