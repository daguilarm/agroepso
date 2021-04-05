<table class="table table-striped">
    <thead>
    <tr>
        @foreach($columns as $key => $column)
            <th>{{ $column }}</th>
        @endforeach
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
    </tbody>
</table>


