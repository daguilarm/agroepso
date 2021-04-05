<?php

$units = 'uds';

return [
    'crop.crop_name' => trans_title('crops'),
    'crop_variety.crop_variety_name' => trans_title('crop_varieties'),
    'plot_crop_quantity' => [
        'title' => sections('plots.units'),
        'extra_text' => $units,
    ],
    'pattern.pattern_name' => [
        'title' => trans_title('patterns'),
        'authorized' => true,
    ],
    'plot_crop_training' => [
        'title' => sections('crops.training'),
        'setValue' => trans('_config.training_types'),
        'authorized' => true,
    ],
    'plot_green_cover' => [
        'title' => sections('plots.green_cover'),
        'setValue' => trans('_config.boolean'),
        'authorized' => true,
    ],
];
