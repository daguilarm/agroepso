{{-- From components.table --}}
<div class="card border-light mb-3 p-0 col-12 col-lg-4" id="legend">
    <div class="card-header"><h4>Leyenda</h4></div>
    <div class="card-body">
        @foreach($legends as $legend)
            @isset($legend['divider'])
                <hr>
            @else
                <div class="row">
                    <div class="col-lg-2">{!! $legend['icon'] !!}</div>
                    <div class="col-lg-10 legend-text">{!! $legend['text'] !!}</div>
                </div>
            @endisset
        @endforeach
    </div>
</div>
