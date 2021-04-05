<tr>
    @if ($checkbox)
        <td onclick="toggleInnerCheckbox();">
            <input type="checkbox" name="item[]" value="{{ array_get($rowData, 'id') }}">
        </td>
    @endif
    @foreach($columns as $key => $column)
        <td @if($orderField == $key) class="ctable-ordered" @endif>
            {!! Html::tableRow($rowData, $key) !!}
        </td>
    @endforeach
    @if(count($actions))
        <td class="no-print">
            {{-- If the row has been deleted => restored field --}}
            @if($rowData->deleted_at)
                {!! Form::restoreButtons($rowData, $section) !!}
            @else
                {{-- Action buttons --}}
                @foreach($actions as $route => $name)
                    {{-- Form: App\Macros\Links.php --}}
                    {!! Html::tableAction($route, $rowData, $name) !!}
                @endforeach
            @endif
        </td>
    @endif
</tr>
