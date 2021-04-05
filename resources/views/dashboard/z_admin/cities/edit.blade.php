@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        {{-- Head title --}}
        @component(component_path('head'))
            {{-- Add new description --}}
            @slot('headItems', [
                'icon' => 'world',
                'description' => trans('sections/' . $section . '.forms.update'),
            ])
            {{-- Breadcrumb items --}}
            @slot('breadcrumbItems', [
                ['title' => trans_title($section), 'route' => route('dashboard.tools.' . $section . '.index')],
                ['title' => trans('buttons.edit')]
            ])
        @endcomponent

        @include(component_path('messages'))

        {{-- Form: Edit --}}
        @component(component_path('form'))
            @slot('formTitle', trans_choice('forms.default', 1))
            @slot('form')

                {{ html()
                    ->modelForm($data, 'PATCH', route('dashboard.tools.' . $section . '.update', $data->id))
                    ->id('form-edit')
                    ->open() 
                }}

                    {{-- Include the form --}}
                    @include('dashboard.z_admin.' . $section . '.forms._constructor')

                {{ html()->closeModelForm() }}

            @endslot
        @endcomponent
    </main>
@endsection