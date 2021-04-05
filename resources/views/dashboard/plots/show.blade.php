{!! Html::tabs([
    [
        'title' => trans_title('plots'),
        'content' => Info::table('plots')->render($data),
        'show' => true,
    ],
    [
        'title' => trans_title('crops'),
        'content' => Info::file('PlotCropInfo')->render($data),
        'show' => true,
    ],
    [
        'title' => trans('system.quality'),
        'content' => Info::file('PlotQualityInfo')->render($data),
        'show' => true,
    ],
    [
        'title' => trans('geolocation.default'),
        'content' => Info::file('PlotGeolocationInfo')->render($data),
        'show' => true,
    ],
]) !!}
