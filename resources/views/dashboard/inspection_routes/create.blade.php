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

        <div style="witdh: 100%; height: 500px" id="map"></div>
    </main>
@endsection

@section('javascript')
    <script>
        var origen;
        var destination;
        var current;
        var geocoder;
        var map;
        var marker;

        function initMap() {
            //var origen = new google.maps.LatLng( pos.coords.latitude, pos.coords.longitude );
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition( function( position ) {
                        var current = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                });
            }

            var origen = new google.maps.LatLng( 39.4839688, -0.462719 );
            var destination = new google.maps.LatLng( 39.4839688, -0.462719 );

            var myOptions= { zoom: 12, center: origen, mapTypeId:google.maps.MapTypeId.TERRAIN };

            map = new google.maps.Map( document.getElementById('map'), myOptions );

            var rendererOptions = { map: map };

            directionsDisplay = new google.maps.DirectionsRenderer( rendererOptions );

            //Set points
            var wps=[
                {{-- Coordenates --}}
                @foreach($coordenates as $value)
                { location: new google.maps.LatLng({{ $value->geo_lat }}, {{ $value->geo_lng }}) },
                @endforeach
            ];

            var request= { origin: origen, destination: destination, waypoints: wps, travelMode: google.maps.DirectionsTravelMode.DRIVING };

            directionsService = new google.maps.DirectionsService();

            directionsService.route( request, function( response, status ) {
                if( status == google.maps.DirectionsStatus.OK ) {
                    directionsDisplay.setDirections( response );
                } else {
                    alert('failed to get directions');
                }
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API') }}&callback=initMap"></script>
@endsection
