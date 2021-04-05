<?php

/**
 * Get the select array from config file and prepare for FORM > SELECT
 *
 * @param  string $item
 * @param  bool $emptyField
 * @return string
 */
if (!function_exists('configuration')) {
    function configuration(string $item, $emptyField = false)
    {
        $text = array_sort(trans('_config.' . $item));

        return $emptyField
            ? ['' => ''] + $text
            : $text;
    }
}

/**
 * Get the select array from config file and prepare for FORM > SELECT
 *
 * @param  string $item
 * @param  mixed $value
 * @return string
 */
if (!function_exists('configurationValue')) {
    function configurationValue(string $item, $value)
    {
        return configuration($item)[$value] ?? null;
    }
}

/**
 * Get the select array for the boolean values
 *
 * @return string
 */
if (!function_exists('selectBoolean')) {
    function selectBoolean($value = null, $toString = false)
    {
        if($value) {
            return configurationValue('boolean', $value);
        }

        if($toString) {
            return formatConfigurationItem('boolean');
        }

        return ['' => ''] + configuration('boolean');
    }
}

/**
 * Return an array with the boolean values ['yes', 'not']. Its use (mostly) for validation.
 *
 * @return string
 */
if (!function_exists('booleanValues')) {
    function booleanValues()
    {
        return array_values(configuration('boolean'));
    }
}

/**
 * Get the select array for the road values
 *
 * @return string
 */
if (!function_exists('selectRoad')) {
    function selectRoad($value = null, $toString = false)
    {
        if($value) {
            return configurationValue('road', $value);
        }

        if($toString) {
            return formatConfigurationItem('road');
        }

        return ['' => ''] + configuration('road');
    }
}

/**
 * Get the select array for the inspections types values
 *
 * @return string
 */
if (!function_exists('selectInspectionType')) {
    function selectInspectionType($value = null)
    {
        if($value) {
            return configurationValue('inspection_type', $value);
        }

        return ['' => ''] + configuration('inspection_type');
    }
}

/**
 * Get the select array for the inspections status values
 *
 * @return string
 */
if (!function_exists('selectInspectionResult')) {
    function selectInspectionResult($value = null)
    {
        if($value) {
            return configurationValue('inspection_result', $value);
        }

        return ['' => ''] + configuration('inspection_result');
    }
}

/**
 * Get the select array for the status values
 *
 * @return string
 */
if (!function_exists('selectInspectionStatus')) {
    function selectInspectionStatus($value = null)
    {
        if($value) {
            return configurationValue('inspection_status', $value);
        }

        return ['' => ''] + configuration('inspection_status');
    }
}

/**
 * Get the select array for the boolean values
 *
 * @return string
 */
if (!function_exists('selectTraining')) {
    function selectTraining($value = null, $toString = false)
    {
        if($value) {
            return configurationValue('training_types', $value);
        }

        if($toString) {
            return formatConfigurationItem('training_types');
        }

        return ['' => ''] + configuration('training_types');
    }
}

/**
 * Get the select array for the boolean values
 *
 * @return string
 */
if (!function_exists('selectUnits')) {
    function selectUnits($value = null, $toString = false)
    {
        if($value) {
            return configurationValue('units', $value);
        }

        if($toString) {
            return formatConfigurationItem('units');
        }

        return configuration('units');
    }
}

/**
 * Format a configuration item ['array', 'string']
 *
 * @param string $item [Value for the function configuration($item)]
 * @return string
 */
if (!function_exists('formatConfigurationItem')) {
    function formatConfigurationItem($item = null, $isArray = true)
    {
        if(empty($item)) {
            return null;
        }

        if($isArray) {
            $item = implode(', ', configuration($item));
        }

        return sprintf('<span class="alert alert-info p-1 font-weight-bold">%s</span>', $item);
    }
}
