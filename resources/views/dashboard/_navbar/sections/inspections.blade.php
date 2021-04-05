@if(auth()->user()->can('view inspection') && getClient('module.inspections'))
    <li class="nav-item dropdown">

        {!! Html::dropdown(trans_title('inspections', 'plural'), ($section === 'inspections')) !!}

        <div class="dropdown-menu" aria-labelledby="navbarDropdownInspections">

            @can('create inspection')
                <a href="{{ route('dashboard.inspections.create') }}" class="dropdown-item">{!! icon('new', trans('buttons.add')) !!}</a>
                <a href="{{ route('dashboard.inspection_routes.index') }}" class="dropdown-item">{!! icon('time', sections('inspections.planing')) !!}</a>
            @endcan

            <a href="{{ route('dashboard.inspections.index') }}" class="dropdown-item">{!! icon('list', trans('navbar.list')) !!}</a>

        </div>
    </li>
@endif
