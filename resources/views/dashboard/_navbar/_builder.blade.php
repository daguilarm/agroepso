{{-- Navbar --}}
<nav class="navbar navbar-expand-lg app-header m-0 p-0">
    {{-- Logo --}}
    <a class="app-header__logo" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler app-sidebar__toggle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{-- Main nav container --}}
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto navbar-top">
            {{-- All the sections --}}
            @include('dashboard._navbar._include')
        </ul>
    </div>

    {{-- Profile --}}
    <div class="d-none d-xl-block">
        <ul class="app-nav">
            @if(Credentials::isGod())
                <li class="nav-item"><span class="app-nav__item bg-info">Role: {{ Credentials::role() }} - Cliente: <a href="#" style="color:#FFF" data-toggle="modal" data-target="#modal-client" id="client-update">{{ Credentials::clientName() }}</a></span></li>
            @endif
            {{-- Notifications  --}}
            @include('dashboard._navbar.sections.notification')
            {{-- Tools --}}
            @includeWhen(Credentials::id() === 1, 'dashboard._navbar.sections.tools')
            {{-- Profile --}}
            @include('dashboard._navbar.sections.profile')
        </ul>
    </div>
</nav>

{{-- Logout --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
