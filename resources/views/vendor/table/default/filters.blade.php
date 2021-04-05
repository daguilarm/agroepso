<div class="table-filter m-3">
    <form method="get" class="form-vertical">
        @if(count($filters))
            <div class="row">
                @foreach($filters as $filter)
                    <span class="filter-item">
                        {!! $filter->render() !!}
                    </span>
                @endforeach
                {{-- Search button --}}
                <button type="submit" class="btn btn-success btn-search">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                {{-- Reset button --}}
                @if(count($filters))
                    @if($filtersAreActive)
                        <a class="btn btn-outline-secondary btn-search ml-2" href="?orderField={{$orderField}}&orderDirection={{$orderDirection}}">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </a>
                    @endif
                @endif
            </div>
            <input type="hidden" name="orderField" value="{{$orderField}}">
            <input type="hidden" name="orderDirection" value="{{$orderDirection}}">
        @endif
        <div class="row">
            <div class="col-xs-6" style="text-align: right">
                @foreach($exporters as $key => $exporter)
                    <a class="btn btn-info" @if ($exporter->isTargetBlank()) target="_blank" @endif href="?{{http_build_query(array_merge(request()->all(), ['export_to' => $key]))}}">
                        {{ $exporter->getLabel() }}
                    </a>
                @endforeach
            </div>
        </div>
    </form>
</div>