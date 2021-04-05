{{-- Default data --}}
{!! Html::tabs([
    [
        'title' => trans_title('plots'),
        'content' => view(dashboard_path($section . '.forms.default'))->withData($data ?? null),
        'show' => true,
    ],
    [
        'title' => trans_title('crops'),
        'content' => view(dashboard_path($section . '.forms.crop'))->withData($data ?? null),
        'show' => true,
    ],
    [
        'title' => trans('system.quality'),
        'content' => view(dashboard_path($section . '.forms.quality'))->withData($data ?? null),
        'show' => true,
    ],
    [
        'title' => trans('geolocation.default'),
        'content' => view(dashboard_path($section . '.forms.geolocation')),
        'show' => true,
    ],
]) !!}

{{-- Form footer --}}
{!! Form::footerButtons($data ?? null) !!}

