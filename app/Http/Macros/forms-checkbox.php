<?php

// Form::autoCheckBoxPermissions() => Generate an auto checkbox for permissions (custom)
// Form::autoCheckBox() => Generate an auto checkbox (generic)

/**
 * Generate an auto checkbox for permissions
 *
 * @param  string $completListOfValues [All the values from the database]
 * @param  string $valuesSelected [The values for the current item]
 * @param string $html
 * @return string
 */
Form::macro('autoCheckBoxPermissions', function($completListOfValues, $valuesSelected, $html = '', $x = 1)
{
    foreach($completListOfValues as $value) {
        $checked = in_array($value->name, $valuesSelected->all());
        $item = html()->checkbox('permissions' . '[]', 'permissions', $value->name)->id('permissions' . '-' . $x)->checked($checked);
        $html .= sprintf('<div class="float-left input-group col-3">%s <div class="ml-2 mt-2">%s</div></div>', $item, $value->name);
        $x++;
    }
    return $html;
});

/**
 * Generate an auto checkbox generic
 *
 * @param  string $completListOfValues [All the values from the database]
 * @param  string $valuesSelected [The values for the current item]
 * @param string $html
 * @return string
 */
Form::macro('autoCheckBox', function($completListOfValues, $valuesSelected, $checkBoxName, $fieldName, $html = '', $x = 1)
{
    foreach($completListOfValues as $value) {
        $checked = in_array($value->id, $valuesSelected->all());
        $item = html()->checkbox($checkBoxName . '[]', $checkBoxName, $value->id)->id($checkBoxName . '-' . $x)->checked($checked);
        $html .= sprintf('<div class="float-left input-group col-3">%s <div class="ml-2 mt-2">%s</div></div>', $item, $value->$fieldName);
        $x++;
    }
    return $html;
});
