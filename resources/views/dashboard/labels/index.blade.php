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

        <div class="row">
            <div class="col-lg-12">
                <p>{!! getLabel('DNS1D', time(), 'PHARMA2T') !!}</p>
                <p>{{ time() }}</p>
            </div>
            <div class="col-lg-12">
                <p>{!! getLabel('DNS1D', time(), 'C39') !!}</p>
                <p>{{ time() }}</p>
            </div>
            <div class="col-lg-12">
                <p>{!! getLabel('DNS2D', time(), 'PDF417') !!}</p>
                <p>{{ time() }}</p>
            </div>
            <div class="col-lg-12">
                <p>{!! getLabel('DNS2D', time(), 'QRCODE') !!}</p>
                <p>{{ time() }}</p>
            </div>
            <div class="col-lg-12">
                <p>{!! getLabel('DNS2D', time(), 'DATAMATRIX') !!}</p>
                <p>{{ time() }}</p>
            </div>
        </div>

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
