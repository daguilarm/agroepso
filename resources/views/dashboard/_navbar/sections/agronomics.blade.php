@if(getClient('module.agronomics'))
    <li class="nav-item dropdown">

        {!! Html::dropdown(trans('navbar.agronomic'), ($section === 'harvests')) !!}

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

            <a href="{{ route('dashboard.harvests.index') }}" class="dropdown-item">{!! icon('arrow-right', trans_title('harvests', 'plural')) !!}</a>
            <a href="{{ route('dashboard.harvests.index') }}" class="dropdown-item">{!! icon('arrow-right', 'Fitosanitarios') !!}</a>
            <a href="{{ route('dashboard.harvests.index') }}" class="dropdown-item">{!! icon('arrow-right', 'Incidentes') !!}</a>
            <a href="{{ route('dashboard.harvests.index') }}" class="dropdown-item">{!! icon('arrow-right', 'Labores culturales') !!}</a>
            <a href="{{ route('dashboard.harvests.index') }}" class="dropdown-item">{!! icon('arrow-right', 'Plagas') !!}</a>
            <a href="{{ route('dashboard.harvests.index') }}" class="dropdown-item">{!! icon('arrow-right', 'Riegos') !!}</a>
        </div>
    </li>

@endif
