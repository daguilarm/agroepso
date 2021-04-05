@isset($cities)
<textarea style='width:100%; height: 500px'>
@foreach($cities as $key => $value)
['id' => {{ $value['id'] }}, 'country_id' => {{ $value['country_id'] }}, 'state_id' => {{ $value['state_id'] }}, 'region_id' => {{ $value['region_id'] }}, 'ine_id' => '{{ $value['ine_id'] }}', 'sigpac' => '{{ $value['sigpac'] }}', 'catastro' => '{{ $value['catastro'] }}', 'city_lat' => '{{ $value['city_lat'] }}', 'city_lng' => '{{ $value['city_lng'] }}', 'city_name' => '{{ str_replace("'", "\'", $value['city_name']) }}', 'deleted_at' => null, 'created_at' => null, 'updated_at' => null],
@endforeach
</textarea>
@endif
