<?php

// Form::footerButtons() => Edit, cancel and create (pack of buttons!)
// Form::createButtons()
// Form::editButtons()
// Form::cancelButtons()
// Form::excelButtons() => Create the excel upload button

/**
 * Generate the footer form
 * Buttons: edit, create, cancel
 * Mandatories message
 * Hidden item id field
 *
 * @return string
 */
Form::macro('footerButtons', function($data = null, $hidden = null)
{
    //Default button: create
    $button = Form::createButtons();

    //Edit button
    if(isset($data)) {
        $button = Form::editButtons();
        $hidden = html()->hidden('itemID', $data->id);
    }

    return sprintf('%s %s <div class="my-4" id="mandatory-msg">%s</div>', $hidden, $button, trans('forms.mandatory'));
});

/**
 * Generate the form create buttons
 *
 * @return string
 */
Form::macro('createButtons', function()
{
    return sprintf(
        '<div class="text-center my-5">' .
            '%s' .
            '<button type="subtmit" class="btn btn-success ml-3">%s</button>' .
        '</div>',
        Form::cancelButtons(),
        icon('new', trans('buttons.new'))
    );
});

/**
 * Generate the form edit buttons
 *
 * @return string
 */
Form::macro('editButtons', function()
{
    return sprintf(
        '<div class="text-center my-5">' .
            '%s' .
            '<button type="subtmit" class="btn btn-warning ml-3">%s</button>' .
        '</div>',
        Form::cancelButtons(),
        icon('edit', trans('buttons.edit'))
    );
});

/**
 * Generate the form cancel buttons
 *
 * @return string
 */
Form::macro('cancelButtons', function()
{
    return sprintf('<a class="btn btn-default" href="javascript:history.back();">%s</a>', icon('cancel', trans('buttons.cancel')));
});

/**
 * Generate the form create buttons
 *
 * @return string
 */
Form::macro('excelButtons', function()
{
    return sprintf(
        '<div class="text-center my-5">' .
            '<button type="subtmit" class="btn btn-success ml-3">%s</button>' .
        '</div>',
        icon('upload', trans('buttons.excel'))
    );
});

/**
 * Generate the form show button
 *
 * @return string
 */
Form::macro('showButtons', function()
{
    return '<div class="text-center my-5">' .
                sprintf('<a class="btn btn-info" href="javascript:history.back();">%s</a>', icon('reset', trans('buttons.back'))) .
            '</div>';
});
