@extends('dashboard._layouts._print')

@section('content')
    @if(!empty($text['title']))
        <h1>{{ $text['title'] }}</h1>
        <h4>{{ $text['description'] }}</h4>
    @endif

    <br>
    
    {!! $table->pdf() !!}
@endsection