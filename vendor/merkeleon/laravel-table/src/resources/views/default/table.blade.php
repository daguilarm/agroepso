<div class="table-filter">
    <form method="get" class="form-vertical">
        @if(count($filters))
            <div class="row">
                @foreach($filters as $filter)
                    {!! $filter->render() !!}
                @endforeach
            </div>
            <input type="hidden" name="orderField" value="{{$orderField}}">
            <input type="hidden" name="orderDirection" value="{{$orderDirection}}">
        @endif
        <div class="row">
            <div class="col-xs-6" style="text-align: left">
                @if(count($filters))
                    <input type="submit" class="btn btn-success" value="{{trans('table::button.filter')}}">
                    @if($filtersAreActive)
                        <a class="btn btn-warning"
                           href="?orderField={{$orderField}}&orderDirection={{$orderDirection}}">{{trans('table::button.reset')}}</a>
                    @endif
                @endif
            </div>
            <div class="col-xs-6" style="text-align: right">
                @foreach($exporters as $key => $exporter)
                    <a class="btn btn-info" @if ($exporter->isTargetBlank()) target="_blank" @endif
                    href="?{{http_build_query(array_merge(request()->all(), ['export_to' => $key]))}}">
                        {{ $exporter->getLabel() }}
                    </a>
                @endforeach
            </div>
        </div>
    </form>
</div>

@if (!empty($batchActions))
    <hr>
    <div class="table-batch-actions">
        <form method="get" class="form-vertical" onsubmit="onFormSubmit();">
            <div class="row">
                <div class="form-group">
                    <select name="batch_with" class="form-control">
                        <option value="selected">{{ trans('table::batch.action.selected') }}</option>
                        <option value="all">{{ trans('table::batch.action.all') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="batch" class="form-control" required>
                        <option></option>
                        @foreach ($batchActions as $key => $batchAction)
                            <option value="{{ $key }}">{{ trans('table::batch.labels.'.$key) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <button type="submit" name="batch_action" value="batch" class="btn btn-success">{{trans('table::button.batch')}}</button>
                </div>
            </div>
        </form>
        <script type="text/javascript">
            function toggleSelectAll() {
                var selectAllCheckbox = window.event.target;
                if (selectAllCheckbox.type != 'checkbox') {
                    selectAllCheckbox = selectAllCheckbox.querySelector('input[type=checkbox]');
                }
                var inputs = document.querySelectorAll(".table-content tbody input[type=checkbox]");
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].checked = selectAllCheckbox.checked;
                    if (inputs[i].onchange) {
                        inputs[i].onchange();
                    }
                }
            }
            function toggleInnerCheckbox() {
                var target = window.event.target;
                var checkbox = target.querySelector('input[type=checkbox]');
                if (checkbox) {
                    checkbox.checked = !checkbox.checked;
                    if (checkbox.onchange) {
                        checkbox.onchange();
                    }
                }
            }
            function onFormSubmit() {
                var target = window.event.target;
                var inputs = document.querySelectorAll(".table-content tbody input[type=checkbox]");
                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].checked) {
                        var checkbox = inputs[i].cloneNode(true)
                        checkbox.type = 'hidden';
                        target.appendChild(checkbox);
                    }
                }
            }
        </script>
    </div>
@endif
<hr>
<div class="table-content">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            @if (!empty($batchActions))
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
                <th></th>
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
                'hasBatchActions' => !empty($batchActions)
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
