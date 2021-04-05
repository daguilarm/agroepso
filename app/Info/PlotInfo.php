<?php

$area = 'ha';
$meters = 'm';

return [
    'plot_ref' => trans('persona.id.id'),
    'plot_serial' => trans('system.code'),
    'plot_name' => trans_title('plots'),
    'plot_active' => [
        'title' => trans('persona.contact.active'),
        'setValue' => trans('_config.boolean'),
    ],
    'user.name' => trans_title('users'),
    'plant.plant_name' => [
        'title' => trans_title('plants'),
        'authorized' => getClient('module.plants'),
    ],
    'warehouse.warehouse_name' => [
        'title' => trans_title('warehouses'),
        'authorized' => getClient('module.warehouses'),
    ],
    'plot_area' => [
        'title' => trans('area.total'),
        'extra_text' => $area,
    ],
    'plot_percent_cultivated_land' => [
        'title' => sections('plots.cultivated_land'),
        'extra_text' => '%'
    ],
    'plot_real_area' => [
        'title' => sections('plots.real_area'),
        'extra_text' => $area
    ],
    'plot_framework_x' => [
        'title' => sections('plots.framework_x'),
        'extra_text' => $meters
    ],
    'plot_framework_y' => [
        'title' => sections('plots.framework_y'),
        'extra_text' => $meters
    ],
    'plot_pond' => [
        'title' => sections('plots.pond'),
        'setValue' => trans('_config.boolean'),
        'authorized' => true,
    ],
    'plot_road' => [
        'title' => sections('plots.road'),
        'setValue' => trans('_config.road'),
        'authorized' => true,
    ],
];
