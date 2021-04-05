<div class="app-title">

    <div>
        <h1>{!! !empty($headItems['icon']) ? icon($headItems['icon']) : icon($section) !!} {{ $headItems['title'] ?? trans_title($section, 'plural') }}</h1>
        <p>{{ $headItems['description'] ?? trans_description($section) }}</p>
    </div>

    {{--  breadcrumb --}}
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
        @foreach($breadcrumbItems as $item)
            @if(!empty($item['route']))
                <li class="breadcrumb-item"><a href="{{ $item['route'] }}">{{ $item['title'] }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $item['title'] }}</li>
            @endif
        @endforeach
    </ul>

</div>
