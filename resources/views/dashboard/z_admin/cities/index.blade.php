@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        {{-- Head title --}}
        @component(component_path('head'))
            {{-- Head title --}}
             @slot('headItems', [
                'icon' => 'world',
            ])
            {{-- Breadcrumb items [title, link] --}}
            @slot('breadcrumbItems', [
                ['title' => trans_title($section, 'plural')]
            ])
        @endcomponent

        @include(component_path('messages'))

        {{-- Table --}}
        @component(component_path('table'))
            {{-- Add the operation buttons --}}
            @slot('operationLinks', [
                'create',
            ])
            {{-- Add the table --}}
            @slot('table', $table)
        @endcomponent
    </main>
@endsection