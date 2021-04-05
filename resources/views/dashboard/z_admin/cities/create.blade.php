@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        {{-- Head title --}}
        @component(component_path('head'))
            {{-- Add new description --}}
            @slot('headItems', [
                'icon' => 'world',
                'description' => trans('sections/' . $section . '.forms.create'),
            ])
            {{-- Breadcrumb items --}}
            @slot('breadcrumbItems', [
                ['title' => trans_title($section), 'route' => route('dashboard.tools.' . $section . '.index')],
                ['title' => trans('buttons.new')]
            ])
        @endcomponent

        @include(component_path('messages'))

        {{-- Form: create --}}
        @component(component_path('form'))
            @slot('formTitle', trans_choice('forms.default', 1))
            @slot('form')

                {{ html()
                    ->form('POST', route('dashboard.tools.' . $section . '.store'))
                    ->id('form-create')
                    ->open() 
                }}

                    {{-- Include the form --}}
                    @include('dashboard.z_admin.' . $section . '.forms._constructor')

                {{ html()->form()->close() }}
                
            @endslot
        @endcomponent
    </main>
@endsection