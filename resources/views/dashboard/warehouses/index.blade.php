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
                'create',
                'print',
            ])
            {{-- Add the table --}}
            @slot('table', $table)
        @endcomponent
    </main>
@endsection

{{-- Add the modals --}}
@section('modals')
    @include(modal_path('info'))
@endsection
