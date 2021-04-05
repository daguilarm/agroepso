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

        {{-- Form: create --}}
        @component(component_path('form'))
            @slot('formTitle', trans_choice('forms.default', 1))
            @slot('form')

                {{ html()
                    ->form('POST', route('dashboard.' . $section . '.geolocate.store'))
                    ->id('form-plot-create')
                    ->open()
                }}
                    {{-- Include the form --}}
                    @include('dashboard.' . $section . '.forms.geolocation_form')

                {{ html()->form()->close() }}

            @endslot
        @endcomponent

    </main>
@endsection
