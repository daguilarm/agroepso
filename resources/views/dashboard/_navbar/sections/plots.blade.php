@if(auth()->user()->can('view plot') && getClient('module.plots'))
    <li class="nav-item dropdown">

        {!! Html::dropdown(trans_title('plots', 'plural'), ($section === 'plots')) !!}

        <div class="dropdown-menu" aria-labelledby="navbarDropdownPlots">
            @can('create plot')
                <a href="{{ route('dashboard.plots.create') }}" class="dropdown-item">{!! icon('new', trans('buttons.add')) !!}</a>
                <a href="{{ route('dashboard.plots.geolocate') }}" class="dropdown-item">{!! icon('world', 'geolocalización') !!}</a>
            @endcan

            <a href="{{ route('dashboard.plots.index') }}" class="dropdown-item">{!! icon('list', trans('navbar.list')) !!}</a>
        </div>
    </li>
@endcan
