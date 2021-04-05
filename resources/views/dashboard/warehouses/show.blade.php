{!! Html::tabs([
    [
        'title' => sections('plants.table.general'),
        'content' => Info::table('warehouses')->render($data),
        'show' => true,
    ],
    [
        'title' => trans('system.observations'),
        'content' => $data->warehouse_observations,
        'show' => !empty($data->warehouse_observations),
    ],
]) !!}
