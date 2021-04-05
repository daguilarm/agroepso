@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> TESTING PLACE</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
            </ul>
        </div>

        @include(component_path('messages'))

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        {{-- @dd(getRepository('pomegranate', 'harvests')) --}}
                        {{-- @dd(studly_case(str_singular('InspectionRoutes'))) --}}
                        {{-- @dd(Credentials::cropName()) --}}
                        {{-- @dd(Geolocation::server('geonames')->params(['37.874182', '-0.80210111'])->get()) --}}
                        {{-- @dd(Geolocation::server('sigpac')->params('3,107,0,0,6,104')->get()) --}}
                        {{-- @dd(Geolocation::server('catastro')->params('03107A00600104')->get()) --}}
                        {{-- @dd(Geolocation::gpsToUtm('37.874182', '-0.80210111')) --}}
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
