@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        {{-- Head title --}}
        @component(component_path('head'))
            {{-- Head title --}}
             @slot('headItems', [
                'description' => sections($section . '.description-excel'),
            ])
            {{-- Breadcrumb items [title, link] --}}
            @slot('breadcrumbItems', [
                ['title' => trans_title($section, 'plural'), 'route' => route('dashboard.' . $section . '.index')],
                ['title' => trans('buttons.excel')]
            ])
        @endcomponent

        @component(component_path('excel'))
            {{-- Variables --}}
            @slot('thumbnail', 'users-excel.jpg')
            @slot('clients', $clients)
            @slot('file', 'users.xls')
            @slot('instructions', sections('users.excel.info'))
            @slot('customForms')
            {{-- custom form fields --}}
            @endslot
        @endcomponent
    </main>
@endsection
