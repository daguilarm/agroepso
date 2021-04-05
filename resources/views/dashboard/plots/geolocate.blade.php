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
                    ->form('POST', route('dashboard.' . $section . '.geolocate'))
                    ->id('form-plot-create')
                    ->open()
                }}
                    <div class="row">
                        <div id="map" class="col-12">mapa</div>
                        <input type="hidden" name="geo_x" id="geo_x">
                        <input type="hidden" name="geo_y" id="geo_y">
                        <input type="hidden" name="geo_lat" id="geo_lat">
                        <input type="hidden" name="geo_lng" id="geo_lng">
                        <input type="hidden" name="geo_bbox" id="geo_bbox">
                        <input type="hidden" name="frame_width" id="frame_width">
                        <input type="hidden" name="frame_height" id="frame_height">
                    </div>

                {{ html()->form()->close() }}

            @endslot
        @endcomponent

    </main>
@endsection

{{-- Add the maps --}}
@section('leaflet')
    @include(dashboard_path('_layouts.leaflet'))
@endsection

{{-- Add the maps --}}
@section('javascript')
<script>
    var zoom = 18;
    var map = L.map('map').fitWorld();
    var marker;
    var message =  '<div id="geolocationMessage"><button type="submit" class="btn btn-danger" id="button-create-submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> Añadir</button></div>';

    //Set PNOA layer
    var base = L.tileLayer.wms( '//www.ign.es/wms-inspire/pnoa-ma', {
        attribution:    '<a href="http://www.ign.es" target="_blank">© Instituto Geográfico Nacional</a>',
        layers:         'OI.OrthoimageCoverage',
        maxZoom:        zoom
    }).addTo( map );
    // var sigpac =L.tileLayer.wms( 'http://wms.mapama.es/wms/wms.aspx', {
    //     attribution:    '<a href="http://www.magrama.gob.es/es/" target="_blank">SIGPAC ©</a>',
    //     layers:         'PARCELA',
    //     format:         'image/png',
    //     transparent:    true,
    //     version:        '1.1.0',
    //     crs:            L.CRS.EPSG4326
    // }).addTo( map );

    function onLocationFound(e) {
        marker = L.marker( e.latlng ).addTo( map ).bindPopup( message ).openPopup();
        var point = map.latLngToContainerPoint( e.latlng, map.getZoom() );
        var pointLat = e.latlng.lat, pointLng = e.latlng.lng, bbox = map.getBounds().toBBoxString(), x = point.x, y = point.y, width = map.getSize().x, height = map.getSize().y;
        //Get the lat, lng and bbox
        $( '#geo_x' ).val( x ),
        $( '#geo_y' ).val( y ),
        $( '#geo_bbox' ).val( bbox ),
        $( '#geo_lat' ).val( pointLat ),
        $( '#geo_lng' ).val( pointLng ),
        $( '#frame_width' ).val( width ),
        $( '#frame_height' ).val( height );
    }

    function onLocationError(e) {
        alert(e.message);
    }

    map.on('locationfound', onLocationFound);
    map.on('locationerror', onLocationError);
    map.locate({setView: true, maxZoom: zoom});
    map.on( 'click', getFeatureInfo );

    // Get data from map
    function getFeatureInfo( e ) {
        //Show the marker
        showPosition( e );
    }

    //Get the position of a point
    function showPosition( e ) {
        //Clean the map of markers
        if( marker !== null ) { map.removeLayer( marker ); }
        //Set the position
        var point = map.latLngToContainerPoint( e.latlng, map.getZoom() );
        //Defined variables for the bbox
        var pointLat = e.latlng.lat, pointLng = e.latlng.lng, bbox = map.getBounds().toBBoxString(), x = point.x, y = point.y, width = map.getSize().x, height = map.getSize().y;
        //Generate the marker
        marker = L.marker( e.latlng ).addTo( map ).bindPopup( message ).openPopup();
        //Get the lat, lng and bbox
        $( '#geo_x' ).val( x ),
        $( '#geo_y' ).val( y ),
        $( '#geo_bbox' ).val( bbox ),
        $( '#geo_lat' ).val( pointLat ),
        $( '#geo_lng' ).val( pointLng ),
        $( '#frame_width' ).val( width ),
        $( '#frame_height' ).val( height );
    }
</script>
@endsection
