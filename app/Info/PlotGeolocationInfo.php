<?php

$meters = 'm';

return [
    'state.state_name' => trans('persona.contact.state'),
    'region.region_name' => trans('persona.contact.region'),
    'city.city_name' => trans('persona.contact.city'),
    'geolocation.geo_lat' => [
        'title' => trans('geolocation.lat'),
        'javascript' => 'geo_lat',
    ],
    'geolocation.geo_lng' => [
        'title' => trans('geolocation.lng'),
        'javascript' => 'geo_lng',
    ],
    // 'geolocation.geo_x' => trans('geolocation.x'),
    // 'geolocation.geo_y' => trans('geolocation.y'),
    // 'geolocation.zone' => trans('geolocation.zone'),
    'geolocation.geo_srs' => trans('geolocation.srs'),
    'geolocation.geo_height' => [
        'title' => trans('geolocation.height'),
        'extra_text' => $meters,
    ],
    'geolocation.geo_catastro' => trans('geolocation.catastro'),
    'geolocation.geo_catastro_url' => [
        'title' => 'catastro',
        'link' => 'out',
    ],
    'geolocation.sigpac' => 'sigpac',
    'map' => [
        'title' => null,
        'view' => view(dashboard_path('plots.map')),
    ],
];
