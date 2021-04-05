<li class="nav-item dropdown">

    {!! Html::dropdown(trans('navbar.administration'), ($section === 'users' || $section === 'clients' || $section === 'warehouses' || $section === 'plants')) !!}

    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

        @can('view user')
            <a href="{{ route('dashboard.users.index') }}" class="dropdown-item">{!! icon('arrow-right', trans_title('users', 'plural')) !!}</a>
        @endcan

        @can('view client')
            <a href="{{ route('dashboard.clients.index') }}" class="dropdown-item">{!! icon('arrow-right', trans_title('clients', 'plural')) !!}</a>
        @endcan

        @if(auth()->user()->can('view plant') && getClient('module.plants'))
            <a href="{{ route('dashboard.plants.index') }}" class="dropdown-item">{!! icon('arrow-right', trans_title('plants', 'plural')) !!}</a>
        @endif

        @if(auth()->user()->can('view plant') && getClient('module.warehouses'))
            <a href="{{ route('dashboard.warehouses.index') }}" class="dropdown-item">{!! icon('arrow-right', trans_title('warehouses', 'plural')) !!}</a>
        @endif

    </div>
</li>
