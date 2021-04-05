<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('dashboard._layouts.metatags')
        @include('dashboard._layouts.styles')
    </head>
    <body  class="app rtl">
        {{-- The navbar --}}
        {{-- @includeWhen(auth()->check(), 'dashboard._layouts.navbar') --}}
        @includeWhen(auth()->check(), 'dashboard._navbar._builder')

        {{-- The content --}}
        @yield('content')

        {{-- The footer --}}
        @include('dashboard._layouts.footer')

        {{-- The javascript libs --}}
        @include('dashboard._layouts.scripts')

        {{-- Load the modals --}}
        @yield('modals')

        {{-- This is important not to remove, because will produce an error in the tests, in the pages the user is not login --}}
        @if(auth()->check())
            @include(modal_path('delete'))
        @endif

        {{-- Only for admin to change client --}}
        @if(Credentials::isGod())
            @include(modal_path('client'))
        @endif
    </body>
</html>
