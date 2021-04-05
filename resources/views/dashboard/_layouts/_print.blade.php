<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <meta name="description" content="{{ config('app.description') }}">
        <style>
            {!! Minify::file(public_path('css/print.css'))->css() !!}
        </style>
    </head>
    <body  class="app sidebar-mini sidenav-toggled rtl">
        {{-- The content --}}
        @yield('content')
    </body>
</html>