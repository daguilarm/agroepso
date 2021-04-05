<div class="form-group mr-2">
    <label>{{$label}}</label>
    <input @foreach ($attributes as $k => $v) {{ $k }}="{{ $v }}" @endforeach class="form-control" type="text" value="{{$value}}" name="f_{{$name}}"/>
</div>
