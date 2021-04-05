<?php

use App\Models\CropVarieties\CropVariety;

/**
 * Select crop
 * App\Jobs\CreatePlotsFromExcel
 *
 * @param string $textareaName
 * @param int $maxLength
 * @param int $rows
 *
 * @return  string
 */
Form::macro('selectClientToCrop', function($select = '<option></option>', $total = 0)
{
    //Admin and Admin-gv case:
    if(Credentials::isAdmin() || Credentials::isAdminValencia()) {
        $select = html()->select('crop_variety_id')->options([])->class('form-control');
        $total++;

    //Dop case
    } else {
        //List all the varieties with the type as data
        $varieties = app(CropVariety::class)
            ->lists(Credentials::crop())
            ->map(function($value) {
                return sprintf('<option value="%s" data-crop="%s" data-type="%s">%s</option>', $value->id, $value->crop_id, $value->crop_variety_type, $value->crop_variety_name);
            });

        $total = $varieties->count();
        $select = sprintf('<select name="crop_variety_id" id="crop_variety_id">%s</select>', $varieties->implode(''));
    }

    //Generate the html if there is results
    if($total) {
        $labelTitle = sprintf('%s (%s)', trans_title('crop_varieties'), trans('system.optional'));
        $label = sprintf('<label for="crop_id" class="control-label">%s</label>', $labelTitle);
        $helpBlock = sprintf('<small id="passwordHelpBlock" class="form-text text-muted">%s</small>', sections('plots.forms.alert'));

        return sprintf('<div class="form-group col-12 col-md-4 mb-5">%s%s%s</div>', $label, $select, $helpBlock);
    }

    return null;
});
