<?php

/**
 * Clear an address from special chars
 *
 * @param string $address
 * @return string
 */
if (!function_exists('clear_address')) {
    function clear_address(string $address) : string
    {
        return preg_replace('/[\r\n|\n|\r]+/', ' ', $address);
    }
}

/**
 * Format the text to be located in a table cell
 *
 * @param string $text
 * @param int $limit
 * @return string
 */
if (!function_exists('format_text')) {
    function format_text($text = null, int $limit = 15)
    {
        if (isset($text) && (strlen($text) >= $limit)) {
            $str = explode( "\n", wordwrap($text, $limit));

            return trim(implode(' <br>', $str));
        }
        //
        return trim($text);
    }
}

/**
 * Format the text to 0000X if the value is numeric
 *
 * @param string $value
 * @return string
 */
if (!function_exists('format_ref')) {
    function format_ref($value)
    {
        return is_numeric($value) ? str_pad($value, 5, "0", STR_PAD_LEFT) : $value;
    }
}

/**
 * Calculate the city number base on INE from the sigpac
 *
 * @param integer $sigpacRegion
 * @param integer $sigpacCity
 * @return string
 */
if (!function_exists('cityINE')) {
    function cityINE($sigpacRegion, $sigpacCity)
    {
        return  str_pad($sigpacRegion, 2, "0", STR_PAD_LEFT) . str_pad($sigpacCity, 3, "0", STR_PAD_LEFT);
    }
}

/**
 * Filter and sanitize a string
 *
 * @param string $string
 * @param string $type ['email', 'url', 'integer', 'float', string', 'date']
 * @return string
 */
if (!function_exists('str_filter')) {
    function str_filter($string, $type = 'string')
    {
        if($type === 'email') {
            return filter_var($string, FILTER_VALIDATE_EMAIL);
        }

        if($type === 'url') {
            return filter_var($string, FILTER_VALIDATE_URL);
        }

        if($type === 'integer') {
            return filter_var($string, FILTER_VALIDATE_INT);
        }

        if($type === 'float') {
            $string = str_replace(['.', ','], '', $string);
            return calc_number($string);
        }

        if($type === 'date') {
            return format_date($string);
        }

        return filter_var($string, FILTER_SANITIZE_STRING);
    }
}

/**
 * Max character length allowed for the _ref field
 *
 * @param int $length
 * @return int
 */
if (!function_exists('ref_length')) {
    function ref_length(int $length = 10) : int
    {
        return $length;
    }
}

/**
 * Highlight text
 *
 * @param int $text
 * @return int
 */
if (!function_exists('highlight_text')) {
    function highlight_text(string $text) : string
    {
        return sprintf('<span class="alert table-danger p-1 m-0 font-weight-bold">%s</span>', $text);
    }
}

/**
 * Conditional html/text to array
 *
 * @param int $text
 * @param int $condition
 * @return int
 */
if (!function_exists('conditional_array')) {
    function conditional_array($text, $condition = true)
    {
        if(!is_array($text)) {
            $text = [$text];
        }

        return $condition
            ? $text
            : null;
    }
}
