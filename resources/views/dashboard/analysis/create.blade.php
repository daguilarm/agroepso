@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        {{-- Head title --}}
        @component(component_path('head'))
            {{-- Add new description --}}
            @slot('headItems', [
                //'icon' => null,
                //'title' => null,
                'description' => trans('sections/' . $section . '.forms.create'),
            ])
            {{-- Breadcrumb items --}}
            @slot('breadcrumbItems', [
                ['title' => trans_title($section, 'plural'), 'route' => route('dashboard.' . $section . '.index')],
                ['title' => trans('buttons.new')]
            ])
        @endcomponent

        @include(component_path('messages'))

        {{-- Form: create --}}
        @component(component_path('form'))
            @slot('formTitle', trans_choice('forms.default', 1))
            @slot('form')

                {{ html()
                    ->form('POST', route('dashboard.' . $section . '.store'))
                    ->id('form-create')
                    ->open() 
                }}

                    {{-- Include the form --}}
                    @include('dashboard.' . $section . '.forms._constructor')

                {{ html()->form()->close() }}
                
            @endslot
        @endcomponent
    </main>
@endsection