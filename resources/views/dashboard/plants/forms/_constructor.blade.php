{{-- Default data --}}

{!! Html::tabs([
    [
        'title' => sections('plants.table.general'),
        'content' => view(dashboard_path($section . '.forms.default'), compact('clients'))->withData($data ?? null),
        'show' => true,
    ],
    [
        'title' => sections('plants.table.production'),
        'content' => view(dashboard_path($section . '.forms.alternate'))->withData($data ?? null),
        'show' => true,
    ],
    [
        'title' => trans('system.observations'),
        'content' => view(dashboard_path($section . '.forms.observations'))->withData($data ?? null),
        'show' => true,
    ],
]) !!}

{{-- Form footer --}}
{!! Form::footerButtons($data ?? null) !!}
