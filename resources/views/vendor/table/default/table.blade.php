@include('vendor.table.default.filters')
@include('vendor.table.default.batchs')

<div class="table-responsive table-content my-4">
    <table class="table table-striped" id="tableDataId">
        <thead>
        <tr>
            @if (!empty($batchActions['checkbox']))
                <th onclick="toggleInnerCheckbox();">
                    <input type="checkbox" onchange="toggleSelectAll()">
                </th>
            @endif
            @foreach($columns as $key => $column)
                <th>
                    @if(in_array($key, $sortables))
                        @if($orderField == $key)
                            <a href="?{{http_build_query(array_merge(request()->all(), [ 'orderField' => $key, 'orderDirection' => $orderDirection == 'asc' ? 'desc' : 'asc']))}}">
                                {{$column}}
                                @if($orderDirection == 'asc')
                                    <span class="table-arrow-up"></span>
                                    <span class="table-arrow-down" style="visibility: hidden;"></span>
                                @else
                                    <span class="table-arrow-down"></span>
                                    <span class="table-arrow-up" style="visibility: hidden;"></span>
                                @endif
                            </a>
                        @else
                            <a href="?{{http_build_query(array_merge(request()->all(), [ 'orderField' => $key, 'orderDirection' => 'asc']))}}">
                                {{$column}}
                                <span class="table-arrow-up"></span><span class="table-arrow-down"></span>&nbsp;
                            </a>
                        @endif
                    @else
                        {{$column}}
                    @endif
                </th>
            @endforeach
            @if(count($actions))
                <th class="no-print"></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($rows as $rowData)
            @include($rowViewPath, [
                'data' => $rowData,
                'columns' => $columns,
                'actions' => $actions,
                'orderField' => $orderField,
                'checkbox' => !empty($batchActions['checkbox'])
            ])
        @endforeach
        @if(count($totals))
            <tr class="ctable-total-heading">
                @if (!empty($batchActions))

                @endif
                @foreach($columns as $key => $column)
                    <td>
                        @if(array_get($totals, $key))
                        {{$column}}&nbsp;{{trans('table::total.'.array_get($totals, $key.'.type'))}}
                        @endif
                    </td>
                @endforeach
                @if(count($actions))
                    <td>

                    </td>
                @endif
            </tr>
            <tr class="ctable-total-content">
                @if (!empty($batchActions))
                    <td>

                    </td>
                @endif
                @foreach($columns as $key => $column)
                    <td>
                        {{array_get($totals, $key.'.total')}}
                    </td>
                @endforeach
                @if(count($actions))
                    <td>

                    </td>
                @endif
            </tr>
        @endif
        </tbody>
    </table>
</div>
<div class="table-pagination">
    @include('table::default.pagination', ['paginator' => $pagination])
</div>
