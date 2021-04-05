<?php

$units = 'uds';

return [
    'plot_quality_igp' => [
        'title' => trans('quality.igp.under'),
        'authorized' => getClient('option.plot-igp'),
        'setValue' => trans('_config.boolean'),
    ],
    'plot_quality_dop' => [
        'title' => trans('quality.dop.under'),
        'authorized' => getClient('option.plot-dop'),
        'setValue' => trans('_config.boolean'),
    ],
];
