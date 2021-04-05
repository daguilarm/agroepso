@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        {{-- Head title --}}
        @component(component_path('head'))
            {{-- Head title --}}
            {{-- @slot('headItems', [
                'icon' => null,
                'title' => null,
                'description' => null,
            ])--}}

            {{-- Breadcrumb items [title, link] --}}
            @slot('breadcrumbItems', [
                //['title' => trans_title($section), 'route' => route('dashboard.' . $section . '.index')],
                ['title' => trans_title($section, 'plural')]
            ])
        @endcomponent

        @include(component_path('messages'))

        {{-- Table --}}
        @component(component_path('table'))
            {{-- Add the operation buttons --}}
            @slot('operationLinks', [
                'dropdown' => [
                    conditional_array('<a class="dropdown-item" href="' . Html::urlToCreate($section) .'" id="button-create">' . icon('new', trans('buttons.new')) .'</a>', auth()->user()->can('create plot')),
                    conditional_array('<a class="dropdown-item" href="#" id="button-print" data-title="' . ($headItems['description'] ?? trans_description($section)) . '">' . icon('print', trans('buttons.print')) . '</a>'),
                    conditional_array('<a class="dropdown-item" href="' . route('dashboard.' . $section . '.excel') .'" id="button-excel">' . icon('upload', trans('excel.title')) . '</a>', auth()->user()->can('create plot')),
                    conditional_array('<a class="dropdown-item" href="' . route('dashboard.' . $section . '.download') .'" id="button-excel">' . icon('download', trans('excel.download')) . '</a>', auth()->user()->can('create plot')),
                    conditional_array('<a class="dropdown-item" href="' . route('dashboard.' . $section . '.excel') .'" id="button-reset" data-toggle="modal" data-target="#modal-reset">' . icon('refresh', 'Resetear parcelas') . '</a>', auth()->user()->can('reset plot')),
                ],
            ])
            {{-- Add the table --}}
            @slot('table', $table)
        @endcomponent
    </main>
@endsection

{{-- Add the modals --}}
@section('modals')
    @include(modal_path('info'))
    {{-- Load reset --}}
    @include(modal_path('reset'))
    @if(auth()->user()->can('reset plot') && getClient('option.plot-reset'))
        @include(modal_path('reset'))
    @endif
@endsection

{{-- Add the maps --}}
@section('leaflet')
    @include(dashboard_path('_layouts.leaflet'))
@endsection
