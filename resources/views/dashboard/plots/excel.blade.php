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
            @slot('thumbnail', 'plots-excel.jpg')
            @slot('clients', $clients)
            @slot('file', 'plots.xls')
            @slot('instructions', sections('plots.excel.info'))
            @slot('customForms')
                {{-- Select the client to get the crop --}}
                {!! Form::selectClientToCrop() !!}

                {{-- The crop variety --}}
                {{ html()->hidden('crop_variety_type') }}

                {{-- Add crop base on role --}}
                @hasanyrole('admin')
                    {{ html()->hidden('crop_id') }}
                @else
                    {{ html()->hidden('crop_id')->value(Credentials::crop()) }}
                @endhasanyrole
            @endslot
        @endcomponent
    </main>
@endsection
