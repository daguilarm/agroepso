{{-- Legend --}}
@component(component_path('legend'))
    @slot('legends', [
        [
            'icon' => '<button class="btn btn-sm btn-info">' . icon('print') . '</button>',
            'text' => trans('legends.print'),
        ],
        [
            'icon' => '<button class="btn btn-sm btn-terciary">' . icon('new') . '</button>',
            'text' => trans('legends.new'),
        ],
        [
            'icon' => '<button class="btn btn-sm btn-warning">' . icon('download') . '</button>',
            'text' => trans('legends.excel'),
        ],
        ['divider' => true],
        [
            'icon' => '<button class="btn btn-sm btn-warning">' . icon('edit') . '</button>',
            'text' => trans('legends.edit'),
        ],
        [
            'icon' => '<button class="btn btn-sm btn-danger">' . icon('delete') . '</button>',
            'text' => trans('legends.delete'),
        ],
    ])
@endcomponent
