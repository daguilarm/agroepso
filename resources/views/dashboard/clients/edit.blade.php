@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        {{-- Head title --}}
        @component(component_path('head'))
            {{-- Add new description --}}
            @slot('headItems', [
                'description' => trans('sections/' . $section . '.forms.update'),
            ])
            {{-- Breadcrumb items --}}
            @slot('breadcrumbItems', [
                ['title' => trans_title($section), 'route' => route('dashboard.' . $section . '.index')],
                ['title' => trans('buttons.edit')]
            ])
        @endcomponent

        @include(component_path('messages'))

        {{-- Form: Edit --}}
        @component(component_path('form'))
            @slot('formTitle', trans_choice('forms.default', 1))
            @slot('form')

                {{ html()
                    ->modelForm($data, 'PATCH', route('dashboard.' . $section . '.update', $data->id))
                    ->id('form-edit')
                    ->attribute('enctype', 'multipart/form-data')
                    ->open() 
                }}

                    {{-- Include the form --}}
                    @include('dashboard.' . $section . '.forms._constructor')

                {{ html()->closeModelForm() }}

            @endslot
        @endcomponent
    </main>
@endsection