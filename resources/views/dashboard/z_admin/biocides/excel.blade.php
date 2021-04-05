@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        {{-- Head title --}}
        @component(component_path('head'))
            {{-- Breadcrumb items [title, link] --}}
            @slot('breadcrumbItems', [
                ['title' => trans_title($section, 'plural'), 'route' => route('dashboard.tools.' . $section . '.index')],
                ['title' => sections('biocides.options.default')]
            ])
        @endcomponent

        @include(component_path('messages'))

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        {{ html()
                            ->form('POST', route('dashboard.tools.' . $section . '.excel'))
                            ->id('form-options')
                            ->open()
                        }}

                            <ol class="options">
                                <li>
                                    {{ trans('sections/biocides.options.download') }}
                                    <a href="{{ route('dashboard.tools.biocides.excel.download') }}" class="btn btn-info btn-lg mx-3">
                                        {!! icon('download', trans('buttons.download')) !!}
                                    </a>
                                </li>
                                <li>
                                    {!! sections('biocides.options.storage') !!}
                                </li>
                                <li>
                                    {!! trans('sections/biocides.options.folder', [
                                        'folder' => '<b>storage/app/download</b>',
                                    ]) !!}
                                </li>
                                <li>
                                    {!! sections('biocides.options.upload') !!}
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-lg my-3">{!! icon('reset', trans('buttons.update')) !!}</button>
                                    </div>
                                </li>
                            </ol>

                        {{ html()->closeModelForm() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
