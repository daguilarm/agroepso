{!! Html::tabs([
    [
        'title' => sections('plants.table.general'),
        'content' => Info::table('plants')->render($data),
        'show' => true,
    ],
    [
        'title' => sections('plants.table.production'),
        'content' => Info::table('plants')->subfix('_alt')->render($data),
        'show' => (Info::total($section, $data, 'subfix:_alt') > 0),
    ],
    [
        'title' => trans('system.observations'),
        'content' => $data->plant_observations,
        'show' => !empty($data->plant_observations),
    ],
]) !!}
