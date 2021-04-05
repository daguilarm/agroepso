<?php

/**
 * Get the item title from a localization file
 *
 * @param  string $item
 * @param  string $type
 * @param  string $folder
 * @return string
 */
if (!function_exists('trans_title')) {
    function trans_title(string $item, string $type = 'singular', $folder = 'sections')
    {
        $item = $folder ? 'sections/' . $item : $item;

        if($type === 'singular') {
            return trans_choice($item . '.default', 1);
        }
        return trans_choice($item . '.default', 0);
    }
}

/**
 * Get the item description from a localization file
 *
 * @param  string $section
 * @param  string $folder
 * @param  string
 */
if (!function_exists('trans_description')) {
    function trans_description(string $section, $folder = 'sections')
    {
        $section = $folder ? 'sections/' . $section : $section;

        return trans($section . '.description');
    }
}

/**
 * Get the item title from a localization file
 *
 * @param  string $item
 * @return string
 */
if (!function_exists('sections')) {
    function sections(string $item)
    {
        return trans('sections/' . $item);
    }
}

/**
 * Get the configuration array list
 *
 * @param  string $item
 * @return string
 */
if (!function_exists('configuration')) {
    function configuration(string $item)
    {
        $item = $folder ? 'sections/' . $item : $item;

        return trans('sections/' . $item);
    }
}
