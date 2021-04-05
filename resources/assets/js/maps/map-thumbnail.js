$(function() {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        map.invalidateSize();
    })
});

var lat = window.geo_lat;
var lng = window.geo_lng;
var zoom = 17;
var container = 'map-thumbnail';
L.Icon.Default.imagePath = window.location.origin + '/img/maps/';

if( document.getElementById( container ) ) {
    var map = L.map(container, {
        crs: L.CRS.EPSG4326
    }).setView([ lat, lng ], zoom);

    //Set PNOA layer
    var base = L.tileLayer.wms( '//www.ign.es/wms-inspire/pnoa-ma', {
        attribution: '<a href="http://www.ign.es" target="_blank">© Instituto Geográfico Nacional</a>',
        layers: 'OI.OrthoimageCoverage',
        format: 'image/jpeg',
        transparent: false,
        version: '1.3.0',
        crs: L.CRS.EPSG4326,
        maxZoom: zoom
    }).addTo( map );

    //Set NVIA layer
    // var ndvi = L.tileLayer.wms( '//futurecropping.eng.au.dk/geoserver/wms', {
    //     attribution: '<a href="http://www.ign.es" target="_blank">© Instituto Geográfico Nacional</a>',
    //     layers: 'geonode:ndvi',
    //     format: 'image/png',
    //     transparent: true,
    //     version: '1.1.1',
    //     crs: L.CRS.EPSG4326,
    //     maxZoom: zoom,
    // }).addTo( map );

    //Marker
    marker  = L.marker( new L.LatLng( lat, lng ) ).addTo( map );
}
