<?php

// Form::formTitle()
// Form::autoTextArea()
// Form::autoIncrement() => Generate a input with autoincrement value (base on table name => table_ref)

/**
 * Generate the form title
 *
 * @param  string $icon
 * @param  string $title
 * @return string
 */
Form::macro('formTitle', function($icon = null, $title)
{
    $html = '<div class="col-12">' .
            '<h3 class="tile-title text-secondary">%s</h3>' .
        '</div>';

    $text = $icon ? icon($icon, $title) : $title;

    return sprintf($html, $text);
});

/**
 * Generate a input-group
 * @param string $textareaName
 * @param int $maxLength
 * @param int $rows
 *
 * @return  string
 */
Form::macro('autoTextArea', function($textareaName, $required = false, $maxLength = 250, $rows = 5, $disabled = false)
{
    //Html textarea
    $textarea = html()->textarea($textareaName)->attributes(['rows' => $rows, 'maxlength' => $maxLength])->class('form-control');
    $textarea = $required ? $textarea->required() : $textarea;

    //Disabled
    if($disabled) {
        $textarea = $textarea->attributes(['disabled' => $disabled]);
    }

    //Generate the complete textarea
    return sprintf('%s<div class="ml-1 mt-2" id="textareaAlert-%s"></div>', $textarea, $textareaName);
});

/**
 * Generate a input with autoincrement value (base on table name)
 * @param string $textareaName
 * @param int $rows
 *
 * @return  string
 */
Form::macro('autoIncrement', function($type = 'plot', $data = null, $required = true)
{
    $field = $type . '_ref';
    $value = optional($data)->$field ?? getReferenceFromClient($type, Credentials::client());

    //Html textarea
    return html()
        ->text($field)
        ->class('form-control text-right')
        ->value($value)
        ->attribute('maxlength', ref_length())
        ->required($required);
});
