{{-- Profile Menu --}}
<li class="dropdown"><a class="app-nav__item icon-reset" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">{!! icon('user-alt', null, 'fa-2x') !!}</i></a>
    <ul class="dropdown-menu settings-menu dropdown-menu-right">
        <li><a href="{{ route('dashboard.profiles.edit', Credentials::id()) }}" class="dropdown-item">{!! icon('user', trans('system.profile'), 'fa-2x') !!}</a></li>
        <li><a href="{{ route('logout') }}" class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{!! icon('exit', trans('system.logout'), 'fa-2x') !!}</a></li>
    </ul>
</li>